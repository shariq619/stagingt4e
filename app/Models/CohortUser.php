<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

class CohortUser extends Model
{
    protected $table = 'cohort_user';

    protected $fillable = [
        'cohort_id',
        'user_id',
        'status',
        'is_reassigned',
        'comments',
    ];

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

            $todayAfter2 = Carbon::today()->setTime(14, 0, 0);
            $builder->where('created_at', '>=', $todayAfter2);
        });
    }
}
