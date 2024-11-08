<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ReceiptsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // ユーザーID（role_idが2やそれ以外でもOK）
        $userIds = DB::table('users')->pluck('id')->toArray();

        // ストアID（role_idが3のユーザーだけ取得）
        $storeIds = DB::table('users')->where('role_id', 3)->pluck('id')->toArray();

        // データが存在するか確認
        if (empty($userIds) || empty($storeIds)) {
            $this->command->info('ユーザーまたはストアが存在しないため、Seederが実行されません。');
            return;
        }

        // 10件のレシートデータを生成
        for ($i = 0; $i < 10; $i++) {
            DB::table('receipts')->insert([
                'user_id' => $faker->randomElement($userIds), // ランダムにユーザーIDを選択
                'store_id' => $faker->randomElement($storeIds), // role_idが3のユーザーIDをstore_idとして使用
                'quantity' => $faker->numberBetween(1, 10), // 購入数量
                'total_amount' => $faker->randomFloat(2, 100, 1000), // 100～1000のランダムな合計金額
                'received_amount' => $faker->randomFloat(2, 100, 1000), // 100～1000のランダムなお預かり金額
                'change_amount' => $faker->randomFloat(2, 0, 100), // 0～100のランダムなお釣り金額
                'payment_method' => $faker->randomElement(['cash', 'credit_card', 'debit_card', 'paypal']), // ランダムな支払い方法
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
