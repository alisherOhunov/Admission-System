<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'program_id',
        'application_period_id',
        'level',
        'nationality',
        'country_of_birth',
        'family_status',
        'passport_number',
        'date_of_birth',
        'gender',
        'native_language',
        'email',
        'phone',
        'has_visa',
        'previous_institution',
        'previous_gpa',
        'degree_earned',
        'graduation_date',
        'language_test_type',
        'language_test_score',
        'language_test_date',
        'needs_dormitory',
        'status',
        'submitted_at',
        'permanent_country',
        'permanent_state',
        'permanent_city',
        'permanent_postcode',
        'permanent_street',
        'admin_resubmission_comment',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'graduation_date' => 'date',
        'language_test_date' => 'date',
        'submitted_at' => 'datetime',
        'needs_dormitory' => 'boolean',
        'has_visa' => 'boolean',
        'current_address' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function applicationPeriod()
    {
        return $this->belongsTo(ApplicationPeriod::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function getImportantDocuments()
    {
        return $this->documents()
            ->whereIn('type', ['passport', 'transcript', 'visa_proof', 'diploma', 'motivation_letter', 'cv', 'language_certificate'])
            ->get()
            ->keyBy('type');
    }

    // Status Helpers
    public function isDraft()
    {
        return $this->status === 'draft';
    }

    public function isSubmitted()
    {
        return in_array($this->status, ['submitted', 'under_review', 'accepted', 'rejected', 'require_resubmit', 're_submitted']);
    }

    public function canEdit()
    {
        return in_array($this->status, ['draft', 'require_resubmit']);
    }

    // Progress Calculation
    public function getProgressPercentage()
    {
        $requiredFields = [
            $this->nationality,
            $this->passport_number,
            $this->date_of_birth,
            $this->native_language,
            $this->email,
            $this->phone,
            $this->previous_institution,
            $this->degree_earned,
            $this->application_period_id,
            $this->permanent_country,
            $this->permanent_state,
            $this->permanent_city,
            $this->permanent_postcode,
            $this->permanent_street,
        ];

        $completed = collect($requiredFields)->filter()->count();
        $total = count($requiredFields);

        return round(($completed / $total) * 100);
    }

    // Get status label and color
    public function getStatusData()
    {
        $statuses = [
            'draft' => ['label' => __('status.draft'), 'bg' => 'bg-gray-100', 'svg_color' => 'text-gray-500', 'color' => 'text-gray-800'],
            'submitted' => ['label' => __('status.submitted'), 'bg' => 'bg-blue-100', 'svg_color' => 'text-blue-500', 'color' => 'text-blue-800'],
            'require_resubmit' => ['label' => __('status.require_resubmit'), 'bg' => 'bg-blue-100', 'svg_color' => 'text-blue-500', 'color' => 'text-blue-800'],
            're_submitted' => ['label' => __('status.re_submitted'), 'bg' => 'bg-blue-100', 'svg_color' => 'text-blue-500', 'color' => 'text-blue-800'],
            'under_review' => ['label' => __('status.under_review'), 'bg' => 'bg-yellow-100', 'svg_color' => 'text-yellow-500', 'color' => 'text-yellow-800'],
            'accepted' => ['label' => __('status.accepted'), 'bg' => 'bg-green-100', 'svg_color' => 'text-green-500', 'color' => 'text-green-800'],
            'rejected' => ['label' => __('status.rejected'), 'bg' => 'bg-red-100', 'svg_color' => 'text-red-500', 'color' => 'text-red-800'],
        ];

        return $statuses[$this->status] ?? $statuses['draft'];
    }

    // Scopes
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    public function scopeSubmitted($query)
    {
        return $query->whereNotNull('submitted_at');
    }
}
