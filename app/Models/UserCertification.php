<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCertification extends Model
{
    use HasFactory;

    protected $table = 'user_certifications';

    protected $fillable = ['user_id', 'certification_id', 'file_path', 'is_skip', 'uploaded_at'];

    protected $casts = [
        'is_skip' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function certification()
    {
        return $this->belongsTo(Certification::class);
    }
}
