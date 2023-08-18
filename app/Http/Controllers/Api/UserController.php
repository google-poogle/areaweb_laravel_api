<?php

namespace App\Http\Controllers\Api;

use App\Facades\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateAvatarRequest;
use App\Http\Resources\User\CurrentUserResource;

class UserController extends Controller
{
    public function user(): CurrentUserResource
    {
        return new CurrentUserResource(auth()->user());
    }

    public function avatar(UpdateAvatarRequest $request)
    {
        return new CurrentUserResource(
            User::updateAvatar($request->avatar())
        );
    }
}
