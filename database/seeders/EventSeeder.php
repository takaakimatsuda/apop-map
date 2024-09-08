<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            // 今年の1月1日から12月31日までのランダムな日付を生成
            $randomDate = Carbon::now()->startOfYear()->addDays(rand(0, 364))->toDateString();

            DB::table('events')->insert([
                'event_id' => $i,
                'user_id' => 1,  // 全て同じユーザーとして挿入する場合
                'title' => 'イベント' . $i,
                'image_url' => NULL,
                'dance_genre' => 'POP',
                'region' => '東京',
                'venue_name' => '会場' . $i,
                'venue_address' => '東京都の会場' . $i,
                'description' => 'イベントの説明文' . $i,
                'reference_url' => NULL,
                'date' => $randomDate,  // ランダムな日付を使用
                'start_time' => NULL,
                'end_time' => NULL,
                'location' => '場所' . $i,
                'category_id' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
