<?php

namespace Tests\Feature;

use App\Models\Title;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TitleTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_view_movies_and_series_on_different_pages()
    {
        $response = $this->getJson('/api/titles');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next'
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'path',
                    'per_page',
                    'to',
                    'total'
                ]
            ]);
    }

    public function test_users_can_view_movies_and_series_in_batches_of_10()
    {
        Title::factory(10)->create();

        $response = $this->getJson('/api/titles');

        $response
            ->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    public function test_users_can_view_the_details_of_a_movie_or_serie()
    {
        $title = Title::factory()->create();

        $response = $this->getJson('/api/titles', [$title]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['id' => $title->id]);
    }

    public function test_users_can_search_a_movie_or_serie()
    {

        $title = Title::factory()->create();

        $response = $this->getJson('/api/search?keyword=' . $title->name);

        $response->assertJsonFragment(['id' => $title->id]);
    }
}
