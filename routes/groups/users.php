<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)
    ->prefix('users')
    ->as('users.')
    ->group(function () {
        Route::get('/{user}', 'getUser')
            ->name('get-user');
        Route::get('/{user}/subscribers', 'subscribers')
            ->name('subscribers');
        Route::post('/{user}/subscribe', 'subscribe')
            ->name('subscribe');
        Route::get('/{user}/posts', 'posts')
            ->name('posts');
    });
