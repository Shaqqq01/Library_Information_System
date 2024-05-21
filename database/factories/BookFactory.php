<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'publisher_name' => $this->faker->company,
            'published_year' => $this->faker->year,
            'category' => $this->faker->randomElement(['Novel', 'Religion', 'Academic', 'Children', 'General Readings']),
        ];
    }
}
