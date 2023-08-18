<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Support\Arr;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_success_register(): void
    {
        $data = [
            'name' => fake()->name,
            'login' => fake()->unique()->userName,
            'email' => fake()->unique()->email,
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];

        $response = $this->post(route('user.register'), $data);

        $response->assertCreated();

        $response->assertJsonStructure([
            'id', 'name', 'email', 'subscribers',
            'publications', 'avatar', 'about',
            'isVerified', 'registeredAt',
        ]);

        $response->assertJson([
            'name' => Arr::get($data, 'name'),
            'email' => Arr::get($data, 'email'),
            'subscribers' => 0,
            'publications' => 0,
            'avatar' => null,
            'about' => null,
            'isVerified' => false,
        ]);

        $this->assertDatabaseHas(User::class, [
            'id' => $response->json('id'),
            'name' => Arr::get($data, 'name'),
            'email' => Arr::get($data, 'email'),
            'login' => Arr::get($data, 'login'),
        ]);
    }

    public function test_register_validation(): void
    {
        $response = $this->post(route('user.register'), [
            'name' => null,
            'login' => null,
            'email' => 'maximareaweb.su',
            'password' => '12345678',
            'password_confimation' => '123',
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['name', 'login', 'email', 'password']);
    }
}
