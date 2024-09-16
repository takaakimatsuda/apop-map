<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // カテゴリーIDのリストを取得（4つのカテゴリー）
        $categoryIds = DB::table('categories')->pluck('category_id')->toArray();

        // イベントIDを取得し、ランダムにカテゴリーを関連付ける
        $eventIds = DB::table('events')->pluck('event_id')->toArray();

        foreach ($eventIds as $eventId) {
            // ランダムで1〜4個のカテゴリーを選択
            $randomCategories = collect($categoryIds)->random(rand(1, 4))->toArray();

            // 選択したカテゴリーをevent_categoriesテーブルに挿入
            foreach ($randomCategories as $categoryId) {
                DB::table('event_categories')->insert([
                    'event_id' => $eventId,
                    'category_id' => $categoryId,
                ]);
            }
        }
    }
}
