<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Cohort;
use App\Models\Course;
use App\Models\ExamResponse;
use App\Models\ExamResult;
use App\Models\FormResponse;
use App\Models\RiskAssessment;
use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\User;
use App\Models\Venue;
use App\Notifications\CourseWorkNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TrainerDashboardController extends Controller
{
    public function index()
    {
        $trainerId = auth()->user()->id;

        $submissions = TaskSubmission::with([
            'user', // Fetch the learner who submitted the task
            'task', // Fetch the related task
            'cohort.course', // Fetch the cohort and its course
            'cohort.venue'   // Fetch the venue for the cohort
        ])
            ->where('trainer_id', $trainerId) // Directly filter by trainer_id from task_submissions
            ->paginate(5);

        // Count completed tasks (status "Approved" is considered as completed)
        $completedTasksCount = TaskSubmission::where('trainer_id', $trainerId)
            ->where('status', 'Approved')
            ->count();

        // Count pending tasks (any status other than "Approved" is considered pending)
        $pendingTasksCount = TaskSubmission::where('trainer_id', $trainerId)
            ->whereIn('status', ['In Progress'])
            ->count();

        $assignedCohort = Cohort::with('course', 'venue')
            ->withCount('users')
            ->where('trainer_id', $trainerId) // Filter cohorts by trainer
            ->orderBy('start_date_time', 'desc') // ← Add this line
            ->paginate(10);

        //dd(auth()->user()->cohorts);

        $assignedCohortCount = Cohort::with('course', 'venue')
            ->withCount('users')
            ->where('trainer_id', $trainerId) // Filter cohorts by trainer
            ->count();

        $invoices = Cohort::with('course')
            ->withCount('users')
            ->where('invoice', '!=' , null) // Filter cohorts by trainer
            ->count();

        // $pendingTasksCount
        // $completedTasksCount


        //dd($assignedCohortCount);

        $lessonPlans = Cohort::whereNull('lesson_plan')
            ->where('trainer_id', $trainerId)
            ->with('course', 'venue') // assuming the relationship exists
            ->limit(5)
            ->get();

        $unreadCount = auth()->user()->receivedMessages()->where('is_read', 0)->count();
        $readCount = auth()->user()->receivedMessages()->where('is_read', 1)->count();

        $totalLearners = Cohort::where('trainer_id', $trainerId) // Filter cohorts by trainer
        ->withCount('users') // Count the number of users in each cohort
        ->get()
            ->sum('users_count'); // Sum up the 'users_count' column




        /*
         *
         *
         * NEW CHANGES
         */

        $submissionsQuery = TaskSubmission::with([
            'user',
            'task',
            'cohort.course.exams',
            'cohort.venue',
        ])->where('task_id', '!=', null)->where('trainer_id', $trainerId);

        $submissions = $submissionsQuery->get();

        // Group submissions by cohort
        $groupedSubmissions = $submissions->groupBy(function ($submission) {
            return $submission->cohort->id;
        })->map(function ($cohortSubmissions) {
            $cohortDetails = $cohortSubmissions->first()->cohort;

            if (!$cohortDetails) {
                throw new \Exception("Cohort is missing for one of the submissions.");
            }

            return [
                'cohort' => [
                    'id' => $cohortDetails->id, // Ensure ID is included
                    'course_name' => $cohortDetails->course->name,
                    'start_date' => $cohortDetails->start_date_time,
                    'end_date' => $cohortDetails->end_date_time,
                    'venue' => $cohortDetails->venue->venue_name,
                ],
                'learners' => $cohortSubmissions->groupBy('user_id')->map(function ($learnerSubmissions) use ($cohortDetails) {
                    $learner = $learnerSubmissions->first()->user;

                    // Fetch task submissions related to this learner and cohort
                    $submittedTasks = $learnerSubmissions->map(function ($submission) {
                        return [
                            'id' => $submission->task->id,
                            'user_id' => $submission->user_id,
                            'task_id' => $submission->task_id,
                            'cohort_id' => $submission->cohort_id,
                            'name' => $submission->task->name,
                            'description' => $submission->task->description,
                            'submission_date' => $submission->created_at,
                            'status' => $submission->status,
                        ];
                    });

                    return [
                        'id' => $learner->id,
                        'learner_name' => $learner->name.' '.$learner->last_name,
                        'learner_image' => $learner->image,
                        'learner_client' => $learner->client->name ?? "",
                        'exams' => $learnerSubmissions->first()->cohort->course->exams,
                        'submitted_tasks' => $submittedTasks->values(),
                    ];
                })->values(),
            ];
        })
        ->sortByDesc(fn ($data) => $data['cohort']['start_date'])
        ->take(10)
        ->values();

        return view('backend.trainer_dashboard.index', compact('groupedSubmissions','submissions', 'assignedCohort', 'lessonPlans','unreadCount','readCount','assignedCohortCount','totalLearners','completedTasksCount','pendingTasksCount'));
    }


    public function trainerMyCourses(Request $request)
    {
        // Assuming 'auth()->user()' is the logged-in trainer
        $trainerId = auth()->user()->id;

        // Base query for cohorts assigned to the trainer
        $cohortQuery = Cohort::with('course', 'venue')
            ->withCount('users')
            ->where('trainer_id', $trainerId);

        $submissions = TaskSubmission::with([
            'user', // Fetch the learner who submitted the task
            'task', // Fetch the related task
            'cohort.course', // Fetch the cohort and its course
            'cohort.venue'   // Fetch the venue for the cohort
        ])
            ->where('trainer_id', $trainerId) // Directly filter by trainer_id from task_submissions
            ->get();

        // Apply course filter
        if ($request->filled('course')) {
            $cohortQuery->where('course_id', $request->course);
        }


        $assignedCohort = $cohortQuery
            ->orderBy('start_date_time', 'desc')
            ->paginate(17);

        $lessonPlans = Cohort::whereNull('lesson_plan')
            ->with('course', 'venue') // assuming the relationship exists
            ->limit(5)
            ->get();

        // For select dropdowns
        $courses = Course::whereHas('cohorts', function ($query) use ($trainerId) {
            $query->where('trainer_id', $trainerId);
        })
            ->with(['cohorts' => function ($query) use ($trainerId) {
                $query->where('trainer_id', $trainerId)
                    ->orderBy('start_date_time', 'desc');
            }])
            ->get();



        $learners = User::whereHas('roles', fn($q) => $q->where('name', 'Learner'))->get();
        return view('backend.trainer_dashboard.trainer-courses', compact('assignedCohort', 'lessonPlans','learners','courses'));
    }

    public function trainerMyLearners(Request $request)
    {
        $trainerId = auth()->user()->id;

        // Step 1: Get cohorts assigned to the trainer
        $cohorts = Cohort::with(['course.tasks', 'venue', 'users.client', 'users.profilePhoto'])
            ->where('trainer_id', $trainerId)
            ->whereHas('users') // ✅ only include cohorts that have learners assigned
            ->when($request->filled('course'), fn($q) => $q->where('course_id', $request->course))
            ->when($request->filled('cohort'), fn($q) => $q->where('id', $request->cohort))
            ->when($request->filled('venue'), fn($q) => $q->where('venue_id', $request->venue))
            ->get();

        //dd($cohorts);

        $groupedSubmissions = $cohorts->map(function ($cohort) use ($request) {
            $course = $cohort->course;
            $tasks = $course->tasks;

            // Filter learners based on selected learner (if any)
            $users = $cohort->users->when($request->filled('learner'), function ($collection) use ($request) {
                return $collection->filter(fn($user) => $user->id == $request->learner);
            });

            $learners = $users->map(function ($user) use ($cohort, $tasks) {
                $submittedTasks = $tasks->map(function ($task) use ($user, $cohort) {
                    $submission = $task->submissions()
                        ->where('user_id', $user->id)
                        ->where('cohort_id', $cohort->id)
                        ->where('task_id', $task->id)
                        ->first();


                    if($submission !== null) {
                        return [
                            'id' => $task->id,
                            'user_id' => $user->id,
                            'task_id' => $task->id,
                            'cohort_id' => $cohort->id,
                            'name' => $task->name,
                            'description' => $task->description,
                            'submission_date' => $submission?->created_at,
                            'status' => $submission->status ?? 'Not Submitted',
                            'pdf' => $submission->pdf ?? '',
                            'trainer_response' => $submission->trainer_response ?? '',
                        ];
                    }

                    return null; // make null explicit

                })->filter(); // this removes all nulls


                return [
                    'id' => $user->id,
                    'learner_name' => $user->name . ' ' . $user->last_name,
                    'learner_image' => $user->image,
                    'profile_photo' => $user->profilePhoto->profile_photo ?? null, // ✅
                    'profile_photo_status' => $user->profilePhoto->status ?? null, // ✅
                    'learner_client' => $user->client->name ?? "",
                    'exams' => $cohort->course->exams,
                    'submitted_tasks' => $submittedTasks,
                ];
            });

            return [
                'cohort' => [
                    'id' => $cohort->id,
                    'course_name' => $course->name,
                    'start_date' => $cohort->start_date_time,
                    'end_date' => $cohort->end_date_time,
                    'venue' => $cohort->venue->venue_name,
                ],
                'learners' => $learners->values(),
            ];
        })->filter(function ($group) {
            // Only keep cohorts that have at least one learner
            return $group['learners']->isNotEmpty();
        })->values();

        // Filters
        $submitted_courses = Course::whereIn('id', $cohorts->pluck('course_id')->unique())->get();
        $submitted_cohorts = $cohorts;
        $venues = Venue::all();
        $trainers = User::whereHas('roles', fn($q) => $q->where('name', 'Trainer'))->get();
        $learners = User::whereHas('roles', fn($q) => $q->where('name', 'Learner'))->get();

        return view('backend.trainer_dashboard.trainer-learners', compact(
            'submitted_courses', 'submitted_cohorts', 'venues', 'groupedSubmissions','learners'
        ));
    }


    /*
    public function trainerMyLearners(Request $request)
    {
        $trainerId = auth()->user()->id;
        $submissionsQuery = TaskSubmission::with([
            'user',
            'task',
            'cohort.course.exams',
            'cohort.venue',
        ])->where('task_id', '!=', null)->where('trainer_id', $trainerId);


        // Apply course filter
        if ($request->filled('course')) {
            $submissionsQuery->whereHas('cohort.course', function ($query) use ($request) {
                $query->where('id', $request->course);
            });
        }

        // Apply cohort filter
        if ($request->filled('cohort')) {
            $submissionsQuery->whereHas('cohort', function ($query) use ($request) {
                $query->where('id', $request->cohort);
            });
        }

        if ($request->filled('venue')) {
            $submissionsQuery->whereHas('cohort.venue', function ($query) use ($request) {
                $query->where('id', $request->venue);
            });
        }



        // Get the submissions
        $submissions = $submissionsQuery->get();

        // Group submissions by cohort
        $groupedSubmissions = $submissions->groupBy(function ($submission) {
            return $submission->cohort->id;
        })->map(function ($cohortSubmissions) {
            $cohortDetails = $cohortSubmissions->first()->cohort;

            if (!$cohortDetails) {
                throw new \Exception("Cohort is missing for one of the submissions.");
            }

            return [
                'cohort' => [
                    'id' => $cohortDetails->id, // Ensure ID is included
                    'course_name' => $cohortDetails->course->name,
                    'start_date' => $cohortDetails->start_date_time,
                    'end_date' => $cohortDetails->end_date_time,
                    'venue' => $cohortDetails->venue->venue_name,
                ],
                'learners' => $cohortSubmissions->groupBy('user_id')->map(function ($learnerSubmissions) use ($cohortDetails) {
                    $learner = $learnerSubmissions->first()->user;

                    // Fetch task submissions related to this learner and cohort
                    $submittedTasks = $learnerSubmissions->map(function ($submission) {
                        return [
                            'id' => $submission->task->id,
                            'user_id' => $submission->user_id,
                            'task_id' => $submission->task_id,
                            'cohort_id' => $submission->cohort_id,
                            'name' => $submission->task->name,
                            'description' => $submission->task->description,
                            'submission_date' => $submission->created_at,
                            'status' => $submission->status,
                        ];
                    });

                    return [
                        'id' => $learner->id,
                        'learner_name' => $learner->name.' '.$learner->last_name,
                        'learner_image' => $learner->image,
                        'learner_client' => $learner->client->name ?? "",
                        'exams' => $learnerSubmissions->first()->cohort->course->exams,
                        'submitted_tasks' => $submittedTasks->values(),
                    ];
                })->values(),
            ];
        });

        // Fetch courses and learners for the filter form
        // Fetch unique courses
        $submitted_courses = TaskSubmission::with('cohort.course')
            ->whereNotNull('task_id')
            ->get()
            ->pluck('cohort.course') // Access the course through the cohort
            ->filter() // Remove null values in case of missing relationships
            ->unique('id') // Ensure courses are unique by their ID
            ->values(); // Reindex the collection

        // Fetch unique cohorts
        $submitted_cohorts = TaskSubmission::with('cohort')
            ->whereNotNull('task_id')
            ->get()
            ->pluck('cohort') // Access the cohort directly
            ->filter() // Remove null values
            ->unique('id') // Ensure cohorts are unique by their ID
            ->values(); // Reindex the collection

        $venues = Venue::all();
        $trainers = User::whereHas('roles', function ($q) {
            $q->where('name', 'Trainer');
        })->get();


        //dd($groupedSubmissions);

        return view('backend.trainer_dashboard.trainer-learners', compact( 'submitted_courses', 'submitted_cohorts','venues','groupedSubmissions'));
    }
    */

    public function viewTaskSubmission($user_id, $task_id, $cohort_id)
    {
        // Find the specific task submission
        $form_responses = TaskSubmission::with(['user', 'task', 'cohort.course', 'cohort.venue'])
            ->where('user_id', $user_id)
            ->where('task_id', $task_id)
            ->where('cohort_id', $cohort_id)
            ->firstOrFail(); // Return 404 if not found

        //dd(json_decode($form_responses->response,true));

        $task = Task::find($task_id);
        return view('backend.trainer_dashboard.trainer-review-mark', compact('form_responses', 'task'));
    }

    public function trainerMyTasks()
    {

        $trainerId = auth()->user()->id;

        $submissions = TaskSubmission::with([
            'user', // Fetch the learner who submitted the task
            'task', // Fetch the related task
            'cohort.course', // Fetch the cohort and its course
            'cohort.venue'   // Fetch the venue for the cohort
        ])
            ->where('trainer_id', $trainerId);

        $normal = $submissions->get();

        $groupedSubmissions = $normal->groupBy(['user_id', 'cohort_id']);

        $assignedCohort = Cohort::with('course', 'venue')
            ->withCount('users')
            ->where('trainer_id', $trainerId) // Filter cohorts by trainer
            ->get();

        $lessonPlans = Cohort::with('course', 'venue') // assuming the relationship exists
            ->limit(5)
            ->get();



        $englishAssessmentQuery = TaskSubmission::with([
            'user',             // Fetch the learner who submitted the task
            'task',             // Fetch the related task
            'cohort.course',    // Fetch the cohort and its course
            'cohort.venue'      // Fetch the venue for the cohort
        ])->where('trainer_id', $trainerId)->where('task_id',1); // Filter by trainer_id
        // Get the submissions
        $sub = $englishAssessmentQuery->get();
        // Group submissions by both learner and cohort
        $groupedEnglishSubmissions = $sub->groupBy(['user_id', 'cohort_id']);

        $selfStudyQuery = TaskSubmission::with([
            'user',             // Fetch the learner who submitted the task
            'task',             // Fetch the related task
            'cohort.course',    // Fetch the cohort and its course
            'cohort.venue'      // Fetch the venue for the cohort
        ])->where('trainer_id', $trainerId)->whereIn('task_id',[3,4,5,6]); // DS Activity Sheet, CCTV Activity Sheet, DS Top-Up Workbook, SG Top-Up Workbook
        // Get the submissions
        $self = $selfStudyQuery->get();
        // Group submissions by both learner and cohort
        $groupedSelfSubmissions = $self->groupBy(['user_id', 'cohort_id']);


        $licenseQuery = TaskSubmission::with([
            'user', // Fetch the learner who submitted the task
            'task', // Fetch the related task
            'cohort.course', // Fetch the cohort and its course
            'cohort.venue'   // Fetch the venue for the cohort
        ])
            ->where('trainer_id', $trainerId);

        $lic = $licenseQuery->get();
        $groupedLicSubmissions = $lic->groupBy(['user_id', 'cohort_id']);

        //dd($lic->toArray());

        return view('backend.trainer_dashboard.trainer-tasks', compact('submissions','lessonPlans','groupedSubmissions','groupedSelfSubmissions','groupedEnglishSubmissions','groupedLicSubmissions'));
    }

    public function reviewMark($user_id, $task_id)
    {
        $form_responses = FormResponse::where('user_id', $user_id)->where('task_id', $task_id)->first();
        $task = Task::find($task_id);
        //dd($form_responses);
        return view('backend.trainer_dashboard.trainer-review-mark', compact('form_responses', 'task'));
    }

//    public function riskAssessments()
//    {
//        return view('backend.trainer_dashboard.risk_assessment',compact('cohort'));
//    }

//    public function riskAssessment(Cohort $cohort)
//    {
//        return view('backend.trainer_dashboard.risk_assessment',compact('cohort'));
//    }
//
//    public function storeRiskAssessment(Request $request)
//    {
//        $cohort = Cohort::find($request->cohort_id);
//
//        $data = $request->validate([
//            'checklist' => 'array',
//            'comments' => 'array',
//            'hazards' => 'nullable|string',
//            'control_measures' => 'nullable|string',
//            'sign_date' => 'nullable|date',
//        ]);
//
//        // Merge checklist & comments into a single structure
//        $checklist = [];
//        foreach ($request->checklist ?? [] as $key => $status) {
//            $checklist[$key] = [
//                'status' => $status,
//                'comment' => $request->comments[$key] ?? null,
//            ];
//        }
//
//        $tutor_signature = $request->input('tutor_signature');
//
//        if ($tutor_signature) {
//            $tutor_signature = str_replace('data:image/png;base64,', '', $tutor_signature);
//            $tutor_signature = str_replace(' ', '+', $tutor_signature);
//            $tutor_signature = 'data:image/png;base64,' . $tutor_signature;
//        }
//
//
//        RiskAssessment::create([
//            'cohort_id'     => $cohort->id,
//            'venue_id'      => $cohort->venue_id,
//            'trainer_id'    => $cohort->trainer_id,
//            'course_name'   => $cohort->course->name,
//            'trainer_name'  => $cohort->trainer->name,
//
//            'checklist'     => $checklist,
//            'hazards'       => $request->hazards,
//            'control_measures' => $request->control_measures,
//            'tutor_signature'  => $tutor_signature,
//            'sign_date'        => $request->sign_date,
//        ]);
//
//        return redirect()->back()->with('success', 'Risk Assessment saved!');
//    }

    public function bulkUpdate(Request $request)
    {
        $status = $request->input('status');
        $submissionIds = $request->input('submissions', []);

        if (empty($submissionIds)) {
            return redirect()->back()->with('error', 'No submissions selected.');
        }

        TaskSubmission::whereIn('id', $submissionIds)
            ->update(['status' => $status]);

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function trainerTaskResponse(Request $request, $submission)
    {
        // Retrieve the submission using the passed submission ID
        $submission = TaskSubmission::findOrFail($submission);


        $signatureData = $request->input('signature');

        if ($signatureData) {
            $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
            $signatureData = str_replace(' ', '+', $signatureData);
            $signatureData = 'data:image/png;base64,' . $signatureData;
        } else {
            $signatureData = null;
        }

        $high_field_response = null;
        $high_field_response = $request->input('high_field_response');
        if(isset($high_field_response)) {
            $high_field_response['Assessors_signature'] = $signatureData;
        }


        // Retrieve the submitted answers and feedback
        $answers = $request->input('answers');
        $feedback = $request->input('feedback');
        $grade = $request->input('grade');

        if(isset($grade)){
            // Count occurrences of each value
            $countValues = array_count_values($grade);
            $count1 = $countValues['1'] ?? 0;
            $count2 = $countValues['2'] ?? 0;
            $totalGrades = $count1 + $count2;
        }


        // Retrieve the selected status
        $status = $request->input('status');

        // Prepare the JSON data
        $trainerResponse = [];
        if(isset($answers)){
            foreach ($answers as $questionId => $answer) {
                $trainerResponse[$questionId] = [
                    'answer' => $answer,
                    'feedback' => $feedback[$questionId] ?? null,
                    'grade' => $grade[$questionId] ?? null,

                ];
            }

            $trainerResponse['total'] = $totalGrades ?? null;

            // Save the trainer's response as JSON
            $submission->trainer_response = json_encode($trainerResponse);
        }



        // Update the status in the task_submission table
        $submission->high_field_response = $high_field_response;
        $submission->status = $status;
        $submission->save();

        // Send notification to the learner
        $learner = User::find($submission->user_id);
        $tsk = Task::find($submission->task_id);
        $task_url = route('backend.learner.dashboard');
        $message = 'You have a notification on task ' . $tsk->name;
        $learner->notify(new CourseWorkNotification($message, $task_url));


        // Redirect with a success message
        return redirect()->route('backend.trainer.dashboard')->with('success', 'Answers and feedback updated successfully!');
    }


    public function uploadLessonPlan(Request $request)
    {
        //        $request->validate([
        //            'lesson_plan' => 'required|file|mimes:pdf,doc,docx',
        //        ]);

        //dd($request->all());

        $cohortId = $request->cohort_id;

        // Store the uploaded lesson plan and associate it with the cohort
        $filePath = $request->file('lesson_plan')->store('lesson_plans', 'public');

        // Save the file path in the database (assuming you have a lesson_plan field in the cohort model)
        $cohort = Cohort::findOrFail($cohortId);
        //dd($cohort);
        $cohort->lesson_plan = $filePath;
        $cohort->save();

        // Return back with success message (optional)
        return redirect()->back()->with('success', 'Lesson Plan uploaded successfully!');
    }


    public function uploadInvoice(Request $request)
    {
        //        $request->validate([
        //            'invoice_file' => 'required|file|mimes:pdf,jpg,png|max:2048',
        //        ]);

        // Logic to handle file upload and save invoice in the database
        $cohort = Cohort::findOrFail($request->cohort_id);

        // Save file to storage and update cohort with invoice path
        $filePath = $request->file('invoice_file')->store('invoices', 'public');

        $cohort->invoice = $filePath;
        $cohort->save();

        return redirect()->back()->with('success', 'Invoice uploaded successfully.');
    }




}
