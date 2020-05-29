<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Products\Http\Controllers\ProductsController;

/*
|--------------------------------------------------------------------------
| products Routes
|--------------------------------------------------------------------------
*/

Route::resource('products', ProductsController::class)->middleware(['api'])->only(['index', 'show']);
