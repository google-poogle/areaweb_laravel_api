<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use Illuminate\Support\Arr;
use Tests\TestCase;

class UpdatePostTest extends TestCase
{
    private Post $post;

    protected function setUp(): void
    {
        parent::setUp();

        $this->post = Post::factory()->create([
            'user_id' => $this->getUserId(),
        ]);
    }

    public function test_update_post(): void
    {
        $data = [
            'description' => fake()->sentence,
        ];

        $response = $this->patch(route('posts.update', [
            'post' => $this->post->id,
        ]), $data);

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

        $this->assertDatabaseHas(Post::class, [
            'id' => $this->post->id,
            'description' => Arr::get($data, 'description'),
        ]);
    }
}
