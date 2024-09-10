<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Event;

class EventListTest extends TestCase
{
    use RefreshDatabase; // テストごとにデータベースをリフレッシュ

    /**
     * イベント一覧が正しく表示されるかをテスト
     */
    public function test_events_are_displayed_correctly(): void
    {
        // テストデータを作成
        Event::factory()->count(24)->create(); // 24件のイベントを作成

        // イベント一覧ページにアクセス
        $response = $this->get('/events');

        // ステータスコード200を確認
        $response->assertStatus(200);

        // 1ページ目に24件のイベントが表示されていることを確認
        for ($i = 1; $i <= 24; $i++) {
            $response->assertSee("イベント$i");
        }
    }

    /**
     * ページネーションが正しく動作するかをテスト
     */
    public function test_events_pagination_works_correctly(): void
    {
        // 48件のイベントデータを作成（ページ2が表示されることを確認するために十分な数）
        Event::factory()->count(48)->create();

        // 1ページ目のイベント一覧にアクセス
        $response = $this->get('/events?page=1');
        $response->assertStatus(200);

        // 1ページ目に24件のイベントが見えるか確認
        for ($i = 1; $i <= 24; $i++) {
            $response->assertSee("イベント$i");
        }

        // 2ページ目にアクセスして確認
        $response = $this->get('/events?page=2');
        $response->assertStatus(200);

        // 2ページ目に残りのイベントが表示されていることを確認
        for ($i = 25; $i <= 48; $i++) {
            $response->assertSee("イベント$i");
        }
    }

    /**
     * イベントがない場合の処理をテスト
     */
    public function test_no_events_message_displayed_when_no_events_exist(): void
    {
        // イベントが存在しない状態で一覧ページにアクセス
        $response = $this->get('/events');

        // ステータスコード200を確認
        $response->assertStatus(200);

        // "イベントがありません"のメッセージが表示されているか確認
        $response->assertSee('イベントがありません');
    }
}
