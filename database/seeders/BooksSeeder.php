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

                // $store = User::find(1);

                // if ($store && $store->role_id == 3) {
                //     // その店舗が存在し、role_id が 3 (store) の場合に処理
        
                //     // ストアと本の関連付け（ランダムに5冊まで）
                //     $books = Book::inRandomOrder()->take(100)->pluck('id');
                //     $store->store_book()->attach($books);
        
                //     // ストアとゲストの関連付け
                //     $guests = User::where('role_id', 2)->inRandomOrder()->take(100)->pluck('id'); // ランダムに3人のゲスト
                //     $store->store_guest()->attach($guests);
                // } else {
                //     $this->command->warn('User with ID 1 is not found or is not a store.');
                // }
    }
}
