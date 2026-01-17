<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content_body',
        'author_id',
        'priority',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the author of the notice.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Scope to filter notices by priority.
     */
    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    /**
     * Scope to get recent notices (latest first).
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Get priority badge color based on priority level.
     */
    public function getPriorityColorAttribute(): string
    {
        return match($this->priority) {
            'high' => '#BC4626',
            'medium' => '#DFA44D',
            'low' => '#347486',
            default => '#347486',
        };
    }

    /**
     * Get priority label.
     */
    public function getPriorityLabelAttribute(): string
    {
        return ucfirst($this->priority);
    }
}

