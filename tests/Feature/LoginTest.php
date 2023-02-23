<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/login', [
            'username' => $user->username,
            'password' => 'password'
        ]);

        $response
            ->assertOk()
            ->assertJson(fn (AssertableJson $json) => $json->has('auth_token')->etc());
    }

    public function test_users_can_not_authenticate_with_invalid_login_details()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/login', [
            'username' => $user->username,
            'password' => 'wrongpassword'
        ]);

        $response
            ->assertStatus(401);
    }
}
