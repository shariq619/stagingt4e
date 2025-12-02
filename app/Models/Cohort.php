<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Cohort extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function trainers()
    {
        return $this->hasMany(User::class, 'id','trainer_id');
    }
    public function corporateClient()
    {
        return $this->belongsTo(User::class, 'corporate_client_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'cohort_user', 'cohort_id', 'user_id');
    }

    public function trainedCohorts()
    {
        return $this->hasMany(Cohort::class, 'trainer_id');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'course_task', 'course_id', 'task_id');
    }

    public function tasksWithStatus()
    {
        return $this->belongsToMany(Task::class, 'user_cohort')
            ->withPivot('status', 'comments')
            ->withTimestamps();
    }

    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }

    public function certificates()
    {
        return $this->hasMany(LearnerCertificate::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function userCohortPayments()
    {
        return $this->hasMany(UserCohortPayment::class);
    }

    public function highFieldCertificates()
    {
        return $this->hasMany(HighFieldCertificate::class);
    }

    public function learners()
    {
        return $this->belongsToMany(User::class, 'cohort_user', 'cohort_id', 'user_id');
    }

    public function crmLearners()
    {
        return $this->belongsToMany(User::class, 'cohort_user', 'cohort_id', 'user_id')
            ->wherePivot('is_reassigned', 0);
    }
    public function taskSubmissions()
    {
        return $this->hasMany(TaskSubmission::class);
    }

    public function reseller()
    {
        return $this->belongsTo(User::class, 'reseller_id');
    }

    public function riskAssessment()
    {
        return $this->hasOne(RiskAssessment::class);
    }

}
