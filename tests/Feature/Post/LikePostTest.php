<?php

namespace Tests\Feature\Post;

use App\Enums\LikeState;
use App\Models\Post;
use Tests\TestCase;

class LikePostTest extends TestCase
{
    private Post $likedPost;

    private Post $unlikedPost;

    protected function setUp(): void
    {
        parent::setUp();

        $this->likedPost = Post::factory()->create([
            'user_id' => $this->getUserId(),
        ]);

        $this->likedPost->likes()->create([
            'user_id' => $this->getUserId(),
        ]);

        $this->unlikedPost = Post::factory()->create([
            'user_id' => $this->getUserId(),
        ]);
    }

    public function test_like_action_to_unliked_post(): void
    {
        $response = $this->post(route('posts.like', [
            'post' => $this->unlikedPost->id,
        ]));

        $response->assertOk();

        $response->assertJsonStructure(['state']);

        $this->assertEquals(LikeState::Liked->value, $response->json('state'));
    }

    public function test_like_action_to_liked_post(): void
    {
        $response = $this->post(route('posts.like', [
            'post' => $this->likedPost->id,
        ]));

        $response->assertOk();

        $response->assertJsonStructure(['state']);

        $this->assertEquals(LikeState::Unliked->value, $response->json('state'));
    }
}
