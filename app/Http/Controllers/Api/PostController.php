<?php

namespace App\Http\Controllers\Api;

use App\Facades\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\AddCommentRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Comment\CommentResource;
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

    public function like(PostModel $post)
    {
        return response()->json([
            'state' => $post->like(),
        ]);
    }

    public function addComment(PostModel $post, AddCommentRequest $request)
    {
        return new CommentResource(
            $post->comments()
                ->create($request->data()->toArray())
        );
    }
}
