<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductController::class);
Route::post('products/{product}/review', [ProductController::class, 'review'])
    ->name('products.review');

Route::controller(UserController::class)->group(function () {
    Route::post('login', 'login')->name('login');
});
