<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_store_tag(): void
    {
        // テストデータの準備
        $data = ['name' => 'Test Tag'];

        // POSTリクエストでタグを作成
        $response = $this->post(route('tags.store'), $data);

        // ステータスが302（リダイレクト）であることを確認
        $response->assertStatus(302);

        // 成功メッセージがセッションに保存されていることを確認
        $response->assertSessionHas('success', 'タグが正常に作成されました！');

        // データベースにタグが存在することを確認
        $this->assertDatabaseHas('tags', ['name' => 'Test Tag']);
    }
}
