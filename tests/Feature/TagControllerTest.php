<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_store_tag(): void
    {
        // ユーザーを作成してログイン
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $data = ['name' => 'Test Tag'];

        $response = $this->post(route('tag.store'), $data);

        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $response->assertSessionHas('success', 'タグが正常に作成されました！');
        $this->assertDatabaseHas('tags', ['name' => 'Test Tag']);
    }
}
