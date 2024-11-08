<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) { // 50冊の本を生成
            Book::create([
                'title' => $faker->sentence(3), // 3単語のタイトル
                'description' => $faker->paragraph(2), // 4文の説明
                'publication_date' => $faker->date(), // ランダムな出版日
                'publisher' => $faker->company, // 出版社の名前
                'isbn_code' => $faker->unique()->isbn13, // ランダムなISBN-13
                'price' => $faker->numberBetween(10, 200) * 10, // 5～100のランダムな価格
                'image' => 'https://unsplash.it/300/400/?random' . $faker->unique()->numberBetween(1, 1000), // 本っぽいランダムな画像
                'deleted_at' => null, // 削除されていない状態
            ]);
        }
    }
}
