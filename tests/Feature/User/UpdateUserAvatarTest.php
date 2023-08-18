<?php

namespace Tests\Feature\User;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UpdateUserAvatarTest extends TestCase
{
    public function test_success_update_avatar(): void
    {
        $response = $this->post(route('user.avatar'), [
            'avatar' => UploadedFile::fake()
                ->image('avatar.png'),
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            'id', 'name', 'email', 'subscribers',
            'publications', 'avatar', 'about',
            'isVerified', 'registeredAt',
        ]);

        $this->assertIsString($response->json('avatar'));
    }

    public function test_update_avatar_validation_type()
    {
        $response = $this->post(route('user.avatar'), [
            'avatar' => UploadedFile::fake()
                ->image('avatar.gif'),
        ]);

        $response->assertUnprocessable();

        $response->assertJsonValidationErrors(['avatar']);
    }

    public function test_update_avatar_validation_size()
    {
        $response = $this->post(route('user.avatar'), [
            'avatar' => UploadedFile::fake()
                ->image('avatar.png')
                ->size(2000),
        ]);

        $response->assertUnprocessable();

        $response->assertJsonValidationErrors(['avatar']);
    }
}
