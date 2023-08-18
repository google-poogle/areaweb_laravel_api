<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)
    ->prefix('users')
    ->as('users.')
    ->group(function () {
        Route::get('/{user}', 'getUser')
            ->name('get-user');
    });
