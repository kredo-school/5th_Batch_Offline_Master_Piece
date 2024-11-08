<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Str;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        // 全ての本を取得
        Book::all()->each(function ($book) {
            // ランダムなユーザーを3人取得
            $users = User::inRandomOrder()->take(3)->get();

            // 各ユーザーが本に対してレビューを投稿
            $users->each(function ($user) use ($book) {
                Review::create([
                    'guest_id'   => $user->id,
                    'book_id'    => $book->id,
                    'star_count' => rand(1, 5), // ランダムな星の数を設定
                    'title'      => 'Review by ' . $user->name,
                    'body'       => Str::random(50), // 短い本文
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            });
        });
    }
}
