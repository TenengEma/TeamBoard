<?php

namespace Database\Factories;

use App\Models\Document;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    protected $model = Document::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'filename' => fake()->word() . '.pdf',
            'file_path' => 'documents/' . fake()->word() . '.pdf',
            'description' => fake()->paragraph(),
            'uploader_id' => \App\Models\User::factory(),
        ];
    }
}
