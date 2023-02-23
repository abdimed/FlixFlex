<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Title>
 */
class TitleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = $this->faker->randomElement(['movie', 'tv']);

        $response = Http::get("https://api.themoviedb.org/3/discover/{$type}", [
            'api_key' => config('services.tmdb.key'),
        ]);

        $titles = $response->json()['results'];

        $title = $this->faker->randomElement($titles);

        return [
            'name' => $title['title'] ?? $title['name'],
            'type' => $type === 'tv' ? 'serie' : 'movie',
            'overview' => $title['overview']
        ];
    }
}
