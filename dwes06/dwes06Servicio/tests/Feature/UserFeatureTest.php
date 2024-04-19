<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserFeatureTest extends TestCase
{

    public function testGetUserEndpoint()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/api/users/' . $user->id);

        $response->assertStatus(200);
    }
}