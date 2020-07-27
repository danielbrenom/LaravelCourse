<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Products\Http\Controllers\ProductBuyerController;
use Modules\Products\Http\Controllers\ProductBuyerTransactionController;
use Modules\Products\Http\Controllers\ProductCategoryController;
use Modules\Products\Http\Controllers\ProductsController;
use Modules\Products\Http\Controllers\ProductTransactionController;

/*
|--------------------------------------------------------------------------
| products Routes
|--------------------------------------------------------------------------
*/

Route::resource('products', ProductsController::class)->middleware(['api'])->only(['index', 'show']);
Route::resource('products.transactions', ProductTransactionController::class)->middleware(['api'])->only(['index']);
Route::resource('products.buyers', ProductBuyerController::class)->middleware(['api'])->only(['index']);
Route::resource('products.categories', ProductCategoryController::class)->middleware(['api'])->only(['index', 'update', 'destroy']);
Route::resource('products.buyers.transactions', ProductBuyerTransactionController::class)->middleware(['api'])->only(['store']);
