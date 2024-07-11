<?php

use App\Http\Controllers\admin;
use App\Http\Controllers\manufactuer;
use App\Http\Controllers\retailer;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('login');
});

Route::get('/hi', function () {
    return view('exampleHosted');
});
// Admin routes
Route::prefix('admin')->group(function () {
    // login routes
    Route::get('/login', [admin::class, 'adminlogin'])->name('login_admin');
    Route::post('/logins', [admin::class, 'login'])->name('admin.login');
    Route::get('/logout', [admin::class, 'adminlogout'])->name('admin.logout');

    // Dashboard routes with middleware
    Route::middleware('admin')->group(function () {
        Route::prefix('/dashboard')->group(function () {
            Route::get('/', [admin::class, 'admindashboard'])->name('admin.dashboard');

            // Category
            Route::get('/category', [admin::class, 'showCategory'])->name('admin.showCategory');
            Route::get('/category/add', [admin::class, 'addCategory'])->name('admin.categories.create');
            Route::post('/category/store', [admin::class, 'storeCategory'])->name('admin.categories.store');
            Route::get('/category/edit/{id}', [admin::class, 'editCategory'])->name('admin.categories.edit');
            Route::post('/category/update/{id}', [admin::class, 'updateCategory'])->name('admin.categories.update');
            Route::delete('/category/delete/{id}', [admin::class, 'deleteCategory'])->name('admin.categories.destroy');

            // Unit
            Route::get('/unit', [admin::class, 'showUnit'])->name('admin.showUnit');
            Route::get('/unit/add', [admin::class, 'addUnit'])->name('admin.unit.create');
            Route::post('/unit/store', [admin::class, 'storeunit'])->name('admin.unit.store');
            Route::get('/unit/edit/{id}', [admin::class, 'editUnit'])->name('admin.unit.edit');
            Route::post('/unit/update/{id}', [admin::class, 'updateUnit'])->name('admin.unit.update');
            Route::delete('/unit/delete/{id}', [admin::class, 'deleteUnit'])->name('admin.unit.destroy');

            // area
            Route::get('/area', [admin::class, 'showArea'])->name('admin.showArea');
            Route::get('/area/add', [admin::class, 'addArea'])->name('admin.area.create');
            Route::post('/area/store', [admin::class, 'storeArea'])->name('admin.area.store');
            Route::get('/area/edit/{id}', [admin::class, 'editArea'])->name('admin.area.edit');
            Route::post('/area/update/{id}', [admin::class, 'updateArea'])->name('admin.area.update');
            Route::delete('/area/delete/{id}', [admin::class, 'deleteArea'])->name('admin.area.destroy');

            // Manufacturer
            Route::get('/manufacturer', [admin::class, 'showManufacturer'])->name('admin.showManufacturer');
            Route::get('/manufacturer/add', [admin::class, 'addManufacturer'])->name('admin.manufacturer.create');
            Route::post('/manufacturer/store', [admin::class, 'storeManufacturer'])->name('admin.manufacturer.store');
            Route::get('/manufacturer/edit/{id}', [admin::class, 'editManufacturer'])->name('admin.manufacturer.edit');
            Route::post('/manufacturer/update/{id}', [admin::class, 'updateManufacturer'])->name('admin.manufacturer.update');
            Route::delete('/manufacturer/delete/{id}', [admin::class, 'deleteManufacturer'])->name('admin.manufacturer.destroy');

            // Retailer
            Route::get('/retailer', [admin::class, 'showRetailer'])->name('admin.showRetailer');
            Route::get('/retailer/add', [admin::class, 'addRetailer'])->name('admin.retailer.create');
            Route::post('/retailer/store', [admin::class, 'storeRetailer'])->name('admin.retailer.store');
            Route::get('/retailer/edit/{id}', [admin::class, 'editRetailer'])->name('admin.retailer.edit');
            Route::put('/retailer/update/{id}', [admin::class, 'updateRetailer'])->name('admin.retailer.update');
            Route::delete('/retailer/delete/{id}', [admin::class, 'deleteRetailer'])->name('admin.retailer.destroy');

            // Product
            Route::get('/product', [admin::class, 'showProduct'])->name('admin.showProduct');
            Route::get('/product/add', [admin::class, 'addProduct'])->name('admin.Product.create');
            Route::post('/product/store', [admin::class, 'storeProduct'])->name('admin.Product.store');
            Route::get('/product/edit/{id}', [admin::class, 'editProduct'])->name('admin.Product.edit');
            Route::put('/product/update/{id}', [admin::class, 'updateProduct'])->name('admin.Product.update');
            Route::delete('/product/delete/{id}', [admin::class, 'deleteProduct'])->name('admin.Product.destroy');

            // Distributer
            Route::get('/Distributer', [admin::class, 'showDistributer'])->name('admin.showDistributer');
            Route::get('/Distributer/add', [admin::class, 'addDistributer'])->name('admin.distributer.create');
            Route::post('/Distributer/store', [admin::class, 'storeDistributer'])->name('admin.distributer.store');
            Route::get('/Distributer/edit/{id}', [admin::class, 'editDistributer'])->name('admin.distributer.edit');
            Route::put('/Distributer/update/{id}', [admin::class, 'updateDistributer'])->name('admin.distributer.update');
            Route::delete('/Distributer/delete/{id}', [admin::class, 'deleteDistributer'])->name('admin.distributer.destroy');

            // Order
            Route::get('/Order', [admin::class, 'showOrder'])->name('admin.showOrder');
            Route::get('/Order/add', [admin::class, 'addOrder'])->name('admin.order.create');
            Route::post('/Order/store', [admin::class, 'storeOrder'])->name('admin.order.store');

            // Quality Control
            Route::get('/quality', [admin::class, 'quality'])->name('admin.quality');
            Route::get('/orders/{order}', [admin::class, 'showComplaintForm'])->name('admin.orders.complain');
            Route::post('/orders/{order}/complain', [admin::class, 'submitComplaint'])->name('orders.submitComplaint');
            Route::get('/orders/{order}/complain', [admin::class, 'showComplainDetails'])->name('orders.complainDetails');

            // admin profile
            Route::get('/admin/profile', [admin::class, 'showProfile'])->name('admin.profile');
            Route::post('/admin/profile/update', [admin::class, 'updateProfile'])->name('admin.profile.update');

            // sell
            Route::get('/admin/sell', [admin::class, 'showSell'])->name('admin.sell');
            Route::get('/admin/sell/create', [admin::class, 'SellCreate'])->name('admin.sale.create');
            Route::post('admin/sales/store', [admin::class, 'store'])->name('admin.sales.store');
        });
    });
});

// Manufacturer routes
Route::prefix('manufacturer')->group(function () {
    // login routes
    Route::get('/login', [manufactuer::class, 'manufactuerlogin'])->name('login_manufactuer');
    Route::post('/logins', [manufactuer::class, 'login'])->name('manufactuer.login');
    Route::get('/logout', [manufactuer::class, 'manufactuerlogout'])->name('manufactuer.logout');

    // Dashboard routes with middleware
    Route::middleware('manufacturer')->group(function () {
        Route::get('/dashboard', [manufactuer::class, 'manufactuerdashboard'])->name('manufactuer.dashboard');

        // sells
        Route::get('/sell', [manufactuer::class, 'sells'])->name('manufactuer.sell.show');
        Route::post('/manufacturer/update-order-status', [manufactuer::class, 'updateOrderStatus'])->name('manufacturer.updateOrderStatus');

        // Complain
        Route::get('/complain', [manufactuer::class, 'showComplain'])->name('manufacturer.orders.complain');
        Route::post('/complain/update-status', [manufactuer::class, 'updateComplainStatus'])->name('complain.update-status');

        // Manufacturer profile
        Route::get('/profile', [manufactuer::class, 'showProfile'])->name('manufacturer.profile');
        Route::post('/profile/update', [manufactuer::class, 'updateProfile'])->name('manufacturer.profile.update');
    });
});

// Retailer routes
Route::prefix('retailer')->group(function () {
    // login routes
    Route::get('/login', [retailer::class, 'retailerlogin'])->name('login_retailer');
    Route::post('/logins', [retailer::class, 'login'])->name('retailer.login');
    Route::get('/logout', [retailer::class, 'retailerlogout'])->name('retailer.logout');

    // Dashboard routes with middleware
    Route::middleware('retailer')->group(function () {
        Route::get('/dashboard', [retailer::class, 'retailerdashboard'])->name('retailer.dashboard');

        // Retailer profile
        Route::get('/profile', [retailer::class, 'showProfile'])->name('retailer.profile');
        Route::post('/profile/update', [retailer::class, 'updateProfile'])->name('retailer.profile.update');

        // orders
        Route::get('/order', [retailer::class, 'showOrder'])->name('retailer.order');

        // checkout
        Route::get('retailer/checkout/{order}', [retailer::class, 'showCheckout'])->name('retailer.checkout');
        Route::post('retailer/pay', [retailer::class, 'processPayment'])->name('retailer.pay');
    });
});


