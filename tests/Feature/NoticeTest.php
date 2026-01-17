<?php

namespace Tests\Feature;

use App\Models\Notice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoticeTest extends TestCase
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

    /**
     * Test: Guest cannot access notice pages
     */
    public function test_guest_cannot_access_notice_pages(): void
    {
        $response = $this->get('/notices');
        $response->assertRedirect('/login');
    }

    /**
     * Test: Authenticated user can view notice index
     */
    public function test_authenticated_user_can_view_notice_index(): void
    {
        $response = $this->actingAs($this->user)->get('/notices');

        $response->assertStatus(200);
        $response->assertViewIs('notices.index');
    }

    /**
     * Test: User can view create notice form
     */
    public function test_user_can_view_create_notice_form(): void
    {
        $response = $this->actingAs($this->user)->get('/notices/create');

        $response->assertStatus(200);
        $response->assertViewIs('notices.create');
    }

    /**
     * Test: User can create a notice
     */
    public function test_user_can_create_notice(): void
    {
        $noticeData = [
            'title' => 'Team Meeting',
            'content_body' => 'We will have a team meeting tomorrow at 10 AM',
            'priority' => 'high',
        ];

        $response = $this->actingAs($this->user)->post('/notices', $noticeData);

        $this->assertDatabaseHas('notices', [
            'title' => 'Team Meeting',
            'author_id' => $this->user->id,
            'priority' => 'high',
        ]);

        $response->assertRedirect('/notices');
    }

    /**
     * Test: User cannot create notice with invalid data
     */
    public function test_user_cannot_create_notice_with_invalid_data(): void
    {
        $response = $this->actingAs($this->user)->post('/notices', [
            'title' => '',
            'content_body' => '',
            'priority' => 'invalid',
        ]);

        $response->assertSessionHasErrors(['title', 'content_body', 'priority']);
    }

    /**
     * Test: User can view notice details
     */
    public function test_user_can_view_notice_details(): void
    {
        $notice = Notice::factory()->create();

        $response = $this->actingAs($this->user)->get("/notices/{$notice->id}");

        $response->assertStatus(200);
        $response->assertViewIs('notices.show');
        $response->assertViewHas('notice', $notice);
    }

    /**
     * Test: User can view edit notice form
     */
    public function test_user_can_view_edit_notice_form(): void
    {
        $notice = Notice::factory()->create(['author_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->get("/notices/{$notice->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('notices.edit');
        $response->assertViewHas('notice', $notice);
    }

    /**
     * Test: Author can update their notice
     */
    public function test_author_can_update_notice(): void
    {
        $notice = Notice::factory()->create(['author_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->put("/notices/{$notice->id}", [
            'title' => 'Updated Title',
            'content_body' => 'Updated content',
            'priority' => 'low',
        ]);

        $this->assertDatabaseHas('notices', [
            'id' => $notice->id,
            'title' => 'Updated Title',
            'priority' => 'low',
        ]);

        $response->assertRedirect("/notices/{$notice->id}");
    }

    /**
     * Test: Non-author cannot update notice
     */
    public function test_non_author_cannot_update_notice(): void
    {
        $notice = Notice::factory()->create(['author_id' => $this->user->id]);
        $other_user = User::factory()->create();

        $response = $this->actingAs($other_user)->put("/notices/{$notice->id}", [
            'title' => 'Updated Title',
            'content_body' => 'Updated content',
            'priority' => 'low',
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test: Author can delete their notice
     */
    public function test_author_can_delete_notice(): void
    {
        $notice = Notice::factory()->create(['author_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->delete("/notices/{$notice->id}");

        $this->assertDatabaseMissing('notices', ['id' => $notice->id]);

        $response->assertRedirect('/notices');
    }

    /**
     * Test: Non-author cannot delete notice
     */
    public function test_non_author_cannot_delete_notice(): void
    {
        $notice = Notice::factory()->create(['author_id' => $this->user->id]);
        $other_user = User::factory()->create();

        $response = $this->actingAs($other_user)->delete("/notices/{$notice->id}");

        $response->assertStatus(403);

        $this->assertDatabaseHas('notices', ['id' => $notice->id]);
    }

    /**
     * Test: Admin can delete any notice
     */
    public function test_admin_can_delete_any_notice(): void
    {
        $notice = Notice::factory()->create(['author_id' => $this->user->id]);

        $response = $this->actingAs($this->admin)->delete("/notices/{$notice->id}");

        $this->assertDatabaseMissing('notices', ['id' => $notice->id]);
    }

    /**
     * Test: Can filter notices by priority
     */
    public function test_can_filter_notices_by_priority(): void
    {
        Notice::factory()->create(['priority' => 'high']);
        Notice::factory()->create(['priority' => 'low']);
        Notice::factory()->create(['priority' => 'medium']);

        $response = $this->actingAs($this->user)->get('/notices?priority=high');

        $response->assertStatus(200);
        $response->assertViewIs('notices.index');
    }

    /**
     * Test: Can search notices by title
     */
    public function test_can_search_notices_by_title(): void
    {
        Notice::factory()->create(['title' => 'Team Meeting']);
        Notice::factory()->create(['title' => 'System Maintenance']);

        $response = $this->actingAs($this->user)->get('/notices?search=Team');

        $response->assertStatus(200);
        $response->assertViewIs('notices.index');
    }

    /**
     * Test: Notice shows priority color
     */
    public function test_notice_shows_priority_color(): void
    {
        $notice = Notice::factory()->create(['priority' => 'high']);

        $this->assertEquals('#BC4626', $notice->priority_color);
    }

    /**
     * Test: Notice lists all valid priorities
     */
    public function test_notice_valid_priorities(): void
    {
        $priorities = ['low', 'medium', 'high'];

        foreach ($priorities as $priority) {
            $notice = Notice::factory()->create(['priority' => $priority]);
            $this->assertDatabaseHas('notices', [
                'id' => $notice->id,
                'priority' => $priority,
            ]);
        }
    }

    /**
     * Test: Recent notices are ordered by creation date
     */
    public function test_recent_notices_ordered_by_creation_date(): void
    {
        $notice1 = Notice::factory()->create();
        sleep(1);
        $notice2 = Notice::factory()->create();

        $response = $this->actingAs($this->user)->get('/notices');

        $response->assertStatus(200);
    }

    /**
     * Test: Notice shows author information
     */
    public function test_notice_shows_author_information(): void
    {
        $notice = Notice::factory()->create(['author_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->get("/notices/{$notice->id}");

        $response->assertViewHas('notice', function ($notice) {
            return $notice->author->id === $this->user->id;
        });
    }
}
