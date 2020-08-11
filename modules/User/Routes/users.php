<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| users Routes
|--------------------------------------------------------------------------
*/

Route::resource('users', UserController::class)->except(['create', 'edit'])->middleware(['api']);
Route::name('verify')->get('users/verify/{token}', UserController::class.'@verify');
Route::name('resend')->get('users/{user}/resend',UserController::class.'@resend');