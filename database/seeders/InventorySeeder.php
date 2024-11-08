<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // role_idが3のuser_id（store_id）を取得
        $storeIds = DB::table('users')->where('role_id', 3)->pluck('id')->toArray(); // role_idが3のユーザーID

        // booksのIDを取得
        $bookIds = DB::table('books')->pluck('id')->toArray(); // book_idを取得

        // データが存在するかチェック
        if (empty($storeIds) || empty($bookIds)) {
            $this->command->info('ストアまたは書籍が存在しないため、Seederが実行されません。');
            return;
        }

        // 既に存在するstore_idとbook_idの組み合わせを追跡するためのセット
        $existingCombinations = [];

        // 10件の在庫データを生成
        for ($i = 0; $i < 10; $i++) {
            // ランダムにstore_idとbook_idを選択
            do {
                $storeId = $faker->randomElement($storeIds);
                $bookId = $faker->randomElement($bookIds);
                $combination = $storeId . '-' . $bookId;
            } while (in_array($combination, $existingCombinations)); // 重複しない組み合わせが見つかるまで繰り返す

            // 新しい組み合わせを追加
            $existingCombinations[] = $combination;

            // 在庫データを挿入
            DB::table('inventories')->insert([
                'store_id' => $storeId,
                'book_id' => $bookId,
                'stock' => $faker->numberBetween(1, 15), // 1〜15のランダムな在庫数
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
