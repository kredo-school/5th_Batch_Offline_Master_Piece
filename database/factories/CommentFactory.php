<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Comment::class;
    public function definition(): array
    {
        return [
            'body' => $this->faker->sentence,
            'thread_id' => 73,
            'guest_id' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ];
    }
}
