<?php

use Modules\Buyer\Http\Controllers\BuyerController;
use Illuminate\Support\Facades\Route;

Route::resource('buyers', BuyerController::class)->middleware(['api'])->only(['index', 'show']);
