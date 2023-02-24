<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register()
    {
        $user =  [
            'username' => fake()->userName(),
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson('/api/register', $user);

        $response->assertStatus(201);
    }

    public function test_users_cannot_register_with_username_already_used()
    {
        User::factory()->create(['username' => 'coolusername']);

        $user =  [
            'username' => 'coolusername',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson('/api/register', $user);

        $response->assertStatus(422);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/login', [
            'username' => $user->username,
            'password' => 'password'
        ]);

        $response->assertStatus(201);
    }

    public function test_users_cannot_authenticate_with_invalid_login_details()
    {
        $user = User::factory()->create(['password' => 'password']);

        $response = $this->postJson('api/login', [
            'username' => $user->username,
            'password' => 'wrongpassword'
        ]);

        $response->assertStatus(401);
    }
}
