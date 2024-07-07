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
}
