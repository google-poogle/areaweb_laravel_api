<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Services\Post\Data\StorePostData;

class PostService
{
    public function store(StorePostData $data): Post
    {
        return auth()->user()->posts()->create([
            'photo' => uploadImage($data->photo),
            'description' => $data->description,
        ]);
    }
}
