<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryBuyerController;
use Modules\Category\Http\Controllers\CategoryController;
use Modules\Category\Http\Controllers\CategoryProductController;
use Modules\Category\Http\Controllers\CategorySellerController;
use Modules\Category\Http\Controllers\CategoryTransactionController;

/*
|--------------------------------------------------------------------------
| category Routes
|--------------------------------------------------------------------------
*/

Route::resource('categories', CategoryController::class)->middleware(['api'])->except(['create', 'edit']);
Route::resource('categories.products', CategoryProductController::class)->middleware(['api'])->only(['index']);
Route::resource('categories.sellers', CategorySellerController::class)->middleware(['api'])->only(['index']);
Route::resource('categories.transactions', CategoryTransactionController::class)->middleware(['api'])->only(['index']);
Route::resource('categories.buyers', CategoryBuyerController::class)->middleware(['api'])->only(['index']);

