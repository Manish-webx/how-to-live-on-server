<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;

Route::get('/dashboard', [VendorController::class,'dashboard'])->name('dashboard');

Route::get('/profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('/update', [VendorProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('/update/password', [VendorProfileController::class, 'updatePassword'])->name('profile.password.update');

// Shop profile route

// Vendor Routes
Route::resource('/shop-profile', VendorShopProfileController::class);

// Product Routes
Route::get('product_subcategories', [VendorProductController::class, 'productSubCategories'])->name('getproduct-subcategories');
Route::get('product_childcategories', [VendorProductController::class, 'productChildCategories'])->name('getproduct-childcategories');
Route::resource('/products', VendorProductController::class);

Route::get('/tests', [VendorProductController::class, 'productSubCategories']);