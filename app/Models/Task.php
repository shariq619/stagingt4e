<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_task', 'task_id', 'course_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('status', 'comments')->withTimestamps();
    }

    // Relationship with FormResponse
    public function formResponses()
    {
        return $this->hasMany(FormResponse::class);
    }

    // Relationship with TaskSubmission
    public function submissions() {
        return $this->hasMany(TaskSubmission::class);
    }



}
