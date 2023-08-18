<?php

namespace App\Http\Requests\User;

use App\Services\User\Data\LoginData;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'password' => ['required'],
        ];
    }

    public function data(): LoginData
    {
        return LoginData::from($this->validated());
    }
}
