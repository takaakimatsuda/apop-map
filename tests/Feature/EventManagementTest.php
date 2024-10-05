<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_event_management_screen_can_be_rendered()
    {
        // ログインユーザーの作成
        $user = User::factory()->create();

        // ダミーのイベントを作成
        $events = Event::factory()->count(12)->create(['user_id' => $user->id]);

        // ログインしてイベント管理ページを表示 (ルートを変更)
        $response = $this->actingAs($user)->get(route('events.my'));

        // ページが表示され、ステータスが200であることを確認
        $response->assertStatus(200);

        // イベント一覧が表示されていることを確認
        $response->assertSee('イベント管理');
        $response->assertSee('新規作成');

        // 最初のイベントタイトルを確認
        $firstEvent = $events->first();
        $response->assertSee($firstEvent->title);
    }

    public function test_events_are_paginated()
    {
        // ログインユーザーの作成
        $user = User::factory()->create();

        // ダミーのイベントを13件作成（1ページあたり12件表示）
        $events = Event::factory()->count(13)->create(['user_id' => $user->id]);

        // ログインしてイベント管理ページを表示 (ルートを変更)
        $response = $this->actingAs($user)->get(route('events.my'));

        // 最初のページには12件のイベントが表示されていることを確認
        $firstEvent = $events->first();
        $response->assertSee($firstEvent->title);
        $response->assertDontSee($events->last()->title);  // 次ページのイベントは見えない

        // 次のページの確認
        $response = $this->actingAs($user)->get(route('events.my', ['page' => 2]));
        $response->assertSee($events->last()->title);  // 13番目のイベントのタイトルが次ページに表示
    }
}
