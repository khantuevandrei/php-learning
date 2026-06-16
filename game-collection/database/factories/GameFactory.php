<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'genre' => fake()->randomElement(['RPG', 'Action', 'Adventure', 'Simulaton']),
            'platform' => fake()->randomElement(['PC', 'PlayStation', 'Xbox', 'Nintendo']),
            'description' => fake()->paragraph()
        ];
    }
}
