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

    // protected function setUp():void
    // {
    //     User::factory()->create(
    //         [
    //             'username' => 'admin',
    //             'password' => 'password',
    //         ]
    //     );
    // }

    public function test_user_can_login()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/login', [
            'username' => $user->username,
            'password' => 'password'
        ]);

        $response
            ->assertJson(fn (AssertableJson $json) => $json->has('auth_token')->etc());
    }
}
