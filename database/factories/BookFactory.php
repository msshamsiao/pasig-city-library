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

        // Retrieve distinct member_library_names from the database
        $memberLibraryNames = \App\Models\MemberLibrary::distinct('member_library_name')->pluck('id')->toArray();

        // Define the schools array using the retrieved data
        $schools = count($memberLibraryNames) > 0 ? $memberLibraryNames : ['Default School A', 'Default School B', 'Default School C'];

        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'subject' => $this->faker->word,
            'isbn' => $isbn,
            'issn' => $issn,
            'available' => $this->faker->boolean,
            'school' => $this->faker->randomElement($schools),
        ];
    }
}
