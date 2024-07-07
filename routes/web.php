<?php

use App\Http\Controllers\admin;
use App\Http\Controllers\manufactuer;
use App\Http\Controllers\retailer;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('login');
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
    });
});
