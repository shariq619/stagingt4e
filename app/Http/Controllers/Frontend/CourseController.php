<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AwardingBody;
use App\Models\Category;
use App\Models\Cohort;
use App\Models\Course;
use App\Models\CourseBundle;
use App\Models\Venue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
//    public function index(Request $request)
//    {
//        $categories = Category::all();
//        $venues = Venue::all();
//
//        if ($request->ajax()) {
//            $courses = Course::skip($request->offset)->take(6)->where('category_id', '!=', 7)->get();
//            return response()->json(['courses' => $courses]);
//        }
//
//        if($request->category_id){
//            $courses = Course::when($request->category_id, function ($query) use ($request) {
//                $query->where('category_id', $request->category_id);
//            })->where('id', '!=', 13)->where('category_id', '!=', 7)->with('category')->get();
//        } else {
//            $courses = Course::take(20)->where('id', '!=', 13)->where('category_id', '!=', 7)->get();
//        }
//
//        return view('frontend.courses.index', compact('courses', 'categories','venues'));
//    }

    public function index(Request $request)
    {
        $categories      = Category::all();
        $venues          = Venue::all();
        $today           = now()->toDateString();

        // distinct awarding bodies available on active courses
        $awardingBodies  = AwardingBody::orderBy('name')->get();

        // distinct durations from active courses
        $durations       = Course::query()
            ->where('status', 'active')
            ->where('category_id', '!=', 7)
            ->where('id', '!=', 13)
            ->distinct()
            ->orderBy('duration')
            ->pluck('duration');

        // AJAX pagination
        if ($request->ajax()) {
            $courses = Course::query()
                ->where('status', 'active')
                ->where('category_id', '!=', 7)
                ->where('id', '!=', 13)
                ->when($request->category_id && $request->category_id != 0, function ($query) use ($request) {
                    $query->where('category_id', $request->category_id);
                })
                ->when($request->venue_id, function ($query) use ($request, $today) {
                    $query->whereHas('cohorts', function ($q) use ($request, $today) {
                        $q->where('venue_id', $request->venue_id)
                            ->whereDate('start_date_time', '>=', $today);
                    });
                })
                ->when($request->awarding_body_id, function ($query) use ($request) {
                    // column in courses table is `awarding_bodies` (holding the id = 1,2,3,...)
                    $query->where('awarding_bodies', $request->awarding_body_id);
                })
                ->when($request->duration, function ($query) use ($request) {
                    $query->where('duration', $request->duration);
                })
                ->skip((int) $request->offset)
                ->take(6)
                ->with('category', 'awardingBody')
                ->get();

            return response()->json(['courses' => $courses]);
        }

        // Normal page load
        $courses = Course::query()
            ->where('status', 'active')
            ->where('category_id', '!=', 7)
            ->where('id', '!=', 13)
            ->when($request->category_id && $request->category_id != 0, function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->when($request->venue_id, function ($query) use ($request, $today) {
                $query->whereHas('cohorts', function ($q) use ($request, $today) {
                    $q->where('venue_id', $request->venue_id)
                        ->whereDate('start_date_time', '>=', $today);
                });
            })
            ->when($request->awarding_body_id, function ($query) use ($request) {
                $query->where('awarding_bodies', $request->awarding_body_id);
            })
            ->when($request->duration, function ($query) use ($request) {
                $query->where('duration', $request->duration);
            })
            ->with('category', 'awardingBody')
            ->take(20)
            ->get();


        // Get bundles 9, 10, and 11 only
        $bundles = CourseBundle::whereIn('id', [9, 10, 11])->get();

        foreach ($bundles as $bundle) {
            $productIds = json_decode($bundle->products, true);
            $bundle->courses = is_array($productIds)
                ? Course::whereIn('id', $productIds)->select('id', 'slug', 'name')->get()
                : collect();
        }

        return view('frontend.courses.index', compact(
            'courses',
            'categories',
            'venues',
            'awardingBodies',
            'durations',
            'bundles'
        ));
    }


//    public function index(Request $request)
//    {
//        $categories = Category::all();
//        $venues = Venue::all();
//        $today = now()->toDateString();
//
//        // AJAX pagination
//        if ($request->ajax()) {
//            $courses = Course::skip($request->offset)
//                ->where('status', 'active') // ✅ only active courses
//                ->take(6)
//                ->where('category_id', '!=', 7)
//                ->when($request->venue_id, function ($query) use ($request, $today) {
//                    $query->whereHas('cohorts', function ($q) use ($request, $today) {
//                        $q->where('venue_id', $request->venue_id)
//                            ->whereDate('start_date_time', '>=', $today);
//                    });
//                })
//                ->get();
//
//            return response()->json(['courses' => $courses]);
//        }
//
//        // Normal page load
//        $courses = Course::query()
//            ->where('status', 'active') // ✅ only active courses
//            ->when($request->category_id && $request->category_id != 0, function ($query) use ($request) {
//                $query->where('category_id', $request->category_id);
//            })
//            ->when($request->venue_id, function ($query) use ($request, $today) {
//                $query->whereHas('cohorts', function ($q) use ($request, $today) {
//                    $q->where('venue_id', $request->venue_id)
//                        ->whereDate('start_date_time', '>=', $today);
//                });
//            })
//            ->where('id', '!=', 13)
//            ->where('category_id', '!=', 7)
//            ->with('category')
//            ->take(20)
//            ->get();
//
//        return view('frontend.courses.index', compact('courses', 'categories', 'venues'));
//    }


    public function getCoursesByCategory(Category $category)
    {
        // Load courses with awardingBody relationship, only active courses
        $category->load(['courses' => function ($query) {
            $query->where('status', 'active') // assuming 'status' column
            ->with('awardingBody');
        }]);

        return view('frontend.categories.index', compact('category'));
    }

    public function show(Course $slug)
    {
        $course = Course::with(['cohorts' => function ($query) {
            $query->where('cohort_status', 1)
                ->where('start_date_time', '>=', Carbon::tomorrow()) // Only future/current cohorts
                ->with('venue');
        }])->findOrFail($slug->id);



        $locations = $course->cohorts->groupBy('venue.id');
        $Courselocations = $locations->map(function ($cohorts) {
             return $cohorts->first()->venue;
        })->values();

        $locations = $course->cohorts->groupBy('venue.id');

        $courseLocations = $locations->map(function ($cohorts) {
            return $cohorts->first()->venue;
        })->values();


        return view('frontend.courses.show', compact('slug','locations','Courselocations'));
    }

    public function elearning()
    {
        $courses = Course::where('delivery_mode','Elearning')->paginate(50);
        return view('frontend.elearning.index', compact('courses'));
    }
    public function eLearningShow(Course $slug)
    {
        $course = Course::with('cohorts.venue')->findOrFail($slug->id);
        $locations = $course->cohorts->groupBy('venue.id');
        $Courselocations = $locations->map(function ($cohorts) {
            return $cohorts->first()->venue;
        })->values();
        return view('frontend.elearning.show', compact('slug','locations','Courselocations'));
    }

}
