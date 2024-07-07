<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class admin extends Controller
{
    //admin login page
    public function adminlogin()
    {
        return view('login');
    }
    // login
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Retrieve the admin record from the database based on the email
        $admin = DB::select("SELECT * FROM admins WHERE email = ? LIMIT 1", [$email]);

        if (!empty($admin)) {
            if (!empty($admin)) {
                $admin = $admin[0];
                if ($password == $admin->password) {
                    // Password matches, create a session for the admin
                    Auth::guard('admin')->loginUsingId($admin->id);

                    // Redirect to the manager dashboard
                    return redirect()->route('admin.dashboard')->with('success', 'Admin login successful');
                } else {
                    // If password is incorrect, redirect back with an error
                    return redirect()->back()->withInput()->with('error', 'Invalid email or password');
                }
            }
        } else {
            // If email is not found, redirect back with an error
            return redirect()->back()->withInput()->with('error', 'Email not found');
        }
    }
    // Admin dashboard
    public function admindashboard()
    {
        // Get the admin ID
        $adminId = auth()->guard('admin')->id();

        $admin = DB::select('select * from admins where id = ?', [$adminId]);


        return view('admin.home', compact('admin'));
    }
    // Admin logout
    public function adminlogout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('login_admin')->with('success', 'Admin logout successful');
    }
}
