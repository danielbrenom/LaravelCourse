<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| category Routes
|--------------------------------------------------------------------------
*/

Route::resource('categories', CategoryController::class)->middleware(['api'])->except(['create', 'edit']);

