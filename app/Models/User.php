<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function staffNotes()
    {
        return $this->hasMany(StaffNote::class, 'staff_id');
    }

    // Role Helpers
    public function isApplicant()
    {
        return $this->role === 'applicant';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isStaff()
    {
        return in_array($this->role, ['admin', 'staff']);
    }

    // Get current application for applicant
    public function getCurrentApplication()
    {
        if (!$this->isApplicant()) {
            return null;
        }

        return $this->applications()
            ->with(['program', 'applicationPeriod', 'documents'])
            ->latest()
            ->first();
    }
}
