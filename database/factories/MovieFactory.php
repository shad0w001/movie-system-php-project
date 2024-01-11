<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'release_date' => $this->faker->year,
            'genre' => $this->faker->word,
            'image' => $this->faker->image(storage_path('../public/storage/films'), 300, 300, null, false),
            'language' => 'English',
            'status' => 'In Production',
            'score' => 5
        ];
    }
}