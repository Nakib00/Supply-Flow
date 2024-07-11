<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class manufactuer extends Controller
{
    //Login page
    public function manufactuerlogin()
    {
        return view('manufacturer.login');
    }

    // login
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Retrieve the manufacturer record from the database based on the email
        $manufacturer = DB::select("SELECT * FROM manufacturers WHERE email = ? LIMIT 1", [$email]);

        if (!empty($manufacturer)) {
            $manufacturer = $manufacturer[0];
            if ($password == $manufacturer->password) {
                // Password matches, create a session for the manufacturer
                Auth::guard('manufacturer')->loginUsingId($manufacturer->id);

                // Redirect to the manufacturer dashboard
                return redirect()->route('manufactuer.dashboard')->with('success', 'Manufacturer login successful');
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
    public function manufactuerdashboard()
    {
        // Get the  ID
        $manufacturerId = auth()->guard('manufacturer')->id();
        $manufacturer = DB::select('select * from manufacturers where id = ?', [$manufacturerId]);


        return view('manufacturer.home', compact('manufacturer'));
    }
    // Admin logout
    public function manufactuerlogout()
    {
        Auth::guard('manufacturer')->logout();

        return redirect()->route('login_manufactuer')->with('success', 'Manufacturer logout successful');
    }

    // sells page
    public function sells()
    {
        $manufacturerId = auth()->guard('manufacturer')->id();
        $manufacturer = DB::select('select * from manufacturers where id = ?', [$manufacturerId]);

        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->select('orders.id as order_id', 'products.name as product_name', 'orders.quantity', 'orders.total', 'orders.tax', 'orders.created_at', 'orders.status')
            ->where('orders.manufacturer_id', $manufacturerId)
            ->get();

        return view('manufacturer.Sall', compact('orders', 'manufacturer'));
    }
    // update status
    public function updateOrderStatus(Request $request)
    {
        $orderId = $request->input('order_id');
        $status = $request->input('status');

        $updated = DB::table('orders')
            ->where('id', $orderId)
            ->update(['status' => $status]);

        if ($updated) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    // show complain
    public function showComplain()
    {
        $manufacturerId = auth()->guard('manufacturer')->id();
        $manufacturer = DB::select('select * from manufacturers where id = ?', [$manufacturerId]);

        $complains = DB::table('complains')
            ->where('complains.manufacturer_id', $manufacturerId) // Specify table alias or full table name
            ->join('products', 'complains.product_id', '=', 'products.id')
            ->select('complains.*', 'products.name as product_name')
            ->get();

        return view('manufacturer.ShowComplain', compact('manufacturer', 'complains'));
    }
    // update complain status
    public function updateComplainStatus(Request $request)
    {
        $orderId = $request->input('order_id');
        $status = $request->input('status');

        // Retrieve complain details
        $complain = DB::table('complains')
            ->where('order_id', $orderId)
            ->first();

        if (!$complain) {
            return response()->json(['success' => false, 'error' => 'Complain not found'], 404);
        }

        // Update complain status
        DB::table('complains')
            ->where('order_id', $orderId)
            ->update(['status' => $status]);

        // If status is 1 (Approved), adjust order quantity
        if ($status == 1) {
            // Retrieve order details
            $order = DB::table('orders')
                ->where('id', $complain->order_id)
                ->first();

            if ($order) {
                // Calculate new quantity
                $newQuantity = $order->quantity - $complain->quantity;

                // Update order table with new quantity
                DB::table('orders')
                    ->where('id', $order->id)
                    ->update(['quantity' => $newQuantity]);
            } else {
                return response()->json(['success' => false, 'error' => 'Order not found'], 404);
            }
        }

        return response()->json(['success' => true]);
    }

    // profile
    public function showProfile()
    {
        $manufacturerId = auth()->guard('manufacturer')->id();
        $manufacturer = DB::select('select * from manufacturers where id = ?', [$manufacturerId]);


        return view('manufacturer.ManufactureProfile', compact('manufacturer'));
    }
    public function updateProfile(Request $request)
    {
        $manufacturerId = auth()->guard('manufacturer')->id();

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        // Update the manufacturer in the database
        DB::table('manufacturers')
            ->where('id', $manufacturerId)
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
}
