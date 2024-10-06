<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // 他のシーダーを呼び出す
        $this->call([
            TagSeeder::class,
            RegionSeeder::class,
            CategorySeeder::class,
            EventSeeder::class,  // 100件のイベントを作成
            EventCategorySeeder::class,  // イベントにランダムにカテゴリーを関連付け
            EventTagSeeder::class, // 中間テーブルのSeederを追加
        ]);
    }
}
