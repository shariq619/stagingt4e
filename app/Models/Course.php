<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;

class Course extends Model implements Auditable
{
    use HasFactory, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    // Tell Laravel to use the 'slug' column for route model binding
    public function getRouteKeyName()
    {
        return 'slug'; // Use 'slug' instead of the default 'id'
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
    public function modules()
    {
        return $this->belongsToMany(Exam::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function awardingBody()
    {
        return $this->belongsTo(AwardingBody::class, 'awarding_bodies', 'id');
    }

    public function cohorts()
    {
        return $this->hasMany(Cohort::class);
    }

    public function cohort()
    {
        return $this->hasOne(Cohort::class);
    }

    public function elearningLicences()
    {
        return $this->belongsToMany(License::class);
    }

    public function tasks() {
        return $this->belongsToMany(Task::class);
    }

    public function licenses() {
        return $this->belongsToMany(License::class);
    }

    public function exams() {
        return $this->belongsToMany(Exam::class);
    }

    public function certifications()
    {
        return $this->belongsToMany(Certification::class, 'course_certification')->withPivot('certification_type');
    }

    public function resources()
    {
        return $this->belongsToMany(Resource::class);
    }

    public function getResellerNameAttribute()
    {
        // first cohort
        $cohort = $this->cohorts->first();

        // reseller name or fallback
        return optional(optional($cohort)->reseller)->company ?? 'T4E';
    }


}
