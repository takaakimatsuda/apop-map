<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 外部キー制約を一時的に無効化
        Schema::disableForeignKeyConstraints();

        // 'tags' テーブルのデータを削除
        Tag::query()->delete();

        // 外部キー制約を再度有効化
        Schema::enableForeignKeyConstraints();

        // タグデータを挿入
        $now = now();
        Tag::create(['name' => 'アニソン', 'created_at' => $now, 'updated_at' => $now]);
        Tag::create(['name' => 'ボカロ', 'created_at' => $now, 'updated_at' => $now]);
        Tag::create(['name' => 'J-POP', 'created_at' => $now, 'updated_at' => $now]);
        Tag::create(['name' => 'VTuber', 'created_at' => $now, 'updated_at' => $now]);
        Tag::create(['name' => 'ゲーソン', 'created_at' => $now, 'updated_at' => $now]);
    }
}
