<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskAssessment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'checklist' => 'array',
        'comments'  => 'array',
    ];

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}
