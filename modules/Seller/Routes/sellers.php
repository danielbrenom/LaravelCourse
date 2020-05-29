<?php

use Illuminate\Support\Facades\Route;
use Modules\Seller\Http\Controllers\SellerController;

/*
|--------------------------------------------------------------------------
| sellers Routes
|--------------------------------------------------------------------------
*/

Route::resource('sellers', SellerController::class)->only(['index', 'show'])->middleware(['api']);
