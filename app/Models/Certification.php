<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Certifications required by multiple courses
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_certification');
    }

    // Certifications uploaded by multiple users
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_certifications')
            //->withPivot('file_path', 'verified', 'uploaded_at')
            ->withTimestamps();
    }
}
