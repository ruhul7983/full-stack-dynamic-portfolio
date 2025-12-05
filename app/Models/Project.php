<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',        // For storing the image file path
        'technology_used',   // New field
        'live_view_url',     // New field (using URL suffix for clarity)
        'github_link',       // New field
        'category',
        'status',
    ];
}