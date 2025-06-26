<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const ROLE_APPLICANT = 1;
    const ROLE_ADMIN = 2;

    protected $fillable = [
        'first_name',
        'last_name',
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

    // Role Helpers
    public function isApplicant()
    {
        return $this->role === self::ROLE_APPLICANT;
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
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
