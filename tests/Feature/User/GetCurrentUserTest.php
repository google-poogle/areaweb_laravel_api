<?php

namespace Tests\Feature\User;

use Tests\TestCase;

class GetCurrentUserTest extends TestCase
{
    public function test_success_get_current_user(): void
    {
        $response = $this->get(route('user.current'));

        $response->assertOk();

        $response->assertJsonStructure([
            'id', 'name', 'email', 'subscribers',
            'publications', 'avatar', 'about',
            'isVerified', 'registeredAt',
        ]);

        // TODO: проверить возвращаемые данные
    }
}
