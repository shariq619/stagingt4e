<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class FrontOrderDetails extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function frontOrder()
    {
        return $this->belongsTo(\App\Models\FrontOrder::class, 'order_id');
    }

    public function learner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function course_bundle()
    {
        return $this->belongsTo(CourseBundle::class,'bundle_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    // naveed

    public function cohort()
    {
        return $this->belongsTo(Cohort::class, 'cohort_id');
    }

    public function reseller()
    {
        return $this->belongsTo(User::class, 'reseller_id','id');
    }

    public function invoices()
    {
        return $this->hasMany(\App\Models\ProductInvoice::class, 'order_detail_id');
    }

    public function latestInvoice()
    {
        return $this->hasOne(\App\Models\ProductInvoice::class, 'order_detail_id')->latestOfMany('id');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('crmFilter', function (Builder $builder) {

            $routeName = Route::currentRouteName();
            $firstSeg  = request()->segment(1);

            $isCrmNamedRoute = $routeName && str_starts_with($routeName, 'crm.');
            $isCrmUrlPrefix  = $firstSeg === 'crm';

            if (! $isCrmNamedRoute && ! $isCrmUrlPrefix) {
                return;
            }

            $builder->where('created_at', '>=', '2025-11-24 14:00:00');
        });
    }


}
