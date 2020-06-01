<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Transaction\Http\Controllers\TransactionCategoryController;
use Modules\Transaction\Http\Controllers\TransactionController;
use Modules\Transaction\Http\Controllers\TransactionSellerController;

/*
|--------------------------------------------------------------------------
| transcactions Routes
|--------------------------------------------------------------------------
*/

Route::resource('transactions', TransactionController::class)->only(['index', 'show'])->middleware(['api']);
Route::resource('transactions.categories', TransactionCategoryController::class)->only('index')->middleware(['api']);
Route::resource('transactions.seller', TransactionSellerController::class)->only('index')->middleware(['api']);