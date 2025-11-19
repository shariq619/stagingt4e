<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function learner()
    {
        return $this->belongsTo(User::class, 'learner_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }


}
