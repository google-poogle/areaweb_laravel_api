<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class GetPostsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'limit' => ['required', 'int', 'min:1', 'max:100'],
            'offset' => ['required', 'int', 'min:0'],
        ];
    }

    public function limit(): int
    {
        return $this->input('limit');
    }

    public function offset(): int
    {
        return $this->input('offset');
    }
}