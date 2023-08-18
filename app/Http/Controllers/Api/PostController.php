<?php

namespace App\Http\Controllers\Api;

use App\Facades\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post as PostModel;
use Illuminate\Http\Request;

class PostController extends Controller
{
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
        //
    }

    public function update(Request $request, PostModel $post)
    {
        //
    }

    public function destroy(PostModel $post)
    {
        //
    }
}
