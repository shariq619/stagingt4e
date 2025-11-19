<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\LearnerReminderMail;
use App\Models\Category;
use App\Models\Cohort;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Qualification;
use App\Models\TaskSubmission;
use App\Models\User;
use App\Models\Venue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CohortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index(Request $request)
//    {
//        $sort = $request->get('sort', 'asc');
//        $search = $request->input('search', '');
//
//        // Filter cohorts based on course, corporate client, or trainer names
//        $cohorts = Cohort::with('course', 'corporateClient', 'trainer')
//            ->when($search, function ($query, $search) {
//                return $query->whereHas('course', function ($q) use ($search) {
//                    $q->where('name', 'like', "%{$search}%");
//                })
//                    // ->orWhereHas('corporateClient', function ($q) use ($search) {
//                    //     $q->where('client_name', 'like', "%{$search}%"); // Assuming client_name exists
//                    // })
//                    ->orWhereHas('trainer', function ($q) use ($search) {
//                        $q->where('name', 'like', "%{$search}%"); // Assuming name exists for trainer
//                    });
//            })
//            ->orderBy('start_date_time', $sort)
//            ->paginate(10);
//
//        // Append search and sort parameters to pagination links
//        $cohorts->appends(['sort' => $sort, 'search' => $search]);
//
//        return view('backend.cohorts.index', compact('cohorts', 'sort'));
//    }

    public function index(Request $request)
    {
        $sort = $request->get('sort', 'asc');
        $search = $request->input('search', '');
        $with_learners = $request->input('with_learners', false); // New parameter

        // Get filter values from request
        $year = $request->input('year');
        $month = $request->input('month');
        $course_id = $request->input('course_id');
        $venue_id = $request->input('venue_id');
        $trainer_id = $request->input('trainer_id');

        // Get filter options for dropdowns
        $years = Cohort::selectRaw('YEAR(start_date_time) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        //$courses = Course::orderBy('name')->pluck('name', 'id');

        $priorityIds = [5,6,1, 2, 3, 4, 12];
//        $courses = Course::orderByRaw("FIELD(id, ".implode(',', $priorityIds).") DESC")
//            ->orderBy('name')
//            ->pluck('name', 'id');

        $courses = Course::with(['cohorts.reseller'])
            ->orderByRaw("FIELD(id, ".implode(',', $priorityIds).") DESC")
            ->orderBy('name')
            ->get()
            ->map(function ($course) {

                // get first cohort (or null)
                $cohort = $course->cohorts->first();

                // get reseller company_name if exists
                $resellerName = optional(optional($cohort)->reseller)->company ?? " (T4E)";

                return [
                    'id'   => $course->id,
                    'name' => $resellerName
                        ? "{$course->name} ({$resellerName})"
                        : $course->name
                ];
            });



        $venues = Venue::orderBy('venue_name')->pluck('venue_name', 'id');
        $trainers = User::role('trainer')->orderBy('name')->pluck('name', 'id');

        // Filter cohorts
        $cohorts = Cohort::with('course', 'corporateClient', 'trainer', 'venue')
            ->withCount('learners')
            ->when($search, function ($query, $search) {
                return $query->whereHas('course', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                    ->orWhereHas('trainer', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->when($year, function ($query, $year) {
                return $query->whereYear('start_date_time', $year);
            })
            ->when($month, function ($query, $month) {
                return $query->whereMonth('start_date_time', $month);
            })
            ->when($course_id, function ($query, $course_id) {
                return $query->where('course_id', $course_id);
            })
            ->when($venue_id, function ($query, $venue_id) {
                return $query->where('venue_id', $venue_id);
            })
            ->when($trainer_id, function ($query, $trainer_id) {
                return $query->where('trainer_id', $trainer_id);
            })
            ->when($with_learners, function ($query) {
                return $query->has('learners'); // Only cohorts with learners
            })
            ->orderBy('start_date_time', $sort)
            ->paginate(25);

        // Append all parameters to pagination links
        $cohorts->appends([
            'sort' => $sort,
            'search' => $search,
            'year' => $year,
            'month' => $month,
            'course_id' => $course_id,
            'venue_id' => $venue_id,
            'trainer_id' => $trainer_id,
            'with_learners' => $with_learners
        ]);

        return view('backend.cohorts.index', compact(
            'cohorts',
            'sort',
            'years',
            'courses',
            'venues',
            'trainers',
            'year',
            'month',
            'course_id',
            'venue_id',
            'trainer_id',
            'with_learners'
        ));
    }

    // public function index(Request $request)
    // {
    //     $sort = $request->get('sort', 'desc');
    //     $search = $request->input('search', '');

    //     $cohorts = Cohort::with('course', 'corporateClient', 'trainer')
    //         ->when($search, function ($q, $search) {
    //             return $q->where('name', 'like', "%{$search}%");
    //         })
    //         ->orderBy('start_date_time', $sort)
    //         ->paginate(3);

    //         $cohorts->appends(['sort' => $sort, 'search' => $search]);
    //     return view('backend.cohorts.index', compact('cohorts', 'sort'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$courses = Course::all();
        $priorityIds = [5,6,1, 2, 3, 4, 12];
        $courses = Course::with(['cohorts.reseller'])
            ->orderByRaw("FIELD(id, ".implode(',', $priorityIds).") DESC")
            ->orderBy('name')
            ->get()
            ->map(function ($course) {

                // get first cohort (or null)
                $cohort = $course->cohorts->first();

                // get reseller company_name if exists
                $resellerName = optional(optional($cohort)->reseller)->company ?? " (T4E)";

                return [
                    'id'   => $course->id,
                    'name' => $resellerName
                        ? "{$course->name} ({$resellerName})"
                        : $course->name
                ];
            });

        $venues = Venue::all();
        $trainers = User::role('Trainer')->get();
        $resellers = User::role('Reseller')->get();
        $clients = User::role('Corporate Client')->get();
        return view('backend.cohorts.create', compact('courses', 'venues', 'trainers', 'clients','resellers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                'course_id' => 'required|exists:courses,id',
                'venue_id' => 'required|exists:venues,id',
                'max_learner' => 'required',
                'delivery_mode' => 'required',
                'start_date_time' => 'required|date',
                'end_date_time' => 'required|date',
        ]);

        Cohort::create([
                'course_id' => $request->course_id,
                'reseller_id' => $request->reseller_id ?? null,
                'venue_id' => $request->venue_id,
                'max_learner' => $request->max_learner,
                'delivery_mode' => $request->delivery_mode,
                'trainer_id' => $request->trainer_id,
                'start_date_time' => $request->start_date_time,
                'end_date_time' => $request->end_date_time,
                'additional_times' => ($request->filled('second_start_time') && $request->filled('second_end_time'))
                ? json_encode([
                    'second_start_time' => $request->second_start_time,
                    'second_end_time' => $request->second_end_time,
                ])
                : null,
                'is_weekend' => $request->has('is_weekend') ? 1 : 0, // Ensure only 0 or 1 is saved
                'is_soldout' => $request->has('is_soldout') ? 1 : 0, // Ensure only 0 or 1 is saved
                'user_id' => auth()->id(),
        ]);

//        $validatedData = $request->validate(
//            [
//                'course_id' => 'required|exists:courses,id',
//                'venue_id' => 'required|exists:venues,id',
//                'max_learner' => 'required',
//                'delivery_mode' => 'required',
//                'schedules' => 'required|array',
//                'schedules.*.start_date_time' => 'required|date',
//                'schedules.*.end_date_time' => 'required|date|after_or_equal:schedules.*.start_date_time',
//                //'schedules.*.trainer_id' => 'required',
//            ],
//            [
//                'delivery_mode.required' => 'The delivery mode field is required.',
//                'course_id.required' => 'The course field is required.',
//                'venue_id.required' => 'The venue field is required.',
//                'schedules.*.start_date_time.required' => 'Each cohort must have a start date and time.',
//                'schedules.*.end_date_time.required' => 'Each cohort must have an end date and time.',
//                'schedules.*.end_date_time.after_or_equal' => 'The end date and time must be after or equal to the start date and time.',
//                //'schedules.*.trainer_id.required' => 'Each schedule must have a trainer assigned.',
//            ]
//        );
//
//        foreach ($validatedData['schedules'] as $schedule) {
//            Cohort::create([
//                'course_id' => $validatedData['course_id'],
//                'venue_id' => $validatedData['venue_id'],
//                'max_learner' => $validatedData['max_learner'],
//                'delivery_mode' => $validatedData['delivery_mode'],
//                'trainer_id' => $schedule['trainer_id'] ?? NULL,
//                'start_date_time' => $schedule['start_date_time'],
//                'end_date_time' => $schedule['end_date_time'],
//                'user_id' => auth()->id(),
//            ]);
//        }

        return redirect()->route('backend.cohorts.index')->with('success', 'Cohorts Created Successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$courses = Course::all();

        $priorityIds = [5,6,1, 2, 3, 4, 12];
        $courses = Course::with(['cohorts.reseller'])
            ->orderByRaw("FIELD(id, ".implode(',', $priorityIds).") DESC")
            ->orderBy('name')
            ->get()
            ->map(function ($course) {

                // get first cohort (or null)
                $cohort = $course->cohorts->first();

                // get reseller company_name if exists
                $resellerName = optional(optional($cohort)->reseller)->company ?? " (T4E)";

                return [
                    'id'   => $course->id,
                    'name' => $resellerName
                        ? "{$course->name} ({$resellerName})"
                        : $course->name
                ];
            });


        $venues = Venue::all();
        $trainers = User::role('Trainer')->get();
        $clients = User::role('Corporate Client')->get();
        $resellers = User::role('Reseller')->get();
        // Use findOrFail() to retrieve a single record by ID
        $cohort = Cohort::with('course', 'corporateClient', 'trainer')->findOrFail($id);
        return view('backend.cohorts.edit', compact('cohort', 'courses', 'venues', 'trainers', 'clients','resellers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cohort $cohort)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'start_date_time' => 'required|date',
            'end_date_time' => 'required|date|after_or_equal:start_date',
            'venue_id' => 'required|exists:venues,id',
            'max_learner' => 'required',
            'reseller_id' => 'nullable|exists:users,id',
            // 'trainer_id' => 'required',
            // 'corporate_client_id' => 'required',
        ]);

        $cohort->update([
            'course_id' => $request->course_id,
            'reseller_id' => $request->reseller_id,
            'start_date_time' => $request->start_date_time,
            'end_date_time' => $request->end_date_time,
            'additional_times' => ($request->filled('second_start_time') && $request->filled('second_end_time'))
                ? json_encode([
                    'second_start_time' => $request->second_start_time,
                    'second_end_time' => $request->second_end_time,
                ])
                : null,
            'venue_id' => $request->venue_id,
            'max_learner' => $request->max_learner,
            'trainer_id' => $request->trainer_id,
            //  'corporate_client_id' => $request->corporate_client_id,
            'booking_reference' => $request->booking_reference,
            'user_id' => auth()->id(),
            'is_weekend' => $request->has('is_weekend') ? 1 : 0, // Ensure only 0 or 1 is saved
            'is_soldout' => $request->has('is_soldout') ? 1 : 0, // Ensure only 0 or 1 is saved
        ]);

        TaskSubmission::where('cohort_id', $cohort->id)
            ->where('course_id', $request->course_id)
            ->update(['trainer_id' => $request->trainer_id]);


        return redirect()->route('backend.cohorts.index')->with('success', 'Cohort Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cohort $cohort)
    {
        $cohort->delete();
        return redirect()->route('backend.cohorts.index')->with('success', 'Cohort Deleted Successfully');
    }

    public function showUsers($id)
    {
        $cohort = Cohort::with([
            'course' => function ($query) {
                $query->with(['tasks' => function ($taskQuery) {
                    $taskQuery->where('task_code', null)->orWhere('task_code', '')
                        ->where('type', '!=' , 'Reminders');
                }]);
            },
            'users',
            'users.taskSubmissions.license',
            'users.certificates',
        ])->findOrFail($id);

        return view('backend.cohorts.users', compact('cohort'));
    }

    public function sendReminder(Request $request)
    {

        $user = User::with([
            'applicationForm',
            'profilePhoto',
            'documentUpload',
            'taskSubmissions.task',
            'cohorts' => function($query) use ($request) {
                $query->where('cohort_id', $request->cohort_id);
            }
        ])->findOrFail($request->user_id);

        $cohort = Cohort::with('course.tasks')->findOrFail($request->cohort_id);

        // Collect all incomplete items
        $incompleteItems = [];

        // Check application form
        if (!$user->applicationForm || $user->applicationForm->status === 'Rejected') {
            $incompleteItems[] = 'Application Form';
        }

        // Check profile photo
        if (!$user->profilePhoto || $user->profilePhoto->status === 'Rejected') {
            $incompleteItems[] = 'Profile Photo';
        }

        // Check proof of ID
        if (!$user->documentUpload || $user->documentUpload->status === 'Rejected') {
            $incompleteItems[] = 'Proof of ID';
        }

        // Check tasks
        foreach ($cohort->course->tasks->where('type', '!=', 'Reminders')->filter(function($task) {
            return empty($task->task_code);
        }) as $task) {
            $submission = $user->taskSubmissions->where('task_id', $task->id)->first();
            if (!$submission || $submission->status === 'Rejected') {
                $incompleteItems[] = $task->name . ' (Self-Study)';
            }
        }

        // Check e-learning (licenses)
        foreach ($user->taskSubmissions as $submission) {
            if (is_null($submission->task_id)) {
                if (!$submission->status || $submission->status === 'Rejected' || $submission->status === 'Not Submitted') {
                    $incompleteItems[] = ($submission->license->name ?? 'E-Learning Module') . ' (E-Learning)';
                }
            }
        }

        // If there are incomplete items, send the email
        if (!empty($incompleteItems)) {
            Mail::to($user->email)->send(new LearnerReminderMail(
                $user,
                $incompleteItems,
                $cohort
            ));

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'No incomplete items found']);
    }

    public function approve(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:task_submissions,id',
        ]);

        $submission = TaskSubmission::find($request->task_id);
        $submission->status = 'Approved';
        $submission->comments = 'Submitted Manually';
        $submission->save();

        return response()->json([
            'message' => 'Submission approved successfully.'
        ]);
    }
    public function taskCreate(Request $request)
    {
        $submission = new TaskSubmission();

        $submission->user_id = $request->user_id;
        $submission->task_id = $request->task_id;
        $submission->course_id = $request->course_id;
        $submission->cohort_id = $request->cohort_id;
        $submission->trainer_id = $request->trainer_id;
        $submission->status = 'Approved';
        $submission->comments = 'Submitted Manually';
        $submission->save();

        return response()->json([
            'message' => 'Submission approved successfully.'
        ]);
    }

    public function toggleStatus(Request $request)
    {
        $cohort = Cohort::findOrFail($request->cohort_id);
        $cohort->cohort_status = $request->status;
        $cohort->save();

        return response()->json([
            'success' => true,
            'new_status' => $cohort->cohort_status
        ]);
    }

}
