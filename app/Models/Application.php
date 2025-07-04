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
        'passport_number',
        'date_of_birth',
        'gender',
        'native_language',
        'email',
        'phone',
        'previous_institution',
        'previous_gpa',
        'degree_earned',
        'graduation_date',
        'english_test_type',
        'english_test_score',
        'english_test_date',
        'start_term',
        'funding_interest',
        'statement_of_purpose',
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
        'english_test_date' => 'date',
        'submitted_at' => 'datetime',
        'funding_interest' => 'boolean',
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
            ->whereIn('type', ['passport', 'transcript', 'address_proof', 'diploma', 'sop', 'cv', 'english_score', 'portfolio'])
            ->get()
            ->keyBy('type');
    }

    public function permanentAddress()
    {
        return $this->belongsTo(Address::class, 'permanent_address_id');
    }

    public function currentAddress()
    {
        return $this->belongsTo(Address::class, 'current_address_id');
    }

    // Status Helpers
    public function isDraft()
    {
        return $this->status === 'draft';
    }

    public function isSubmitted()
    {
        return in_array($this->status, ['submitted', 'under_review', 'accepted', 'rejected']);
    }

    public function canEdit()
    {
        return $this->status === 'draft';
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
            $this->start_term,
            $this->statement_of_purpose,
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
            'draft' => ['label' => 'Draft', 'color' => 'bg-gray-100 text-gray-800'],
            'submitted' => ['label' => 'Submitted', 'color' => 'bg-blue-100 text-blue-800'],
            'require_resubmit' => ['label' => 'Require Resubmit', 'color' => 'bg-blue-100 text-blue-800'],
            'under_review' => ['label' => 'Under Review', 'color' => 'bg-yellow-100 text-yellow-800'],
            'accepted' => ['label' => 'Accepted', 'color' => 'bg-green-100 text-green-800'],
            'rejected' => ['label' => 'Rejected', 'color' => 'bg-red-100 text-red-800'],
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
