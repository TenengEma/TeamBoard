<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserAdminApiTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->user = User::factory()->create(['role' => 'user']);
    }

    public function test_admin_can_list_users()
    {
        User::factory()->count(5)->create();

        $response = $this->actingAs($this->admin)
                         ->getJson('/api/users');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data', 'meta']);
    }

    public function test_non_admin_cannot_list_users()
    {
        $response = $this->actingAs($this->user)
                         ->getJson('/api/users');

        $response->assertStatus(403);
    }

    public function test_admin_can_create_user()
    {
        $response = $this->actingAs($this->admin)
                         ->postJson('/api/users', [
                             'name' => 'New User',
                             'email' => 'newuser@example.com',
                             'password' => 'password123',
                             'password_confirmation' => 'password123',
                             'role' => 'user',
                         ]);

        $response->assertStatus(201)
                 ->assertJsonPath('email', 'newuser@example.com');

        $this->assertDatabaseHas('users', ['email' => 'newuser@example.com']);
    }

    public function test_admin_can_update_user()
    {
        $response = $this->actingAs($this->admin)
                         ->patchJson("/api/users/{$this->user->id}", [
                             'name' => 'Updated Name',
                         ]);

        $response->assertStatus(200)
                 ->assertJsonPath('name', 'Updated Name');
    }

    public function test_admin_can_delete_user()
    {
        $user_to_delete = User::factory()->create();

        $response = $this->actingAs($this->admin)
                         ->deleteJson("/api/users/{$user_to_delete->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('users', ['id' => $user_to_delete->id]);
    }

    public function test_admin_cannot_delete_self()
    {
        $response = $this->actingAs($this->admin)
                         ->deleteJson("/api/users/{$this->admin->id}");

        $response->assertStatus(403);
    }

    public function test_admin_can_assign_role()
    {
        $response = $this->actingAs($this->admin)
                         ->postJson("/api/users/{$this->user->id}/assign-role", [
                             'role' => 'admin',
                         ]);

        $response->assertStatus(200)
                 ->assertJsonPath('user.role', 'admin');

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'role' => 'admin',
        ]);
    }
}
