<?php

namespace App\Http\Controllers\Api;

use App\Facades\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post as PostModel;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('post.access')
            ->only('destroy');
    }

    public function index()
    {

    }

    public function store(StorePostRequest $request)
    {
        return new PostResource(
            Post::store($request->data())
        );
    }

    public function show(PostModel $post)
    {
        return new PostResource($post);
    }

    public function update(UpdatePostRequest $request, PostModel $post)
    {
        return new PostResource(
            Post::update($post, $request->data())
        );
    }

    public function destroy(PostModel $post)
    {
        $post->delete();

        return response()->noContent();
    }
}
