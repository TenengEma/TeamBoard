<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'filename',
        'filepath',
        'uploader_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the uploader of the document.
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    /**
     * Scope to get recent documents (latest first).
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Get file extension.
     */
    public function getFileExtensionAttribute(): string
    {
        return pathinfo($this->filename, PATHINFO_EXTENSION);
    }

    /**
     * Get file type icon class based on extension.
     */
    public function getFileIconAttribute(): string
    {
        $extension = $this->file_extension;
        return match($extension) {
            'pdf' => 'bi-file-pdf',
            'doc', 'docx' => 'bi-file-word',
            'xls', 'xlsx' => 'bi-file-earmark-spreadsheet',
            'ppt', 'pptx' => 'bi-file-earmark-presentation',
            'txt' => 'bi-file-text',
            'jpg', 'jpeg', 'png', 'gif' => 'bi-file-image',
            default => 'bi-file-earmark',
        };
    }
}

