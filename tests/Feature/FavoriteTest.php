<?php

namespace Tests\Feature;

use App\Models\Title;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;

    public function  test_user_can_add_title_to_favorite_list()
    {
        $user = User::factory()->create();

        $title = Title::factory()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/title/' . $title->id . '/favorite/store');

        $response->assertCreated();

        $this->assertTrue($user->favorites->contains($title->id));
    }
}
