<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::post('/register', RegisterController::class)
        ->name('register');
    Route::post('/login', LoginController::class)
        ->name('login');

    Route::controller(UserController::class)->group(function () {
        Route::get('/', 'user')->name('current');
        Route::patch('/', 'update')->name('update');
        Route::post('avatar', 'avatar')->name('avatar');
    });
});
