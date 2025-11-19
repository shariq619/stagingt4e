<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearnerCertificate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function license()
    {
        return $this->belongsTo(\App\Models\License::class);
    }
}
