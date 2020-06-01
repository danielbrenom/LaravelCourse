<?php

use Modules\Buyer\Http\Controllers\BuyerCategoriesController;
use Modules\Buyer\Http\Controllers\BuyerController;
use Illuminate\Support\Facades\Route;
use Modules\Buyer\Http\Controllers\BuyerProductsController;
use Modules\Buyer\Http\Controllers\BuyerSellerController;
use Modules\Buyer\Http\Controllers\BuyerTransactionController;

Route::resource('buyers', BuyerController::class)->middleware(['api'])->only(['index', 'show']);
Route::resource('buyers.transactions', BuyerTransactionController::class)->middleware(['api'])->only(['index']);
Route::resource('buyers.products', BuyerProductsController::class)->middleware(['api'])->only(['index']);
Route::resource('buyers.sellers', BuyerSellerController::class)->middleware(['api'])->only(['index']);
Route::resource('buyers.categories', BuyerCategoriesController::class)->middleware(['api'])->only(['index']);
