<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::resource('categories', CategoryController::class);
Route::resource('subcategories', SubcategoryController::class);
Route::resource('products', ProductController::class)->except(['show']);

// show product by slug
Route::get('product/{slug}', [ProductController::class, 'show'])->name('products.show');

// API-ish route to fetch subcategories by category (used by JS)
Route::get('/api/categories/{id}/subcategories', [ProductController::class, 'subcategoriesByCategory']);