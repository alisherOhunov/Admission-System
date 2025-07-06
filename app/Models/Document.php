<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'type',
        'filename',
        'original_name',
        'mime_type',
        'size',
        'path',
    ];

    // Relationships
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    // Document Types Configuration
    public static function getDocumentTypes()
    {
        return [
            'passport' => [
                'label' => 'Passport (Scanned)',
                'description' => 'Clear scan of your passport information page',
                'required' => true,
                'formats' => ['PDF', 'JPG', 'PNG'],
                'max_size' => '5MB',
            ],
            'transcript' => [
                'label' => 'Academic Transcripts',
                'description' => 'Official transcripts from previous institutions',
                'required' => true,
                'formats' => ['PDF'],
                'max_size' => '10MB',
            ],
            'diploma' => [
                'label' => 'Diploma/Certificates',
                'description' => 'Graduation certificates and diplomas',
                'required' => true,
                'formats' => ['PDF', 'JPG', 'PNG'],
                'max_size' => '10MB',
            ],
            'english_score' => [
                'label' => 'English Test Scores',
                'description' => 'IELTS, TOEFL, or other English proficiency test results',
                'required' => true,
                'formats' => ['PDF', 'JPG', 'PNG'],
                'max_size' => '5MB',
            ],
            'sop' => [
                'label' => 'Statement of Purpose',
                'description' => 'Your written statement of purpose (if uploaded separately)',
                'required' => true,
                'formats' => ['PDF', 'DOC', 'DOCX'],
                'max_size' => '5MB',
            ],
            'cv' => [
                'label' => 'Curriculum Vitae',
                'description' => 'Your current CV/Resume (required for graduate programs)',
                'required' => false,
                'formats' => ['PDF', 'DOC', 'DOCX'],
                'max_size' => '5MB',
            ],
            'portfolio' => [
                'label' => 'Portfolio (Optional)',
                'description' => 'Portfolio for design, art, or creative programs',
                'required' => false,
                'formats' => ['PDF', 'ZIP'],
                'max_size' => '25MB',
            ],
        ];
    }

    // Helpers
    public function getTypeConfig()
    {
        return self::getDocumentTypes()[$this->type] ?? null;
    }

    public function getFormattedSize()
    {
        return number_format($this->size / 1024 / 1024, 2).' MB';
    }

    public function getDownloadUrl()
    {
        return Storage::url($this->path);
    }

    public function isImage()
    {
        return in_array($this->mime_type, [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
        ]);
    }

    public function isPdf()
    {
        return $this->mime_type === 'application/pdf';
    }
}
