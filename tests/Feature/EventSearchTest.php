<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Event;
use App\Models\Region;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class EventSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_search_events_by_name()
    {
        // Arrange: テスト用のデータを作成
        $event = Event::factory()->create(['title' => 'A-POP Battle']);

        // Act: イベント名で検索
        $response = $this->get('/events?search=A-POP');

        // Assert: 検索結果が正しく返される
        $response->assertStatus(200);
        $response->assertSee('A-POP Battle');
    }

    public function test_it_can_filter_events_by_date_range()
    {
        // Arrange: 日付の範囲を超えたイベントを作成
        Event::factory()->create(['date' => '2024-10-01']);
        Event::factory()->create(['date' => '2024-10-15']);

        // Act: 日付範囲で検索
        $response = $this->get('/events?from_date=2024-10-01&to_date=2024-10-10');

        // Assert: 範囲内のイベントだけが表示される
        $response->assertStatus(200);
        $response->assertSee('2024-10-01');
        $response->assertDontSee('2024-10-15');
    }

    public function test_it_can_filter_events_by_category()
    {
        // Arrange: カテゴリごとにイベントを作成
        $category = Category::factory()->create(['name' => 'バトル']);
        $event = Event::factory()->create();
        $event->categories()->attach($category);

        // Act: カテゴリでフィルタリング
        $response = $this->get('/events?category=' . $category->category_id);

        // Assert: カテゴリが一致するイベントが表示される
        $response->assertStatus(200);
        $response->assertSee($event->title);
    }

    public function test_it_can_filter_events_by_region()
    {
        // Arrange: 地域ごとにイベントを作成
        $region = Region::factory()->create(['name' => '東京']);
        $event = Event::factory()->create(['region_id' => $region->region_id]);

        // Act: 地域でフィルタリング
        $response = $this->get('/events?region=' . $region->region_id);

        // Assert: 地域が一致するイベントが表示される
        $response->assertStatus(200);
        $response->assertSee($event->title);
    }

    public function test_it_can_filter_events_by_tags()
    {
        // Arrange: タグ付きイベントを作成
        $tag = Tag::factory()->create(['name' => 'K-pop']);
        $event = Event::factory()->create();
        $event->tags()->attach($tag);

        // Act: タグでフィルタリング
        $response = $this->get('/events?tags[]=' . $tag->tag_id);

        // Assert: タグが一致するイベントが表示される
        $response->assertStatus(200);
        $response->assertSee($event->title);
    }
}
