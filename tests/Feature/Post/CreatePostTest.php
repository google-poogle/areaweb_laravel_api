<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    public function test_create_post(): void
    {
        $data = [
            'photo' => UploadedFile::fake()->image('image.png'),
            'description' => fake()->sentence,
        ];

        $response = $this->post(route('posts.store'), $data);

        $response->assertCreated();

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

        $response->assertJson([
            'description' => Arr::get($data, 'description'),
            'likes' => 0,
            'isLiked' => false,
            'comments' => [
                'total' => 0,
                'list' => [],
            ],
        ]);

        $this->assertDatabaseHas(Post::class, [
            'id' => $response->json('id'),
            'photo' => $response->json('photo'),
            'description' => $response->json('description'),
        ]);
    }

    // TODO: проверка валидации
}
