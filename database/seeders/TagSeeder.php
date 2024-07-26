<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::truncate();
        $now = now();
        Tag::create(['name' => 'アニソン', 'created_at' => $now, 'updated_at' => $now]);
        Tag::create(['name' => 'ボカロ', 'created_at' => $now, 'updated_at' => $now]);
        Tag::create(['name' => 'J-POP', 'created_at' => $now, 'updated_at' => $now]);
        Tag::create(['name' => 'Vtuber', 'created_at' => $now, 'updated_at' => $now]);
        Tag::create(['name' => 'ゲーソン', 'created_at' => $now, 'updated_at' => $now]);

        Tag::factory()->count(3)->create();
    }
}
