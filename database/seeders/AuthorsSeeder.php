<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorsSeeder extends Seeder
{
    public function run()
    {
        // 20名の著者を作成
        Author::factory(20)->create();
    }
}