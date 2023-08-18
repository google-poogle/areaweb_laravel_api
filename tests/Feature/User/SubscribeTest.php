<?php

namespace Tests\Feature\User;

use App\Enums\SubscribeState;
use App\Models\Subscription;
use App\Models\User;
use Tests\TestCase;

class SubscribeTest extends TestCase
{
    private User $unsubscribedUser;

    private User $subscribedUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->unsubscribedUser = User::factory()->create();

        $this->subscribedUser = User::factory()
            ->create();

        Subscription::factory()->create([
            'user_id' => $this->subscribedUser->id,
            'subscriber_id' => $this->getUserId(),
        ]);
    }

    public function test_subscribe_to_unsubscribed_user(): void
    {
        $response = $this->post(route('users.subscribe', [
            'user' => $this->unsubscribedUser->id,
        ]));

        $response->assertOk();

        $this->assertEquals(SubscribeState::Subscribed->value, $response->json('state'));
    }

    public function test_subscribe_to_subscribed_user(): void
    {
        $response = $this->post(route('users.subscribe', [
            'user' => $this->subscribedUser->id,
        ]));

        $response->assertOk();

        $this->assertEquals(SubscribeState::Unsubscribed->value, $response->json('state'));
    }
}
