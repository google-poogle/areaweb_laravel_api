<?php

namespace App\Facades;

use App\Services\User\UserService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Models\User store(\App\Services\User\Data\RegisterUserData $data)
 *
 * @see \App\Services\User\UserService
 */
class User extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return UserService::class;
    }
}
