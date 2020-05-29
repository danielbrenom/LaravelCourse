<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Transaction\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| transcactions Routes
|--------------------------------------------------------------------------
*/

Route::resource('transactions', TransactionController::class)->only(['index', 'show'])->middleware(['api']);
