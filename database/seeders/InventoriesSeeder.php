<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use App\Models\Inventory;
use Illuminate\Support\Str;

class InventoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // role_idが3の全てのユーザーを取得
        $users = User::where('role_id', 3)->get();

        // 全ての本を取得
        Book::all()->each(function ($book) use ($users) {
            // ランダムに1人のユーザーを選択
            $user = $users->random();
            

            // 在庫を作成
            Inventory::create([
                'store_id'   => $user->id, // 選択したユーザーのIDをstore_idに設定
                'book_id'    => $book->id,
                'stock'      => rand(1, 20), // ランダムな在庫数を設定
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}

