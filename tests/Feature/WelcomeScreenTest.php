<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WelcomeScreenTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome_screen_can_be_rendered()
    {
        // Act: Welcomeページにアクセス
        $response = $this->get('/');

        // Assert: ページが正常に表示されるかを確認
        $response->assertStatus(200);
        $response->assertSee('A-POP MAP');  // タイトルが表示されていることを確認
    }

    public function test_welcome_screen_displays_events()
    {
        // Arrange: テストカテゴリとイベントデータを作成
        $category = Category::factory()->create(['name' => 'バトル']);
        $event = Event::factory()->create([
            'title' => 'テストイベント',
            'visibility' => 2, // 公開イベント
            'date' => now() // 現在の日付など
        ]);

        // 中間テーブルにカテゴリを関連付ける
        $event->categories()->attach($category->category_id);

        // Act: TOPページにアクセス
        $response = $this->get('/');

        // Assert: イベントタイトルが表示されているかを確認
        $response->assertStatus(200);
        $response->assertSee('テストイベント');
    }


    public function test_search_button_is_present()
    {
        // Act: Welcomeページにアクセス
        $response = $this->get('/');

        // Assert: 検索ボタンが表示されているかを確認
        $response->assertStatus(200);
        $response->assertSee('検索ページへ');
    }
}
