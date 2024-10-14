<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventRegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        \DB::table('event_categories')->truncate();
    }

    public function test_it_can_register_a_event()
    {
        // テスト用のユーザーを作成し、認証
        $user = User::factory()->create();
        $this->actingAs($user); // ユーザーを認証

        // カテゴリーを手動で作成
        $category1 = Category::create(['category_id' => 1, 'name' => 'バトル']);
        Category::create(['category_id' => 2, 'name' => 'DJ']);
        Category::create(['category_id' => 3, 'name' => '練習会']);
        Category::create(['category_id' => 4, 'name' => 'WS']);

        // 地域を手動で作成
        Region::create(['region_id' => 1, 'name' => '東京都']);

        // イベント登録データ
        $data = [
            'image_url' => null,
            'title' => 'テストイベント',
            'category_id' => [1],
            'region_id' => 1, // 地域IDを指定（1は東京都）
            'date' => '2024-09-18',
            'start_time' => '10:00',
            'end_time' => '12:00',
            'venue_name' => 'テスト会場',
            'venue_address' => 'テスト住所',
            'description' => 'テスト説明文',
            'reference_url' => 'http://example.com',
            'visibility' => 2,
        ];

        // POSTリクエストを送信
        $response = $this->post(route('events.store'), $data);

        // データベースにイベントが登録されたかを確認
        $this->assertDatabaseHas('events', [
            'title' => 'テストイベント',
            'region_id' => 1,
            'venue_name' => 'テスト会場',
        ]);

        // 中間テーブルにカテゴリの関連付けを確認
        $event = Event::where('title', 'テストイベント')->first();

        // リダイレクトされることを確認
        $response->assertRedirect(route('events.my'));

        // セッションにメッセージがあるか確認
        $response->assertSessionHas('success', 'イベントが正常に作成されました。');
    }


    public function test_it_validates_required_fields()
    {
        // テスト用のユーザーを作成し、認証
        $user = User::factory()->create();
        $this->actingAs($user); // ユーザーを認証

        // 空のデータを送信
        $response = $this->post(route('events.store'), []);

        // 必須フィールドのエラーメッセージを確認
        $response->assertSessionHasErrors(['title', 'category_id']);
    }
}
