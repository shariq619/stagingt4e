<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CohortMiscellounose extends Model
{
    protected $fillable = [
        'cohort_id',
        'nominal_code',
        'description',
        'cost',
        'quantity',
        'net_cost',
        'vat',
    ];

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }
}
