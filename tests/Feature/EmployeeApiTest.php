<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeApiTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_list_employees()
    {
        Employee::factory()->count(5)->create();

        $response = $this->actingAs($this->user)
                         ->getJson('/api/employees');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data', 'meta']);
    }

    public function test_can_create_employee()
    {
        $response = $this->actingAs($this->user)
                         ->postJson('/api/employees', [
                             'name' => 'Jane Smith',
                             'email' => 'jane@example.com',
                             'department' => 'HR',
                             'phone_number' => '+237123456789',
                         ]);

        $response->assertStatus(201)
                 ->assertJsonPath('name', 'Jane Smith')
                 ->assertJsonPath('department', 'HR');

        $this->assertDatabaseHas('employees', [
            'email' => 'jane@example.com',
        ]);
    }

    public function test_can_show_employee()
    {
        $employee = Employee::factory()->create();

        $response = $this->actingAs($this->user)
                         ->getJson("/api/employees/{$employee->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('id', $employee->id)
                 ->assertJsonPath('email', $employee->email);
    }

    public function test_can_update_employee()
    {
        $employee = Employee::factory()->create();

        $response = $this->actingAs($this->user)
                         ->patchJson("/api/employees/{$employee->id}", [
                             'department' => 'Finance',
                         ]);

        $response->assertStatus(200)
                 ->assertJsonPath('department', 'Finance');

        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'department' => 'Finance',
        ]);
    }

    public function test_can_delete_employee()
    {
        $employee = Employee::factory()->create();

        $response = $this->actingAs($this->user)
                         ->deleteJson("/api/employees/{$employee->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('employees', [
            'id' => $employee->id,
        ]);
    }

    public function test_can_search_employees()
    {
        Employee::factory()->create(['name' => 'Alice Johnson']);
        Employee::factory()->create(['name' => 'Bob Smith']);

        $response = $this->actingAs($this->user)
                         ->getJson('/api/employees/search/Alice');

        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data');
    }

    public function test_can_filter_employees_by_department()
    {
        Employee::factory()->create(['department' => 'HR']);
        Employee::factory()->create(['department' => 'IT']);

        $response = $this->actingAs($this->user)
                         ->getJson('/api/employees?department=HR');

        $response->assertStatus(200);
    }
}
