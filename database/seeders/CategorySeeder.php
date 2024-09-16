<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // カテゴリーデータの挿入
        DB::table('categories')->insert([
            ['name' => 'バトル'],
            ['name' => 'DJ'],
            ['name' => '練習会'],
            ['name' => 'WS'],
        ]);
    }
}
