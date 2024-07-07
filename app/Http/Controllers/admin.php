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

    // Show category
    public function showCategory()
    {
        // Get the admin ID
        $adminId = auth()->guard('admin')->id();

        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        $catagory = DB::select('select * from categories');

        return view('admin.Category', compact('admin', 'catagory'));
    }
    // Add category page
    public function addCategory()
    {
        // Get the admin ID
        $adminId = auth()->guard('admin')->id();

        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        return view('admin.addCategory', compact('admin'));
    }
    // Store category
    public function storeCategory(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Use raw SQL to insert the category into the database
        DB::insert('INSERT INTO categories (name, created_at, updated_at) VALUES (?, ?, ?)', [
            $request->name,
            now(),
            now(),
        ]);

        // Redirect to the category list with a success message
        return redirect()->back()->with('success', 'Category added successfully.');
    }
    // Edit category
    public function editCategory($id)
    {
        // Get the admin ID
        $adminId = auth()->guard('admin')->id();

        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        // Fetch the category by ID using raw SQL
        $category = DB::select('SELECT * FROM categories WHERE id = ?', [$id]);

        return view('admin.editCatatory', compact('category', 'admin'));
    }
    // Update category
    public function updateCategory(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Use raw SQL to update the category in the database
        DB::update('UPDATE categories SET name = ?, updated_at = ? WHERE id = ?', [
            $request->name,
            now(),
            $id,
        ]);

        // Redirect to the category list with a success message
        return redirect()->back()->with('success', 'Category updated successfully.');
    }
    // Delete category
    public function deleteCategory($id)
    {
        // Use raw SQL to delete the category from the database
        DB::delete('DELETE FROM categories WHERE id = ?', [$id]);

        // Redirect to the category list with a success message
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    // Units
    public function showUnit()
    {
        // Get the admin ID
        $adminId = auth()->guard('admin')->id();

        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        // Fetch the unit by ID using raw SQL
        $unit = DB::select('SELECT * FROM units');

        return view('admin.unit', compact('admin', 'unit'));
    }
    // add units
    public function addUnit()
    {

        // Get the admin ID
        $adminId = auth()->guard('admin')->id();

        $admin = DB::select('select * from admins where id = ?', [$adminId]);
        return view('admin.addUnit', compact('admin'));
    }

    // store units
    public function storeunit(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // Use raw SQL to insert the category into the database
        DB::insert('INSERT INTO units (name,description, created_at, updated_at) VALUES (?, ?, ?,?)', [
            $request->name,
            $request->description,
            now(),
            now(),
        ]);

        // Redirect to the category list with a success message
        return redirect()->back()->with('success', 'Unit added successfully.');
    }
    // Edit Unit
    public function editUnit($id)
    {
        // Get the admin ID
        $adminId = auth()->guard('admin')->id();

        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        // Fetch the category by ID using raw SQL
        $unit = DB::select('SELECT * FROM units WHERE id = ?', [$id]);

        return view('admin.editUnit', compact('unit', 'admin'));
    }
    // Update category
    public function updateUnit(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // Use raw SQL to update the category in the database
        DB::update('UPDATE units SET name = ?,description=?, updated_at = ? WHERE id = ?', [
            $request->name,
            $request->description,
            now(),
            $id,
        ]);

        // Redirect to the category list with a success message
        return redirect()->back()->with('success', 'Unit updated successfully.');
    }
    // Delete Unit
    public function deleteUnit($id)
    {
        // Use raw SQL to delete the category from the database
        DB::delete('DELETE FROM units WHERE id = ?', [$id]);

        // Redirect to the category list with a success message
        return redirect()->back()->with('success', 'units deleted successfully.');
    }
}
