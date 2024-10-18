<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 900人のユーザーを作成
        User::factory(count: 100)->create()->each(function ($user) {
            // 各ユーザーに対応するプロフィールを作成
            Profile::factory()->create([
                'user_id' => $user->id,  // user_idを適切に設定
            ]);
        });
    }
}
