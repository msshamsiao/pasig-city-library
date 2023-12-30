<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        $isbn = $this->faker->unique()->isbn13;

        $issn = $this->faker->optional(0.7)->isbn10;
        $issn = $issn !== null ? $issn : $this->faker->unique()->isbn10;

        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'subject' => $this->faker->word,
            'isbn' => $isbn,
            'issn' => $issn,
            'available' => $this->faker->boolean,
        ];
    }
}
