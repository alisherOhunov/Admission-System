<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_settings';

    protected $fillable = [
        'university_name',
        'contact_support_link',
        'student_accommodation_link',
    ];

    /**
     * Get or create the default site settings record
     */
    public static function getOrCreate()
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'university_name' => '',
                'contact_support_link' => '',
                'student_accommodation_link' => '',
            ]
        );
    }
}
