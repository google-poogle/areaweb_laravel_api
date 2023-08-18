<?php

namespace App\Services\User;

use App\Exceptions\User\InvalidUserCredentialsException;
use App\Http\Resources\User\CurrentUserResource;
use App\Models\User;
use App\Services\User\Data\LoginData;
use App\Services\User\Data\RegisterUserData;
use Laravel\Sanctum\NewAccessToken;

class UserService
{
    public function store(RegisterUserData $data): CurrentUserResource
    {
        return new CurrentUserResource(
            User::query()->create($data->toArray())
        );
    }

    /**
     * @throws InvalidUserCredentialsException
     */
    public function login(LoginData $data): array
    {
        if (! auth()->guard('web')->attempt($data->toArray())) {
            throw new InvalidUserCredentialsException('Invalid user credentials');
        }

        /** @var NewAccessToken $token */
        $token = auth()->user()->createToken('api_login');

        return ['token' => $token->plainTextToken];
    }
}
