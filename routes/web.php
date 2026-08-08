<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Redirect root to products index
Route::get('/', fn() => redirect()->route('products.index'));

// Full resource routes for CRUD
Route::resource('products', ProductController::class);
