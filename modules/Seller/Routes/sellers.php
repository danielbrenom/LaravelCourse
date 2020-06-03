<?php

use Illuminate\Support\Facades\Route;
use Modules\Seller\Http\Controllers\SellerBuyerController;
use Modules\Seller\Http\Controllers\SellerCategoriesController;
use Modules\Seller\Http\Controllers\SellerController;
use Modules\Seller\Http\Controllers\SellerProductController;
use Modules\Seller\Http\Controllers\SellerTransactions;

/*
|--------------------------------------------------------------------------
| sellers Routes
|--------------------------------------------------------------------------
*/

Route::resource('sellers', SellerController::class)->only(['index', 'show'])->middleware(['api']);
Route::resource('sellers.transactions', SellerTransactions::class)->only(['index'])->middleware(['api']);
Route::resource('sellers.categories', SellerCategoriesController::class)->only(['index'])->middleware(['api']);
Route::resource('sellers.buyers', SellerBuyerController::class)->only(['index'])->middleware(['api']);
Route::resource('sellers.products', SellerProductController::class)->only(['index', 'store', 'update', 'destroy'])->middleware(['api']);
