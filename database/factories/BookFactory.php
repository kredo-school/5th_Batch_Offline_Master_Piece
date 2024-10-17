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
    public function definition(): array
    {
        $imagePath = public_path('images/649634.png');
        $imageData = base64_encode(file_get_contents($imagePath));
                $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
                $base64Image = 'data:image/' . $extension . ';base64,' . $imageData;

        return [
            'title' => $this->faker->name,
            'description' =>  $this->faker->sentence,
            'publication_date' =>  $this->faker->dateTime,
            'publisher' =>  $this->faker->name,
            'isbn_code' =>  $this->faker->randomNumber,
            'price' =>  $this->faker->randomNumber,
            'image' => $base64Image,
        ];
    }
}
