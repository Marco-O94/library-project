<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'quantity' => $this->faker->numberBetween(1, 20),
            'isbn' => $this->faker->isbn13,
            'image' => $this->faker->imageUrl(640, 480, 'books', true, 'Faker'),
            'publisher' => $this->faker->company,
        ];

    }
}
