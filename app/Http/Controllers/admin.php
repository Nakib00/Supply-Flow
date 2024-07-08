<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    // Area show
    public function showArea()
    {
        // Get the admin ID
        $adminId = auth()->guard('admin')->id();

        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        // Fetch the areas by ID using raw SQL
        $area = DB::select('SELECT * FROM areas');
        return view('admin.area', compact('admin', 'area'));
    }
    // add area
    public function addArea()
    {
        // Get the admin ID
        $adminId = auth()->guard('admin')->id();

        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        return view('admin.addArea', compact('admin'));
    }
    // store area
    public function storeArea(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        // Use raw SQL to insert the category into the database
        DB::insert('INSERT INTO areas (name,description,code,created_at, updated_at) VALUES (?, ?, ?,?,?)', [
            $request->name,
            $request->description,
            $request->code,
            now(),
            now(),
        ]);

        // Redirect to the category list with a success message
        return redirect()->back()->with('success', 'Area added successfully.');
    }
    // Edit area
    public function editArea($id)
    {
        $adminId = auth()->guard('admin')->id();

        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        // Fetch the category by ID using raw SQL
        $area = DB::select('SELECT * FROM areas WHERE id = ?', [$id]);

        return view('admin.editArea', compact('admin', 'area'));
    }
    // update area
    public function updateArea(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        // Use raw SQL to update the category in the database
        DB::update('UPDATE areas SET name = ?,description=?,code=?, updated_at = ? WHERE id = ?', [
            $request->name,
            $request->description,
            $request->code,
            now(),
            $id,
        ]);

        // Redirect to the category list with a success message
        return redirect()->back()->with('success', 'Area updated successfully.');
    }
    // deleate area
    public function deleteArea($id)
    {
        // Use raw SQL to delete the category from the database
        DB::delete('DELETE FROM areas WHERE id = ?', [$id]);

        // Redirect to the category list with a success message
        return redirect()->back()->with('success', 'Area deleted successfully.');
    }

    // Manufacturar show
    public function showManufacturer()
    {
        $adminId = auth()->guard('admin')->id();
        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        // Fetch the manufacturers by ID using raw SQL
        $manufacturers = DB::select('SELECT * FROM manufacturers');

        return view('admin.Manufacturer', compact('admin', 'manufacturers'));
    }
    // add manufacturer
    public function addManufacturer()
    {
        $adminId = auth()->guard('admin')->id();
        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        return view('admin.addManufacturer', compact('admin'));
    }
    // store manufacturer
    public function storeManufacturer(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:50',
        ]);

        // Use raw SQL to insert the manufacturer into the database
        DB::insert('INSERT INTO manufacturers (name, address, phone, email, password, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)', [
            $request->name,
            $request->address,
            $request->phone,
            $request->email,
            $request->password,
            now(),
            now(),
        ]);

        // Redirect to the manufacturer list with a success message
        return redirect()->back()->with('success', 'Manufacturer added successfully.');
    }
    // Edit a manufacturer
    public function editManufacturer($id)
    {
        $adminId = auth()->guard('admin')->id();
        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        $manufacturer = DB::select('SELECT * FROM manufacturers WHERE id = ?', [$id]);

        return view('admin.editManufacturer', compact('admin', 'manufacturer'));
    }
    // update a manufacturer
    public function updateManufacturer($id, Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'passowrd' => 'required|string|max:50',
        ]);

        // Use raw SQL to update the manufacturers in the database
        DB::update('UPDATE manufacturers SET name = ?,address=?,phone=?,email=?,password=?, updated_at = ? WHERE id = ?', [
            $request->name,
            $request->address,
            $request->phone,
            $request->email,
            $request->passowrd,
            now(),
            $id,
        ]);

        // Redirect to the category list with a success message
        return redirect()->back()->with('success', 'Manufacturer updated successfully.');
    }
    // delete the manufacturer
    public function deleteManufacturer($id)
    {
        // Use raw SQL to delete the category from the database
        DB::delete('DELETE FROM manufacturers WHERE id = ?', [$id]);

        // Redirect to the category list with a success message
        return redirect()->back()->with('success', 'Manufacturers deleted successfully.');
    }

    // reatiler
    public function showRetailer()
    {
        $adminId = auth()->guard('admin')->id();
        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        $retailer = DB::select('SELECT retailers.*, areas.name as area_name FROM retailers JOIN areas ON retailers.area_id = areas.id');

        return view('admin.Retailer', compact('retailer', 'admin'));
    }
    // add reatiler
    public function addRetailer()
    {
        $adminId = auth()->guard('admin')->id();
        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        $areas = DB::table('areas')->get();

        return view('admin.addRetailer', compact('admin', 'areas'));
    }
    // store retailer
    public function storeRetailer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:50',
            'area_id' => 'required|integer|exists:areas,id',
        ]);

        DB::insert('INSERT INTO retailers (name, address, phone, email, password, area_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', [
            $request->name,
            $request->address,
            $request->phone,
            $request->email,
            $request->password,
            $request->area_id,
            now(),
            now(),
        ]);

        return redirect()->back()->with('success', 'Retailer added successfully.');
    }
    // Edit retailer
    public function editRetailer($id)
    {
        $adminId = auth()->guard('admin')->id();
        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        $retailer = DB::table('retailers')->where('id', $id)->first();
        $areas = DB::table('areas')->get();

        return view('admin.editRetailer', compact('admin', 'retailer', 'areas'));
    }
    // update retailer
    public function updateRetailer($id, Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:50',
            'area_id' => 'required|integer|exists:areas,id',
        ]);

        // Use raw SQL to update the retailer in the database
        DB::update('UPDATE retailers SET name = ?, address = ?, phone = ?, email = ?, password = ?, area_id = ?, updated_at = ? WHERE id = ?', [
            $request->name,
            $request->address,
            $request->phone,
            $request->email,
            $request->password,
            $request->area_id,
            now(),
            $id,
        ]);

        return redirect()->back()->with('success', 'Retailer updated successfully.');
    }
    // delete retailer
    public function deleteRetailer($id)
    {
        // Use raw SQL to delete the category from the database
        DB::delete('DELETE FROM retailers WHERE id = ?', [$id]);

        // Redirect to the category list with a success message
        return redirect()->back()->with('success', 'Retailers deleted successfully.');
    }

    // product
    public function showProduct()
    {
        $adminId = auth()->guard('admin')->id();
        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        $products = DB::table('products')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->get();

        return view('admin.Product', compact('admin', 'products'));
    }
    // add products
    public function addProduct()
    {
        $adminId = auth()->guard('admin')->id();
        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        $categories = DB::table('categories')->get();

        return view('admin.addProduct', compact('admin', 'categories'));
    }
    // store products
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|integer|exists:categories,id',
            'quantity' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('product_images', 'public');

        DB::insert('INSERT INTO products (name, description, price, category, quantity, image, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', [
            $request->name,
            $request->description,
            $request->price,
            $request->category,
            $request->quantity,
            $imagePath,
            now(),
            now(),
        ]);


        return redirect()->back()->with('success', 'Product added successfully.');
    }
    // edit product
    public function editProduct($id)
    {
        $adminId = auth()->guard('admin')->id();
        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        $product = DB::select('SELECT * FROM products WHERE id = ?', [$id]);

        $categories = DB::select('SELECT * FROM categories');

        return view('admin.editProduct', compact('admin', 'product', 'categories'));
    }
    // update product
    public function updateProduct($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|integer|exists:categories,id',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = DB::selectOne('SELECT * FROM products WHERE id = ?', [$id]);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image file
            Storage::disk('public')->delete($product->image);

            // Upload the new image
            $imagePath = $request->file('image')->store('product_images', 'public');
        } else {
            // Keep the existing image path if no new image is provided
            $imagePath = $product->image;
        }

        // Update the product using raw SQL query
        DB::update('UPDATE products SET name = ?, description = ?, price = ?, category = ?, quantity = ?, image = ?, updated_at = ? WHERE id = ?', [
            $request->name,
            $request->description,
            $request->price,
            $request->category_id,
            $request->quantity,
            $imagePath,
            now(),
            $id,
        ]);

        return redirect()->back()->with('success', 'Product updated successfully.');
    }
    // delete product
    public function deleteProduct($id)
    {
        $product = DB::selectOne('SELECT * FROM products WHERE id = ?', [$id]);

        // Delete the product's image file, if it exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Delete the product using raw SQL query
        DB::delete('DELETE FROM products WHERE id = ?', [$id]);

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    // show distributer
    public function showDistributer()
    {
        $adminId = auth()->guard('admin')->id();
        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        $distributors = DB::select('SELECT * FROM distributers');

        return view('admin.Distributer', compact('admin', 'distributors'));
    }
    // add distributer
    public function addDistributer()
    {
        $adminId = auth()->guard('admin')->id();
        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        return view('admin.addDistributer', compact('admin'));
    }
    // store distributeers
    public function storeDistributer(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'nid' => 'required|string|max:255',
        ]);

        // Use raw SQL to insert the distributor into the database
        DB::insert('INSERT INTO distributers (name, company_name, address, phone, nid, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)', [
            $request->name,
            $request->company_name,
            $request->address,
            $request->phone,
            $request->nid,
            now(),
            now(),
        ]);

        // Redirect to the distributor list with a success message
        return redirect()->back()->with('success', 'Distributor added successfully.');
    }
    // edit distributor
    public function editDistributer($id, Request $request)
    {
        $adminId = auth()->guard('admin')->id();
        $admin = DB::select('select * from admins where id = ?', [$adminId]);

        $distributer = DB::select('SELECT * FROM distributers WHERE id = ?', [$id]);

        return view('admin.editDistributer', compact('admin', 'distributer'));
    }
    // update distributor
    public function updateDistributer($id, Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'nid' => 'required|string|max:255',
        ]);

        // Use raw SQL to update the distributor in the database
        DB::update('UPDATE distributers SET name = ?, company_name = ?, address = ?, phone = ?, nid = ?, updated_at = ? WHERE id = ?', [
            $request->name,
            $request->company_name,
            $request->address,
            $request->phone,
            $request->nid,
            now(),
            $id,
        ]);

        // Redirect to the distributor list with a success message
        return redirect()->back()->with('success', 'Distributor updated successfully.');
    }
    // delete the distributor
    public function deleteDistributer($id)
    {
        // Use raw SQL to delete the distributor from the database
        DB::delete('DELETE FROM distributers WHERE id = ?', [$id]);

        // Redirect to the distributor list with a success message
        return redirect()->back()->with('success', 'Distributor deleted successfully.');
    }
}
