<?php

namespace Tests\Feature;

use App\Models\Notice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoticeApiTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['role' => 'user']);
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    public function test_can_list_notices()
    {
        Notice::factory()->count(5)->create();

        $response = $this->actingAs($this->user)
                         ->getJson('/api/notices');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data', 'meta']);
    }

    public function test_can_create_notice()
    {
        $response = $this->actingAs($this->user)
                         ->postJson('/api/notices', [
                             'title' => 'Team Meeting',
                             'content' => 'Meeting scheduled for tomorrow',
                             'priority' => 'high',
                         ]);

        $response->assertStatus(201)
                 ->assertJsonPath('title', 'Team Meeting')
                 ->assertJsonPath('author_id', $this->user->id);
    }

    public function test_can_show_notice()
    {
        $notice = Notice::factory()->create();

        $response = $this->actingAs($this->user)
                         ->getJson("/api/notices/{$notice->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('id', $notice->id);
    }

    public function test_author_can_update_notice()
    {
        $notice = Notice::factory()->create(['author_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
                         ->patchJson("/api/notices/{$notice->id}", [
                             'priority' => 'low',
                         ]);

        $response->assertStatus(200)
                 ->assertJsonPath('priority', 'low');
    }

    public function test_non_author_cannot_update_notice()
    {
        $notice = Notice::factory()->create(['author_id' => $this->user->id]);
        $other_user = User::factory()->create();

        $response = $this->actingAs($other_user)
                         ->patchJson("/api/notices/{$notice->id}", [
                             'priority' => 'low',
                         ]);

        $response->assertStatus(403);
    }

    public function test_author_can_delete_notice()
    {
        $notice = Notice::factory()->create(['author_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
                         ->deleteJson("/api/notices/{$notice->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('notices', ['id' => $notice->id]);
    }

    public function test_can_filter_notices_by_priority()
    {
        Notice::factory()->create(['priority' => 'high']);
        Notice::factory()->create(['priority' => 'low']);

        $response = $this->actingAs($this->user)
                         ->getJson('/api/notices?priority=high');

        $response->assertStatus(200);
    }

    public function test_can_get_notices_by_priority()
    {
        Notice::factory()->create(['priority' => 'high']);
        Notice::factory()->create(['priority' => 'high']);
        Notice::factory()->create(['priority' => 'low']);

        $response = $this->actingAs($this->user)
                         ->getJson('/api/notices/priority/high');

        $response->assertStatus(200)
                 ->assertJsonCount(2, 'data');
    }
}
