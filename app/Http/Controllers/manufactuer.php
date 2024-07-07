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
        // Get the admin ID
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
}
