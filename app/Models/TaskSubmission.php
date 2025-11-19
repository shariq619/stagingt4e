<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskSubmission extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function course()
    {
        return $this->belongsTo(\App\Models\Course::class);
    }


    public function cohort()
    {
        return $this->belongsTo(Cohort::class, 'cohort_id');
    }
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function license()
    {
        return $this->belongsTo(License::class, 'license_id');
    }
}
