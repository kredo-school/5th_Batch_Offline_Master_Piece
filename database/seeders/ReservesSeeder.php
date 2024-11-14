<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Book;
use Carbon\Carbon;

class ReservesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // role_idが2のユーザーからランダムにゲストIDを取得
        $guestId = User::where('role_id', 2)->inRandomOrder()->first()->id;
        // role_idが3のユーザーからランダムにストアIDを取得
        $storeId = User::where('role_id', 3)->inRandomOrder()->first()->id;
        // 全ブックからランダムにブックIDを取得
        $bookId = Book::inRandomOrder()->first()->id;

        DB::table('reserves')->insert([
            [
                'guest_id' => $guestId,              // ランダムに取得したguest_id（role_idが2）
                'book_id' => $bookId,                // ランダムに取得したbook_id
                'store_id' => $storeId,              // ランダムに取得したstore_id（role_idが3）
                'quantity' => rand(1, 5),              // 1から5のランダムな数量
                'reservation_number' => 'RES' . rand(10000, 99999), // ランダムな予約番号
                'receiving_date' => Carbon::now()->addDays(rand(1, 3)), // 1日から14日以内のランダムな受取日
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         */
        public function run(): void
        {
            $this->call([
                ReservesSeeder::class,
                // 他のSeederもここに追加可能
            ]);
        }
    }
