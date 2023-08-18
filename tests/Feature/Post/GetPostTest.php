<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use Tests\TestCase;

class GetPostTest extends TestCase
{
    private Post $post;

    protected function setUp(): void
    {
        parent::setUp();

        $this->post = Post::factory()
            ->create(['user_id' => $this->getUserId()]);
    }

    public function test_get_post(): void
    {
        $response = $this->get(route('posts.show', [
            'post' => $this->post->id,
        ]));

        $response->assertOk();

        $response->assertJsonStructure([
            'id',
            'photo',
            'user',
            'description',
            'likes',
            'isLiked',
            'comments' => [
                'total',
                'list',
            ],
            'createdAt',
        ]);
    }
}
