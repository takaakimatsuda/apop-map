<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
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

    public function test_cannot_store_tag_with_empty_name(): void
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $data = ['name' => ''];

        $response = $this->post(route('tag.store'), $data);

        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseMissing('tags', ['name' => '']);
    }

    public function test_guest_cannot_store_tag(): void
    {
        $data = ['name' => 'Test Tag'];

        $response = $this->post(route('tag.store'), $data);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('tags', ['name' => 'Test Tag']);
    }

    public function test_can_delete_tag(): void
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $tag = \App\Models\Tag::factory()->create(['name' => 'Tag to be deleted']);

        $response = $this->delete(route('tag.destroy', $tag->id));

        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
    }

    public function test_can_view_tag_list(): void
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $tag = \App\Models\Tag::factory()->create(['name' => 'Viewable Tag']);

        $response = $this->get(route('tag.index'));

        $response->assertStatus(200);
        $response->assertSee('Viewable Tag');
    }

}
