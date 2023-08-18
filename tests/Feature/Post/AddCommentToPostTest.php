<?php

namespace Tests\Feature\Post;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Arr;
use Tests\TestCase;

class AddCommentToPostTest extends TestCase
{
    private Post $post;

    protected function setUp(): void
    {
        parent::setUp();

        $this->post = Post::factory()->create([
            'user_id' => $this->getUserId(),
        ]);
    }

    public function test_add_comment_to_post(): void
    {
        $data = [
            'comment' => fake()->sentence,
        ];

        $response = $this->post(route('posts.comment', [
            'post' => $this->post->id,
        ]), $data);

        $response->assertCreated();

        $response->assertJsonStructure([
            'id',
            'user' => [
                'id', 'name', 'avatar',
            ],
            'comment',
            'createdAt',
        ]);

        $response->json([
            'comment' => Arr::get($data, 'comment'),
        ]);

        $this->assertDatabaseHas(Comment::class, [
            'id' => $response->json('id'),
            'comment' => Arr::get($data, 'comment'),
            'user_id' => $this->getUserId(),
        ]);
    }

    // TODO: добавить проверку валидации
}
