<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class retailer extends Controller
{
    //login page
    public function retailerlogin()
    {
        return view('retailer.login');
    }

    // login
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Retrieve the retailer record from the database based on the email
        $retailer = DB::select("SELECT * FROM retailers WHERE email = ?", [$email]);

        if (!empty($retailer)) {
            $retailer = $retailer[0];
            if ($password == $retailer->password) {
                // Password matches, create a session for the retailer
                Auth::guard('retailer')->loginUsingId($retailer->id);

                // Redirect to the manufacturer dashboard
                return redirect()->route('retailer.dashboard')->with('success', 'Retailer login successful');
            } else {
                // If password is incorrect, redirect back with an error

                return redirect()->back()->withInput()->with('error', 'Invalid password');
            }
        } else {
            // If email is not found, redirect back with an error
            return redirect()->back()->withInput()->with('error', 'Email not found');
        }
    }
    // Admin dashboard
    public function retailerdashboard()
    {
        // Get the admin ID
        $retailerId = auth()->guard('retailer')->id();
        $retailer = DB::select('select * from retailers where id = ?', [$retailerId]);


        return view('retailer.home', compact('retailer'));
    }
    // Admin logout
    public function retailerlogout()
    {
        Auth::guard('retailer')->logout();

        return redirect()->route('login_manufactuer')->with('success', 'Retailer logout successful');
    }

    // profile
    public function showProfile()
    {

        $retailerId = auth()->guard('retailer')->id();
        $retailer = DB::select('select * from retailers where id = ?', [$retailerId]);

        return view('retailer.RetailerProfile', compact('retailer'));
    }
    public function updateProfile(Request $request)
    {
        $retailerId = auth()->guard('retailer')->id();

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);


        DB::table('retailers')
            ->where('id', $retailerId)
            ->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Profile updated successfully');

        // dd($request->all());
    }

    // shwo orders
    public function showOrder()
    {
        $retailerId = auth()->guard('retailer')->id();
        $retailer = DB::select('select * from retailers where id = ?', [$retailerId]);

        $orders = DB::select('
            SELECT
                sells.id,
                products.name AS product,
                sells.quantity,
                sells.total,
                sells.status,
                sells.created_at AS sale_date
            FROM
                sells
            JOIN
                products ON sells.product_id = products.id
            WHERE
                sells.retailer_id = ?
        ', [$retailerId]);

        return view('retailer.Order', compact('retailer', 'orders'));
    }

    // check out
    public function showCheckout($orderId)
    {
        $retailerId = auth()->guard('retailer')->id();
        $retailer = DB::select('select * from retailers where id = ?', [$retailerId]);

        $order = DB::select('SELECT * FROM sells WHERE id = ?', [$orderId]);

        return view('retailer.checkout', compact('order', 'retailer'));
    }

    // payment
    public function processPayment(Request $request)
    {
        // Retrieve form data
        $order_id = $request->input('order_id');
        $paymentMethod = $request->input('paymentMethod');
        $expiration_date = $request->input('cc-expiration') ?? $request->input('dc-expiration');
        $cvv = $request->input('cc-cvv') ?? $request->input('dc-cvv');
        $transaction_id = $request->input('transaction-id');

        // Determine payment type
        $payment_type = null;
        if ($paymentMethod == '1') {
            $payment_type = 1; // Credit card
        } elseif ($paymentMethod == '2') {
            $payment_type = 2; // Debit card
        } elseif ($paymentMethod == '3') {
            if ($request->input('mobile-provider') == 'bkash') {
                $payment_type = 4; // Bkash
            } elseif ($request->input('mobile-provider') == 'nagad') {
                $payment_type = 5; // Nagad
            }
        }

        // Validate card_number and mobile_number
        $card_number = $request->input('cc-number') ?? $request->input('dc-number');
        $mobile_number = $request->input('mobile-number');

        // Card number validation (16 digits)
        if (($payment_type == 1 || $payment_type == 2) && !preg_match('/^\d{16}$/', $card_number)) {
            return redirect()->back()->with('error', 'Invalid card number format (must be 16 digits)');
        }

        // Mobile number validation (11 digits)
        if (($payment_type == 4 || $payment_type == 5) && !preg_match('/^\d{11}$/', $mobile_number)) {
            return redirect()->back()->with('error', 'Invalid mobile number format (must be 11 digits)');
        }

        // Payment information validation for predefined values (for credit/debit cards)
        if ($payment_type == 1 || $payment_type == 2) {
            // Predefined valid credit/debit card information
            $valid_credit_cards = [
                ['number' => '4111111111111111', 'expiration_date' => '12/25', 'cvv' => '123'],
                ['number' => '5555555555554444', 'expiration_date' => '06/27', 'cvv' => '456'],
            ];

            // Check if entered card information matches any valid card
            $isValidCard = false;
            foreach ($valid_credit_cards as $valid_card) {
                if ($card_number == $valid_card['number'] && $expiration_date == $valid_card['expiration_date'] && $cvv == $valid_card['cvv']) {
                    $isValidCard = true;
                    break;
                }
            }

            if (!$isValidCard) {
                return redirect()->back()->with('error', 'Payment information is incorrect');
            }
        }

        // Update the sells table with the payment information
        DB::table('sells')
            ->where('id', $order_id)
            ->update([
                'payment_type' => $payment_type,
                'card_number' => $card_number,
                'expiration_date' => $expiration_date,
                'cvv' => $cvv,
                'mobile_number' => $mobile_number,
                'Transaction_ID' => $transaction_id,
                'status' => '1', // Assuming 1 represents 'Paid'
                'updated_at' => now(),
            ]);

        // Redirect to a success page or wherever you want
        return redirect()->back()->with('success', 'Payment successfully processed');
    }
}
