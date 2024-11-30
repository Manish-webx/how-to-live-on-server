<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;

Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');

// Slider routes

Route::resource('slider', SliderController::class);


// Category routes
Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

// Sub Category routes
Route::put('subcategory/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category', SubCategoryController::class);

// Child Category routes
Route::put('childcategory/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('getsubcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subcategories');
Route::resource('child-category', ChildCategoryController::class);

// Brand routes
Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);

// Vendor Routes
Route::resource('vendor-profile', AdminVendorProfileController::class);

// Products Routes
Route::get('product_subcategories', [ProductController::class, 'productSubCategories'])->name('getproduct-subcategories');
Route::get('product_childcategories', [ProductController::class, 'productChildCategories'])->name('getproduct-childcategories');
Route::put('products/change-status', [ProductController::class, 'changeStatus'])->name('products.change-status');
Route::resource('product', ProductController::class);
Route::resource('product-image-gallery', ProductImageGalleryController::class);

// Products Variant Routes
Route::put('products-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
Route::resource('products-variant', ProductVariantController::class);

// Products Variant Items Route
Route::get('products-variant-items/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('products-variant-items.index');
Route::get('products-variant-items/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('products-variant-items.create');
Route::post('products-variant-items', [ProductVariantItemController::class, 'store'])->name('products-variant-items.store');
Route::get('products-variant-items-edit/{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('products-variant-items.edit');
Route::put('products-variant-items-update/{variantItemId}', [ProductVariantItemController::class, 'update'])->name('products-variant-items.update');
Route::put('products-variant-items/change-status', [ProductVariantItemController::class, 'changeStatus'])->name('products-variant-items.change-status');
Route::delete('products-variant-items/{variantItemId}/destroy', [ProductVariantItemController::class, 'destroy'])->name('products-variant-items.destroy');