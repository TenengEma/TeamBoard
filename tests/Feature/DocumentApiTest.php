<?php

namespace Tests\Feature;

use App\Models\Document;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DocumentApiTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Storage::fake('public');
    }

    public function test_can_list_documents()
    {
        Document::factory()->count(3)->create();

        $response = $this->actingAs($this->user)
                         ->getJson('/api/documents');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data', 'meta']);
    }

    public function test_can_create_document()
    {
        $file = UploadedFile::fake()->create('test.pdf', 100);

        $response = $this->actingAs($this->user)
                         ->postJson('/api/documents', [
                             'title' => 'Test Document',
                             'file' => $file,
                             'description' => 'A test document',
                         ]);

        $response->assertStatus(201)
                 ->assertJsonPath('title', 'Test Document')
                 ->assertJsonPath('uploader_id', $this->user->id);

        Storage::disk('public')->assertExists('documents/' . $file->hashName());
    }

    public function test_can_show_document()
    {
        $document = Document::factory()->create();

        $response = $this->actingAs($this->user)
                         ->getJson("/api/documents/{$document->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('id', $document->id);
    }

    public function test_uploader_can_delete_document()
    {
        Storage::disk('public')->put('documents/test.pdf', 'test content');
        
        $document = Document::factory()->create([
            'uploader_id' => $this->user->id,
            'file_path' => 'documents/test.pdf',
        ]);

        $response = $this->actingAs($this->user)
                         ->deleteJson("/api/documents/{$document->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('documents', ['id' => $document->id]);
    }

    public function test_non_uploader_cannot_delete_document()
    {
        $other_user = User::factory()->create();
        $document = Document::factory()->create(['uploader_id' => $this->user->id]);

        $response = $this->actingAs($other_user)
                         ->deleteJson("/api/documents/{$document->id}");

        $response->assertStatus(403);
    }

    public function test_can_search_documents()
    {
        Document::factory()->create(['title' => 'Budget Report']);
        Document::factory()->create(['title' => 'Meeting Notes']);

        $response = $this->actingAs($this->user)
                         ->getJson('/api/documents?search=Budget');

        $response->assertStatus(200);
    }
}
