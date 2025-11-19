<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseBundle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseBundleController extends Controller
{
    public function index()
    {
        $bundles = CourseBundle::paginate(9);
        $courses = collect();
        foreach ($bundles as $bundle) {
            $productIds = json_decode($bundle->products, true);

            if (is_array($productIds)) {
                $courses = Course::whereIn('id', $productIds)->select('id', 'slug' ,'name')->get();
                $bundle->courses = $courses;
            } else {
                $bundle->courses = collect();
            }
        }

        return view('frontend.courses-bundles.index', compact('bundles', 'courses'));
    }

    public function show(CourseBundle $slug)
    {
        $bundles = CourseBundle::all();

        // Decode the products column into an array
        $courseIds = json_decode($slug->products, true);

        // Ensure $courseIds is an array before using it in the query
        if (!is_array($courseIds)) {
            $courseIds = [];
        }

        // Fetch courses along with their cohorts
        $coursesWithCohorts = Course::whereIn('id', $courseIds)
            ->with(['cohorts' => function ($query) {
                $query->select('id', 'course_id', 'start_date_time', 'end_date_time','additional_times', 'venue_id')
                    ->where('cohort_status',1)
                    ->whereDate('start_date_time', '>=', Carbon::today())
                    ->with(['venue:id,venue_name'])
                    ->orderBy('venue_id', 'asc') // Order by venue_id first
                    ->orderBy('start_date_time', 'asc'); // Then order by start_date_time
            }])
            ->get();


        return view('frontend.courses-bundles.show', compact('slug', 'bundles','coursesWithCohorts'));
    }
}
