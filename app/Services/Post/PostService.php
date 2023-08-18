<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Services\Post\Data\StorePostData;
use App\Services\Post\Data\UpdatePostData;

class PostService
{
    public function store(StorePostData $data): Post
    {
        return auth()->user()->posts()->create([
            'photo' => uploadImage($data->photo),
            'description' => $data->description,
        ]);
    }

    public function update(Post $post, UpdatePostData $data): Post
    {
        $post->update($data->toArray());

        return $post;
    }
}
