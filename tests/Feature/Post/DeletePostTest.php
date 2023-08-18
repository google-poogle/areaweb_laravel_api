<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class DeletePostTest extends TestCase
{
    private Post $post;

    private Post $someonePost;

    protected function setUp(): void
    {
        parent::setUp();

        $this->post = Post::factory()
            ->create(['user_id' => $this->getUserId()]);

        $this->someonePost = Post::factory()
            ->for(User::factory())
            ->create();
    }

    public function test_delete_post(): void
    {
        $response = $this->delete(route('posts.destroy', [
            'post' => $this->post->id,
        ]));

        $response->assertNoContent();

        $this->assertDatabaseMissing(Post::class, [
            'id' => $this->post->id,
        ]);
    }

    public function test_delete_someone_post(): void
    {
        $response = $this->delete(route('posts.destroy', [
            'post' => $this->someonePost->id,
        ]));

        $response->assertForbidden();

        $response->assertJsonStructure(['message']);
    }
}
