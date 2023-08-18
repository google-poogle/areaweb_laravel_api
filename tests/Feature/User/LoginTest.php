<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_success_auth_with_email(): void
    {
        $response = $this->post(route('user.login'), [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response->assertOk();

        $response->assertJsonStructure(['token']);
    }

    public function test_success_auth_with_login(): void
    {
        $response = $this->post(route('user.login'), [
            'login' => $this->user->login,
            'password' => 'password',
        ]);

        $response->assertOk();

        $response->assertJsonStructure(['token']);
    }
}
