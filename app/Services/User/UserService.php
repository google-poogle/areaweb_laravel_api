<?php

namespace App\Services\User;

use App\Http\Resources\User\CurrentUserResource;
use App\Models\User;
use App\Services\User\Data\RegisterUserData;

class UserService
{
    public function store(RegisterUserData $data): CurrentUserResource
    {
        return new CurrentUserResource(
            User::query()->create($data->toArray())
        );
    }

    public function login(): array
    {

    }
}
