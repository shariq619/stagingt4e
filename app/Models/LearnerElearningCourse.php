<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearnerElearningCourse extends Model
{
    use HasFactory;

    protected $guarded = [];

    //protected $table = ['learner_elearning_courses'];

    public function user()
    {
        return $this->belongsTo(User::class, 'learner_id');
    }

}
