<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'logo_url',
        'favicon_url',
        'email',
        'whatsapp',
        'address',
        'operational_hours',
        'social_links',
        'default_seo',
    ];

    protected $casts = [
        'social_links' => 'array',
        'default_seo' => 'array',
    ];
}
