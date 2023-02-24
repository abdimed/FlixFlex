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
            ->postJson('/api/favorites/' . $title->id . '/store');

        $response->assertCreated();

        $this->assertTrue($user->favorites->contains($title->id));;
    }

    public function  test_user_can_remove_title_from_favorite_list()
    {
        $user = User::factory()->create();

        $title = Title::factory()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/favorites/' . $title->id . '/delete');

        $response->assertSuccessful();

        $this->assertFalse($user->favorites->contains($title->id));;
    }

    public function test_user_can_view_the_list_of_my_facorite_movies_and_series()
    {

        $user = User::factory()->create();

        $titles = Title::factory(2)->create();

        $user->favorites()->attach($titles);

        $response = $this->actingAs($user)
            ->getJson('/api/favorites');

        $response
            ->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }
}
