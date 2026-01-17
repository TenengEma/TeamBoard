<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'department',
        'phone_number',
        'photo_path',
        'biographical_information',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope to filter employees by department.
     */
    public function scopeByDepartment($query, $department)
    {
        return $query->where('department', $department);
    }

    /**
     * Scope to search employees by name or email.
     */
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('name', 'LIKE', "%{$searchTerm}%")
                     ->orWhere('email', 'LIKE', "%{$searchTerm}%");
    }

    /**
     * Get all unique departments.
     */
    public static function getDepartments()
    {
        return self::distinct()->pluck('department')->sort();
    }
}

