<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Thread;
use App\Models\User;

class ThreadSeeder extends Seeder
{
    public function run()
    {
        // 既存のユーザーからランダムに5人を選び、各ユーザーに2つのスレッドを作成
        User::inRandomOrder()->take(3)->get()->each(function ($user) {
            $user->threads()->createMany(
                Thread::factory()->count(1)->make()->toArray()
            );
        });
    }
}
