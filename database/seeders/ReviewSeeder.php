<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Str;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ユーザーと本が存在する前提でレビューを作成します
        $users = User::inRandomOrder()->take(10)->get();  
        $books = Book::inRandomOrder()->take(5)->get();  

        // 各ユーザーが各本に対してレビューを投稿
        foreach ($users as $user) {
            foreach ($books as $book) {
                Review::create([
                    'guest_id'   => $user->id,
                    'book_id'    => $book->id,
                    'star_count' => rand(1, 5),
                    'title'      => 'Review by ' . $user->name,
                    'body'       => Str::random(50),  // 短い本文
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}