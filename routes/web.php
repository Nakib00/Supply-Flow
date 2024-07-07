<?php

use App\Http\Controllers\admin;
use App\Http\Controllers\manufactuer;
use App\Http\Controllers\retailer;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('login');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [admin::class, 'adminlogin'])->name('login_admin');
    Route::post('/logins', [admin::class, 'login'])->name('admin.login');
    Route::get('/logout', [admin::class, 'adminlogout'])->name('admin.logout');

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [admin::class, 'admindashboard'])->name('admin.dashboard');
    });
});


Route::prefix('manufacturer')->group(function () {
    Route::get('/login', [manufactuer::class, 'manufactuerlogin'])->name('login_manufactuer');
    Route::post('/logins', [manufactuer::class, 'login'])->name('manufactuer.login');
    Route::get('/logout', [manufactuer::class, 'manufactuerlogout'])->name('manufactuer.logout');

    Route::middleware('manufacturer')->group(function () {
        Route::get('/dashboard', [manufactuer::class, 'manufactuerdashboard'])->name('manufactuer.dashboard');
    });
});


Route::prefix('retailer')->group(function () {
    Route::get('/login', [retailer::class, 'retailerlogin'])->name('login_retailer');
    Route::post('/logins', [retailer::class, 'login'])->name('retailer.login');
    Route::get('/logout', [retailer::class, 'retailerlogout'])->name('retailer.logout');

    Route::middleware('retailer')->group(function () {
        Route::get('/dashboard', [retailer::class, 'retailerdashboard'])->name('retailer.dashboard');
    });
});
