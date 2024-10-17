<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Thread;
use App\Models\User;

class CommentSeeder extends Seeder
{
    public function run()
    {
        // 全てのスレッドを取得し、各スレッドにランダムなユーザーのコメントを作成
        Thread::all()->each(function ($thread) {
            $thread->comments()->createMany(
                Comment::factory()->count(3)->make([
                    'guest_id' => User::inRandomOrder()->first()->id, // ランダムなユーザーを紐付け
                ])->toArray()
            );
        });
    }
}

