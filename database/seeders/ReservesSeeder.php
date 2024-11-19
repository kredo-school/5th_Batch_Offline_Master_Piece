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
        // 複数のreservation_numberを作成
        $numberOfReservations = rand(1, 5); // 1から10件の予約を作成
        for ($i = 0; $i < $numberOfReservations; $i++) {
            // 新しい予約番号を生成
            $reservationNumber = 'RES' . rand(10000, 99999);

            // 各reservation_numberにランダムで1〜10件の予約を作成
            $reservationsForThisNumber = rand(1, 5);
            for ($j = 0; $j < $reservationsForThisNumber; $j++) {
                // role_idが2のユーザーからランダムにゲストIDを取得
                $guestId = User::where('role_id', 2)->inRandomOrder()->first()->id;
                // role_idが3のユーザーからランダムにストアIDを取得
                $storeId = User::where('role_id', 3)->inRandomOrder()->first()->id;
                // 全ブックからランダムにブックIDを取得
                $bookId = Book::inRandomOrder()->first()->id;

                // 予約を挿入
                DB::table('reserves')->insert([
                    [
                        'guest_id' => $guestId,                      // ランダムに取得したguest_id（role_idが2）
                        'book_id' => $bookId,                        // ランダムに取得したbook_id
                        'store_id' => $storeId,                      // ランダムに取得したstore_id（role_idが3）
                        'quantity' => rand(1, 3),                    // 1から3のランダムな数量
                        'reservation_number' => $reservationNumber,  // 同じreservation_numberで複数作成
                        'receiving_date' => Carbon::now()->addDays(rand(1, 3)), // 1日から3日以内のランダムな受取日
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ],
                ]);
            }
        }
    }
}
