<?php

namespace App\Http\Requests\User;

use App\Services\User\Data\UpdateUserData;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'max:255'],
            'login' => ['nullable', 'unique:users,login', 'max:255'],
            'email' => ['nullable', 'email', 'unique:users,email', 'max:255'],
            'about' => ['nullable', 'max:255'],
            'password' => ['nullable', 'confirmed'],
        ];
    }

    public function data(): UpdateUserData
    {
        return UpdateUserData::from($this->validated());
    }
}
