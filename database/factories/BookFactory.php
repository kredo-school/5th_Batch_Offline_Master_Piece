<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'publication_date' => $this->faker->date(),
            'publisher' => $this->faker->company(),
            'isbn_code' => $this->faker->unique()->isbn13(),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'image' => $this->faker->imageUrl(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Book $book) {
            // 1～3個のランダムなジャンルを関連付け
            $genres = Genre::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $book->genre_book()->attach($genres);
        });
    }
}
