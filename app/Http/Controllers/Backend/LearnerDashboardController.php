<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Libraries\ScormApiService;
use App\Models\ApplicationForm;
use App\Models\Course;
use App\Models\LearnerCertificate;
use App\Models\Resource;
use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LearnerDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $learnerUploads = ApplicationForm::pluck();
        // return view('backend.learner_dashboard.learner-dashboard')
    }

    public function viewFlipbook($taskId)
    {
        $task = Task::findOrFail($taskId);
        return view('backend.tasks.flipbook', compact('task'));
    }

    public function viewResourceFlipbook(Resource $resource)
    {
        return view('backend.tasks.resource_flipbook', compact('resource'));
    }


    public function learnerDashboard()
    {
        $learner = auth()->user();
        $resources = Resource::with('courses')->get();
        $cohorts = $learner->cohorts()
            ->with(['course.tasks','course.licenses']) // Load the course with its associated tasks
            ->get();



        $dashboardData = [];
        foreach ($cohorts as $cohort) {
            $courseData = [];

            if ($cohort->course) {
                $courseData['id'] = $cohort->course->id;
                $courseData['trainer_id'] = $cohort->trainer_id;
                $courseData['date_enrolled'] = $cohort->pivot->created_at;
                $courseData['name'] = $cohort->course->name;
                $courseData['cohort_status'] = $cohort->status;
                $courseData['venue_name'] = $cohort->venue->venue_name;


                $courseData['taskSubmissions'] = $cohort->taskSubmissions->where('user_id', $learner->id)->map(function ($taskSubmissions) {
                    return [
                        'act_name' => $taskSubmissions->license->name ?? "" ,
                        'act_document' => $taskSubmissions->act_document
                    ];
                });


                // highfield certificate
                $courseData['highfield_certificate'] = $cohort->highFieldCertificates
                            ->where('user_id', $learner->id)
                            ->map(function ($highfield_certificate) {
                    return [
                        'issued_date' => $highfield_certificate->created_at, // Assuming you have an `issued_date` column
                        'file_path' => $highfield_certificate->file_path,    // Optional, if you store the certificate file
                    ];
                });

                // certificate
                $courseData['certificate'] = $cohort->certificates
                    ->where('user_id', $learner->id)
                    ->map(function ($certificate) {
                        return [
                            'id' => $certificate->id,
                            'license_name' => $certificate->license->name,
                            'issued_date' => $certificate->created_at,
                            'certificate_path' => $certificate->certificate_path,
                        ];
                    });


                $courseData['tasks'] = $cohort->course->tasks->map(function ($task) use ($learner, $cohort) {
                    // Check if the learner has submitted this task
                    $submission = TaskSubmission::where('user_id', $learner->id)
                        ->where('task_id', $task->id)
                        ->where('cohort_id', $cohort->id)
                        ->first();

                    return [
                        'id' => $task->id,
                        'name' => $task->name,
                        'type' => $task->type,
                        'status' => $submission ? $submission->status : 'Not Submitted', // Fetch task submission status
                        'comments' => $submission ? $submission->comments : null, // Fetch comments, if any
                        'submission_id' => $submission ? $submission->id : null, // Fetch comments, if any
                    ];
                });

                // Fetch licenses
                $courseData['licenses'] = $cohort->course->licenses->map(function ($license) use ($learner, $cohort) {


                    //dd($learner->id,$cohort->id,$license->id);

                    // Check if the learner has submitted this task
                    $submission = TaskSubmission::where('user_id', $learner->id)
                        ->where('cohort_id', $cohort->id)
                        ->where('course_id', $cohort->course->id)
                        ->where('license_id', $license->id)
                        ->first();

                    //dump($submission);


                    return [
                        'id' => $license->id,
                        'name' => $license->name,
                        'scorm_registration_id' => $submission->scorm_registration_id ?? 0,
                        'scorm_course_id' => $submission->scorm_course_id ?? 0,
                        'scorm_course_link' =>$submission->scorm_course_link ?? 0,
                        'act_document' => $submission->act_document ?? "",
                        'status' => $submission->status ?? "",
                        'task_submission_id' => $submission->id ?? "",
                    ];
                });

                // Fetch learner’s exam results for this cohort
                $examResults = \App\Models\ExamResult::with('exam') // eager load exam title/type
                ->where('learner_id', $learner->id)
                    ->where('cohort_id', $cohort->id)
                    ->get()
                    ->map(function ($result) {
                        return [
                            'exam_id' => $result->exam_id,
                            'exam_name' => $result->exam->name ?? 'N/A',
                            'type' => $result->exam->type ?? '',
                            'score' => $result->score,
                            'status' => $result->status,
                        ];
                    });

                $courseData['exam_results'] = $examResults;

            } else {
                $courseData['id'] = $cohort->course->id;
                $courseData['is_weekend'] = $cohort->is_weekend;
                $courseData['trainer_id'] = $cohort->trainer_id;
                $courseData['name'] = null; // No course assigned
                $courseData['tasks'] = collect(); // Empty collection for tasks
                $courseData['licenses'] = collect(); // Empty collection for licenses
            }

            $dashboardData[] = [
                'cohort_id' => $cohort->id,
                'start_date_time' => $cohort->start_date_time,
                'end_date_time' => $cohort->end_date_time,
                'is_weekend' => $cohort->is_weekend,
                'course' => $courseData,
            ];
        }

       // dd($dashboardData);


        $tasks = Task::whereHas('courses.cohorts', function ($query) use ($learner) {
            $query->whereHas('users', function ($query) use ($learner) {
                $query->where('user_id', $learner->id);
            });
        })
            ->whereIn('name', [
                'DS Distance Learning Booklet',
                'CCTV Distance Learning Booklet',
                'DS Top-Up Textbook',
                'SG Top-Up Textbook',
                'DS Refresher Coursebook',
                'Security Guard Course book',
            ])
            ->distinct()
            ->get();


        // Separate query to count total tasks
        $flipbook = [
            'DS Distance Learning Booklet',
            'CCTV Distance Learning Booklet',
            'DS Top-Up Textbook',
            'SG Top-Up Textbook',
            'Security Guard Course book',
            'DS Refresher Coursebook',
        ];

        $totalTasks = Task::whereHas('courses.cohorts', function ($query) use ($learner) {
            $query->whereHas('users', function ($query) use ($learner) {
                $query->where('user_id', $learner->id);
            });
        })
            ->whereNotIn('name', $flipbook) // Exclude tasks in the flipbook array
            ->where('type', '!=', 'Reminders') // Exclude tasks of type 'Reminders'
            ->count();

        // Count completed tasks
        $totalCompletedTasks = Task::whereHas('courses.cohorts', function ($query) use ($learner) {
            $query->whereHas('users', function ($query) use ($learner) {
                $query->where('user_id', $learner->id);
            });
        })
            ->whereNotIn('name', $flipbook) // Exclude tasks in the flipbook array
            ->where('type', '!=', 'Reminders') // Exclude tasks of type 'Reminders'
            ->whereHas('submissions', function ($query) use ($learner) {
                $query->where('user_id', $learner->id)
                    ->where('status', 'Approved'); // Only count tasks with status 'Approved'
            })
            ->count();

        $totalInProgress = Task::whereHas('courses.cohorts', function ($query) use ($learner) {
            $query->whereHas('users', function ($query) use ($learner) {
                $query->where('user_id', $learner->id);
            });
        })
            ->whereNotIn('name', $flipbook) // Exclude tasks in the flipbook array
            ->where('type', '!=', 'Reminders') // Exclude tasks of type 'Reminders'
            ->whereHas('submissions', function ($query) use ($learner) {
                $query->where('user_id', $learner->id)
                    ->where('status', 'In Progress'); // Only count tasks with status 'Approved'
            })
            ->count();

        // Count incomplete tasks
        $totalIncompleteTasks = Task::whereHas('courses.cohorts', function ($query) use ($learner) {
            $query->whereHas('users', function ($query) use ($learner) {
                $query->where('user_id', $learner->id);
            });
        })
            ->whereNotIn('name', $flipbook) // Exclude tasks in the flipbook array
            ->where('type', '!=', 'Reminders') // Exclude tasks of type 'Reminders'
            ->whereDoesntHave('submissions', function ($query) use ($learner) {
                $query->where('user_id', $learner->id)
                    ->whereIn('status', ['Approved','In Progress']); // Exclude tasks with status 'Approved'
            })
            ->count();

        //dd($totalIncompleteTasks);

        // Separate query to count total courses
        $totalCourses = Course::whereHas('cohorts.users', function ($query) use ($learner) {
            $query->where('user_id', $learner->id);
        })->count();

        // Get the count of uploaded certificates
        $uploadedCertificates = LearnerCertificate::where('user_id', $learner->id)->count();



        // Get the count of pending certificates
        $pendingCertificates = $totalCourses - $uploadedCertificates;

        $unreadCount = auth()->user()->receivedMessages()->where('is_read', 0)->count();
        $readCount = auth()->user()->receivedMessages()->where('is_read', 1)->count();

        //dd($totalInProgress);

        return view('backend.dashboard.learner_dashboard', compact('resources','totalInProgress','learner','uploadedCertificates','pendingCertificates','dashboardData','tasks','totalTasks','totalCourses','unreadCount','readCount','totalCompletedTasks','totalIncompleteTasks'));
    }

    public function getLaunchLink($registrationId)
    {
        $scormApiService = new ScormApiService();

        $launchLinkResponse = $scormApiService->generateLaunchLink($registrationId, 300, route('backend.learner.dashboard'));

        return response()->json([
            'launchLink' => $launchLinkResponse['launchLink'] ?? null
        ]);
    }


    public function uploadActDocument(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:png,jpeg,jpg,pdf|max:10240', // max 10MB
            'task_submission_id' => 'required|exists:task_submissions,id',
        ]);


        $uploadedFile = $request->file('file');
        $fileName = auth()->user()->name . '_' . $uploadedFile->getClientOriginalName();
        $filePath = $uploadedFile->storeAs('learners' . '/' . auth()->user()->name .'/act_document/', $fileName, 'public');

        // Find the TaskSubmission record (modify logic as needed)
        $submission = TaskSubmission::findOrFail($request->task_submission_id);

        $submission->act_document = 'storage/' . $filePath;
        $submission->save();

        return response()->json(['message' => 'File uploaded successfully.']);
    }

    public function removeActDocument(Request $request)
    {
        $request->validate([
            'task_submission_id' => 'required|exists:task_submissions,id',
        ]);

        $submission = TaskSubmission::findOrFail($request->task_submission_id);

//        if ($submission->act_document && Storage::disk('local')->exists($submission->act_document)) {
//            Storage::disk('local')->delete($submission->act_document);
//        }

        $submission->act_document = null;
        $submission->save();

        return response()->json(['message' => 'File removed successfully.']);
    }


//        // Get the logged-in user
//        $learner = auth()->user();
//
//        // Get the learner's cohorts
//        $cohorts = $learner->cohorts;
//
//        // Initialize an empty task collection
//        $tasks = collect();
//
//        // Loop through each cohort to get associated tasks
//        foreach ($cohorts as $cohort) {
//            // Get tasks assigned to the course of the cohort
//            $tasks = $tasks->merge($cohort->tasks);
//        }
//
//        // Remove duplicate tasks if necessary
//        $tasks = $tasks->unique('id');
//
//        // Group tasks by 'type'
//        $groupedTasks = $tasks->groupBy('type');
//
//
//        return view('backend.dashboard.learner_dashboard', compact( 'learner','groupedTasks'));


//        dd($tasks,$tasksBooklet);
//
//
//       // dd($tasksApproved);
//
//        $learnerApplications = ApplicationForm::where('learner_id', $user->id)->get();
//        $elearningCourses = DB::table('learner_elearning_courses')->where('learner_id', $user->id)->get();
//        $courses = Course::with(['category', 'subcategory'])
//            ->whereHas('category', function ($query) {
//                $query->whereColumn('id', 'courses.category_id');
//            })->paginate(4);
//
//        if ($user->hasRole('Learner') || $user->hasRole('Super Admin') ) {
//            return view('backend.dashboard.learner_dashboard', compact('learnerApplications', 'elearningCourses','courses','user','tasksGroupedByType','tasksApproved','tasksBooklet'));
//        } else {
//            return redirect()->route('backend.dashboard.index');
//        }
  //  }

    public function showTaskSubmissionForm(Task $task)
    {
        // Show the task submission form for the specific task
        $task_name = Str::snake(strtolower($task->name));




        return view('backend.tasks.'.$task_name, compact('task'));
    }

    public function submitTask(Request $request, Task $task)
    {
        // Validate the input
        $request->validate([
            'submission' => 'nullable|string',
            'submission_file' => 'nullable|file|max:2048', // 2MB max file size
        ]);

        // Store the task submission data
        $submission = new TaskSubmission();
        $submission->user_id = auth()->user()->id; // Current learner
        $submission->task_id = $task->id;
        $submission->submission_text = $request->submission;

        // Handle file upload
        if ($request->hasFile('submission_file')) {
            $filePath = $request->file('submission_file')->store('task_submissions');
            $submission->submission_file = $filePath;
        }

        $submission->save();

        // Redirect the learner back with a success message
        return redirect()->route('learner.dashboard')->with('success', 'Task submitted successfully!');
    }

    public function learnerViewTaskSubmission($submissionId)
    {
        // Retrieve the task submission using the provided ID
        $submission = TaskSubmission::findOrFail($submissionId);

        // Decode the trainer response JSON
        $trainerResponse = json_decode($submission->trainer_response, true);



        $high_field_response = json_decode($submission->high_field_response, true); // Decode the JSON data


        //dd($high_field_response);

        // Extract the 'total' key value and store it in a new variable
        $total = $trainerResponse['total'] ?? 0; // If 'total' exists, store it; otherwise, set it to 0


        $percentage = round(($total / 21) * 100, 2);



        // Remove the 'total' key from the $trainerResponse array
        unset($trainerResponse['total']);



        // Pass the data to the view
        return view('backend.learner_dashboard.view-task-submission', compact('submission', 'trainerResponse','total','percentage','high_field_response'));
    }


    public function cctvActivitySheet()
    {

        return view('backend.trainers.cctv_activity_sheet.index');
    }


}
