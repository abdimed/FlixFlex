<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register()
    {
        $user =  [
            'username' =>  fake()->userName(),
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson('/api/register', $user);

        $response
            ->assertStatus(201)
            ->assertJson(fn (AssertableJson $json) => $json->has('auth_token')->etc());
    }
}
