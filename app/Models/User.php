<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Lab404\Impersonate\Services\ImpersonateManager;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Auditable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes, \OwenIt\Auditing\Auditable, Impersonate, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expiry' => 'datetime',
    ];

    public function redirectAfterLeavingImpersonation()
    {
        return route('backend.users.index'); // returns the full URL for the named route
    }


    // FOR MIDDLEWARE


    public function hasSubmittedApplicationForm()
    {
        // Assuming there’s an application_form table with user_id linking to each user's form submission
        return $this->applicationForm()->exists();
    }

    public function hasUploadedProfilePhoto()
    {
        // Assuming there’s a profile_photos table with user_id linking to each user's profile photo
        return $this->profilePhoto()->exists();
    }

    public function hasUploadedDocuments()
    {
        // Assuming there’s a document_uploads table with user_id linking to each user's documents
        return $this->documentUpload()->exists();
    }

    public function hasUserCertification()
    {
        // Check if there’s any certification linked to this user
        return $this->certifications()->exists();
    }


    // FOR MIDDLEWARE


    public function learners()
    {
        return $this->hasMany(User::class, 'client_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function cohorts()
    {
        //return $this->belongsToMany(Cohort::class, 'cohort_user', 'user_id', 'cohort_id');

        return $this->belongsToMany(Cohort::class, 'cohort_user')
            ->withPivot('status', 'comments')
            ->withTimestamps();
    }

    public function trainerCohorts()
    {
        return $this->hasMany(Cohort::class, 'trainer_id');
    }


    public function elearningCourses()
    {
        return $this->hasMany(LearnerElearningCourse::class, 'learner_id');
    }

    public function tasks()
    {
        return $this->hasManyThrough(Task::class, Cohort::class, 'trainer_id', 'id', 'id', 'course_id');
    }

    public function submittedTasks()
    {
        return $this->belongsToMany(Task::class)->withPivot('status', 'comments')->withTimestamps();
    }


    public function cohortTasks()
    {
        return $this->belongsToMany(Task::class, 'cohort_task_user')
            ->withPivot('cohort_id', 'status', 'comments')
            ->withTimestamps();
    }


    public function profilePhotos()
    {
        return $this->hasMany(ProfilePhoto::class);
    }

    public function profilePhoto()
    {
        return $this->hasOne(ProfilePhoto::class);
    }

    public function documentUpload()
    {
        return $this->hasOne(DocumentUpload::class);
    }

    public function applicationForm()
    {
        return $this->hasOne(ApplicationForm::class, 'learner_id');
    }

    public function approvedOrInProgressTasks()
    {
        return $this->tasks()->wherePivotIn('status', ['Approved', 'In Progress']);
    }

    public function bookletTasks()
    {
        return $this->tasks()->whereIn('name', ['DS Distance Learning Booklet', 'CCTV Distance Learning Booklet', 'DS Top-Up Textbook', 'SG Top-Up Textbook']);
    }

    // Messages the user has sent
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function examResults()
    {
        return $this->hasMany(ExamResult::class, 'learner_id');
    }

    public function certifications()
    {
        return $this->belongsToMany(Certification::class, 'user_certifications')
            ->withPivot('qualification_type', 'course_certificate', 'status')
            //->withPivot('file_path', 'verified', 'uploaded_at')
            ->withTimestamps();
    }

    public function certificates()
    {
        return $this->hasMany(LearnerCertificate::class);
    }

    public function methodology()
    {
        return $this->belongsTo(Methodology::class, 'methodology_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function userCohortPayments()
    {
        return $this->hasMany(UserCohortPayment::class);
    }

    public function taskSubmissions()
    {
        return $this->hasMany(TaskSubmission::class, 'user_id');
    }

    public function highFieldCertificate()
    {
        return $this->hasMany(HighFieldCertificate::class);
    }

    public function filteredTaskSubmissions()
    {
        return $this->hasMany(TaskSubmission::class)
            ->whereNull('license_id');
    }

    public function frontOrder()
    {
        return $this->hasOne(FrontOrder::class);
    }

    public function contacts()
    {
        return $this->hasMany(UserContact::class);
    }

    public function logs()
    {
        return $this->morphMany(UserAuditLog::class, 'auditable');
    }


}
