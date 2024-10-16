<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Thread;
use App\Models\User;


class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'body' => $this->faker->sentence,
            // 50% の確率で image フィールドが null、そうでない場合は画像URLを生成
            'image' => $this->faker->imageUrl(),
            'guest_id' => User::factory(), // ランダムなユーザー
            'thread_id' => Thread::factory(), // ランダムなスレッド
        ];
    }
}
