<?php

namespace App\Facades;

use App\Services\Post\PostService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Models\Post store(\App\Services\Post\Data\StorePostData $data)
 *
 * @see \App\Services\User\UserService
 */
class Post extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return PostService::class;
    }
}
