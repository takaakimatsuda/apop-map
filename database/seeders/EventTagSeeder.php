<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Tag;

class EventTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 全イベントを取得して、ランダムにタグを紐付け
        $events = Event::all();
        $tags = Tag::all();

        foreach ($events as $event) {
            // タグをランダムに1〜3個紐付け
            $event->tags()->attach(
                $tags->random(rand(1, 3))->pluck('tag_id')->toArray()
            );
        }
    }
}
