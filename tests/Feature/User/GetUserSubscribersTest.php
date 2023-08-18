<?php

namespace Tests\Feature\User;

use App\Models\Subscription;
use App\Models\User;
use Tests\TestCase;

class GetUserSubscribersTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()
            ->has(
                Subscription::factory(5)
                    ->for(User::factory(), 'subscriber')
            )
            ->create();
    }

    public function test_get_subscribers(): void
    {
        $response = $this->get(route('users.subscribers', [
            'user' => $this->user->id,
        ]));

        $response->assertOk();
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'email',
                'login',
                'avatar',
                'isVerified',
                'isSubscribed',
            ],
        ]);
    }
}
