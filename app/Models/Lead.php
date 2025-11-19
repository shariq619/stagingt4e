<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_date',
        'candidate_name',
        'contact_number',
        'email',
        'course_interested',
        'city',
        'status',
        'enrolment_date',
        'created_by_id',
        'platform',
        'source',
        'notes',
        'follow_up_at',
        'follow_up2_at',
        'follow_up_final_at',
        'course_id',
        'user_id',
    ];

    protected $casts = [
        'contact_date'=>'date',
        'enrolment_date'=>'date',
        'follow_up_at'=>'datetime',
        'follow_up2_at'=>'datetime',
        'follow_up_final_at'=>'datetime',
    ];

    public const STATUSES = [
        'enrolled'=>'Enrolled',
        'do_not_disturb'=>'Do not Disturb',
        'last_hope'=>'Last Hope',
        'processing'=>'Processing',
        'pending'=>'Pending',
        'not_interested'=>'Not Interested',
        'need_to_followup'=>'Need to Followup',
        'interested'=>'Interested'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by_id');
    }

    public function learner()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }

    public function getStatusLabelAttribute()
    {
        return static::STATUSES[$this->status] ?? $this->status;
    }
}
