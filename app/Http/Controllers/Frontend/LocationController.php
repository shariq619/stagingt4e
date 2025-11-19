<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Venue;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        return view('frontend.locations.index');
    }

    public function show(Venue $slug)
    {
        $venue_id = $slug->id;
        $today = now()->toDateString();
        $courses = Course::whereHas('cohorts', function ($query) use ($venue_id,$today) {
            $query->where('venue_id', $venue_id)->whereDate('start_date_time', '>=', $today);;
        })->get();

        //dd($courses);

        return view('frontend.locations.show', compact('slug','courses'));
    }

}
