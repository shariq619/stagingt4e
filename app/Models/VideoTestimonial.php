<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoTestimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'video_disk',
        'video_path',
        'thumbnail_path',
        'video_format',
        'video_duration',
        'video_size',
        'consent_given',
        'consent_text',
        'consent_version',
        'consent_at',
        'ip_address',
        'status',
        'reviewed_by',
        'reviewed_at',
        'review_notes',
        'is_public',
        'is_featured',
        'tags',
    ];

    protected $casts = [
        'consent_given' => 'boolean',
        'consent_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'is_public' => 'boolean',
        'is_featured' => 'boolean',
        'tags' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
