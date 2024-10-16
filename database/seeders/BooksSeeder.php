<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\User;

class BooksSeeder extends Seeder
{
    public function run()
    {
        // 10冊の本とその著者を作成
        Book::factory(10)->create()->each(function ($book) {
            // 本が生成された後に、著者をランダムに関連付け
            $authors = Author::inRandomOrder()->take(2)->pluck('id');
            $book->authors_books()->attach($authors); // attach で中間テーブルにデータを挿入
        });

        // ストアと本の関連付け
        User::where('role_id', 3)->get()->each(function ($store) {
            $books = Book::inRandomOrder()->take(rand(1, 5))->pluck('id');
            $store->store_book()->attach($books);
        });

        // ストアとゲストの関連付け
        $stores = User::where('role_id', 3)->get();
        $guests = User::where('role_id', 2)->get();
        
        $stores->each(function ($store) use ($guests) {
            $store->store_guest()->attach($guests->random(rand(1, 3))->pluck('id')->toArray());
        });
    }
}
