<?php

namespace Database\Factories;

use App\Models\Thread;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


class ThreadFactory extends Factory
{
    protected $model = Thread::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'user_id' => User::factory(),  // ユーザーIDが必要
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Thread $thread) {
            // 1～3個のランダムなジャンルを関連付け
            $genres = Genre::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $thread->genres()->attach($genres);
        });
    }
}
