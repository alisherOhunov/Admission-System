<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'degree_level',
        'department',
        'description',
        'requirements',
        'is_active',
    ];

    protected $casts = [
        'requirements' => 'array',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByLevel($query, $level)
    {
        return $query->where('degree_level', $level);
    }

    // Helpers
    public function getDegreeLevelLabel()
    {
        return $this->degree_level === 'undergraduate'
            ? 'Undergraduate (Bachelor\'s)'
            : 'Graduate (Master\'s)';
    }
}
