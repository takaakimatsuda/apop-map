<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventEditTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        \DB::table('event_categories')->truncate();
    }

    public function test_event_edit_page_can_be_rendered()
    {
        // テスト用のユーザーを作成し、認証
        $user = User::factory()->create();
        $this->actingAs($user);

        // カテゴリーと地域を手動で作成
        $category = Category::create(['category_id' => 1, 'name' => 'バトル']);
        Region::create(['region_id' => 1, 'name' => '東京都']);

        // イベントを作成
        $event = Event::factory()->create([
            'title' => '編集テストイベント',
            'region_id' => 1,
            'venue_name' => '編集テスト会場',
            'user_id' => $user->id,
        ]);

        // イベントにカテゴリーを関連付け
        $event->categories()->attach($category->category_id);

        // 編集ページへのリクエストを送信
        $response = $this->get(route('events.edit', $event->event_id));

        // レスポンスとステータスの確認
        $response->assertStatus(200);
        $response->assertSee($event->title);
        $response->assertSee('バトル');  // カテゴリーが表示されることも確認
    }

    public function test_event_update_validation_error()
    {
        // テスト用のユーザーを作成し、認証
        $user = User::factory()->create();
        $this->actingAs($user);

        // カテゴリーと地域を手動で作成
        Category::create(['category_id' => 1, 'name' => 'バトル']);
        Region::create(['region_id' => 1, 'name' => '東京都']);

        // イベントを作成
        $event = Event::factory()->create([
            'title' => '編集前テストイベント',
            'region_id' => 1,
            'venue_name' => '編集前テスト会場',
            'user_id' => $user->id,
        ]);

        // 不正なデータを送信（必須フィールドが空）
        $response = $this->put(route('events.update', $event->event_id), [
            'title' => '', // 空のタイトル
            'category_id' => [], // カテゴリー未選択
        ]);

        // バリデーションエラーメッセージの確認
        $response->assertSessionHasErrors(['title', 'category_id']);
    }
}
