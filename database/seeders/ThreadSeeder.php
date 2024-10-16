<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Thread;
use App\Models\User;

class ThreadSeeder extends Seeder
{
    public function run()
    {
        // 5人のユーザーを作成し、各ユーザーに2つのスレッドを作成
        User::factory()->count(5)->create()->each(function ($user) {
            $user->threads()->createMany(
                Thread::factory()->count(2)->make()->toArray()
            );
        });
    }
}
