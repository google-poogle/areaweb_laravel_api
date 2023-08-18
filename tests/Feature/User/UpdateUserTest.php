<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Support\Arr;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    public function test_success_update_user(): void
    {
        $data = [
            'name' => fake()->name,
            'login' => fake()->unique()->userName,
            'email' => fake()->unique()->email,
            'about' => 'Как же круто, что я умею делать крутой API на Laravel',
        ];

        $response = $this->patch(route('user.update'), $data);

        $response->assertOk();

        $response->assertJsonStructure([
            'id', 'name', 'email', 'subscribers',
            'publications', 'avatar', 'about',
            'isVerified', 'registeredAt',
        ]);

        $response->assertJson([
            'name' => Arr::get($data, 'name'),
            'login' => Arr::get($data, 'login'),
            'email' => Arr::get($data, 'email'),
            'about' => Arr::get($data, 'about'),
        ]);

        $this->assertDatabaseHas(User::class, [
            'id' => $this->getUserId(),
            'name' => Arr::get($data, 'name'),
            'login' => Arr::get($data, 'login'),
            'email' => Arr::get($data, 'email'),
            'about' => Arr::get($data, 'about'),
        ]);
    }

    // TODO: проверка валидации и пароля
}
