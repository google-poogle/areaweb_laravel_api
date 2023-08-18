<?php

namespace Tests\Feature\User;

use App\Models\Subscription;
use App\Models\User;
use Tests\TestCase;

class GetUserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        Subscription::query()->create([
            'user_id' => $this->user->id,
            'subscriber_id' => $this->getUserId(),
        ]);
    }

    public function test_get_user(): void
    {
        $response = $this->get(route('users.get-user', [
            'user' => $this->user->id,
        ]));

        $response->assertOk();

        $response->assertJsonStructure([
            'id', 'name', 'email', 'subscribers',
            'publications', 'avatar', 'about',
            'isVerified', 'registeredAt',
            'isSubscribed',
        ]);

        $this->assertTrue($response->json('isSubscribed'));

        // TODO: проверять корректность данных
    }

    public function test_user_not_found(): void
    {
        $response = $this->get(route('users.get-user', [
            'user' => 0,
        ]));

        $response->assertNotFound();

        $response->assertJsonStructure(['message']);
    }
}
