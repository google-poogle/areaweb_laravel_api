<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withHeader('Accept', 'application/json');

        $this->user = User::factory()->create();

        Sanctum::actingAs($this->user);
    }
}
