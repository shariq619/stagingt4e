<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Libraries\ScormApiService;
use App\Models\ApplicationForm;
use App\Models\Category;
use App\Models\Cohort;
use App\Models\Course;
use App\Models\DocumentUpload;
use App\Models\ExamResult;
use App\Models\HighFieldCertificate;
use App\Models\HighfieldQualification;
use App\Models\LearnerCertificate;
use App\Models\LearnerElearningCourse;
use App\Models\License;
use App\Models\ProfilePhoto;
use App\Models\TaskSubmission;
use App\Models\User;
use App\Models\Venue;
use App\Notifications\ProfilePhotoUploaded;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use setasign\Fpdi\Tcpdf\Fpdi;
class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $usersByRoleCount = Role::with('users')->get();

        $user_count = User::count();
        $courses = Course::with(['category', 'subcategory'])
            ->whereHas('category', function ($query) {
                $query->whereColumn('id', 'courses.category_id');
            })->paginate(4);

        // Count Learners
        $learner_count = User::whereHas('roles', function($q) {
            $q->where('name', 'Learner');
        })->count();

        // Count Admins
        $admin_count = User::whereHas('roles', function($q) {
            $q->where('name', 'Admin');
        })->count();

        // Count Trainers
        $trainer_count = User::whereHas('roles', function($q) {
            $q->where('name', 'Trainer');
        })->count();

        // Count Corporate Client
        $clients = User::whereHas('roles', function($q) {
            $q->where('name', 'Corporate Client');
        })->limit(5)->get();

        $trainers = User::whereHas('roles', function($q) {
            $q->where('name', 'Trainer');
        })->with(['trainerCohorts'])->paginate(5);


        $cohorts = Cohort::with('course')  // Load the related course
        ->withCount('users')           // Count the learners in the cohort
        ->limit(5)
            ->get();

        $courses_count = Course::count();

        $unreadCount = auth()->user()->receivedMessages()->where('is_read', 0)->count();
        $readCount = auth()->user()->receivedMessages()->where('is_read', 1)->count();

        $notifications = Auth::user()->notifications()->paginate(5);

        //dd($notifications);

        $total_license = License::all()->count();
        //dd($license);


        // Count for 'application_forms' table
        $applicationFormsInProgress = ApplicationForm::where('status', 'In Progress')->count();
        $applicationFormsApproved = ApplicationForm::where('status', 'Approved')->count();

        // Count for 'profile_photos' table
        $profilePhotosInProgress = ProfilePhoto::where('status', 'In Progress')->count();
        $profilePhotosApproved = ProfilePhoto::where('status', 'Approved')->count();

        // Count for 'document_uploads' table
        $documentUploadsInProgress = DocumentUpload::where('status', 'In Progress')->count();
        $documentUploadsApproved = DocumentUpload::where('status', 'Approved')->count();

        $total_task_pending = $applicationFormsInProgress + $profilePhotosInProgress + $documentUploadsInProgress;
        $total_task_completed = $applicationFormsApproved + $profilePhotosApproved + $documentUploadsApproved;


        // Call the API
        $scorm = null;
        $response = Http::withHeaders([
            'Authorization' => 'Basic U1NESTZCS1lIODpDQ1o0Z1M0Szd3OXd2V0I3NG1ZQmtQMWRwTjhLNnI3Zk1tc3lJQTd3',
            'Accept' => 'application/json',
        ])->get('https://cloud.scorm.com/api/v2/reporting/accountInfo');

        if ($response->successful()) {
            $data = $response->json();

            $limit = $data['regLimit'] ?? null;
            $used = $data['usage']['regCount'] ?? null;
            $monthStart = \Carbon\Carbon::parse($data['usage']['monthStart']);

            // Cycle end = same day next month - 1 second
            $monthEnd = $monthStart->copy()->addMonth()->subSecond();

            $scorm = [
                'total_registration_limit' => $limit,
                'used_registrations' => $used,
                'cycle_start' => $monthStart->toDateString(),
                'cycle_end' => $monthEnd->toDateString(),
                'remaining' => $limit - $used,
            ];
        }

        $qualifications = HighfieldQualification::all();

        if ($request->ajax()) {
            return view('backend.dashboard.pagination.pagination', compact('courses'))->render();
        }
        return view('backend.dashboard.index', compact('total_task_pending','total_task_completed','total_license','clients','cohorts','trainers','learner_count','admin_count','trainer_count', 'courses_count', 'courses', 'usersByRoleCount','unreadCount','readCount','notifications','scorm','qualifications'));
    }

    public function adminSelfStudy(Request $request)
    {
        $cohorts = Cohort::with([
            'course.tasks',
            'venue',
            'course.exams',
            'users' => function ($q) use ($request) {
                if ($request->filled('learner')) {
                    $q->where('users.id', $request->learner); // 👈 Fix is here
                }
            },
            'users.client',
            'users.profilePhoto'
        ])
            ->when($request->filled('course'), fn($q) => $q->where('course_id', $request->course))
            ->when($request->filled('venue'), fn($q) => $q->where('venue_id', $request->venue))
            ->when($request->filled('start_date'), fn($q) => $q->whereDate('start_date_time', '>=', $request->start_date))
            ->when($request->filled('end_date'), fn($q) => $q->whereDate('end_date_time', '<=', $request->end_date))
            ->when($request->filled('trainer'), fn($q) => $q->where('trainer_id', $request->trainer))
            ->when($request->filled('learner'), function ($q) use ($request) {
                $q->whereHas('users', function ($query) use ($request) {
                    $query->where('users.id', $request->learner); // 👈 Also fix here
                });
            })
            ->whereHas('users')
            ->orderBy('start_date_time', 'desc') // ← Add this line
            ->paginate(10); // Or however many cohorts per page
            //->get(); // Or however many cohorts per page

       // dd($cohorts->toArray());

        $groupedSubmissions = collect($cohorts->items())->map(function ($cohort) use ($request) {
            $course = $cohort->course;
            $tasks = $course->tasks;

            $learners = $cohort->users
                //->when($request->filled('learner'), fn($users) => $users->where('id', $request->learner))
                ->when($request->filled('learner'), function ($users) use ($request) {
                    return $users->filter(function ($user) use ($request) {
                        return $user->id == $request->learner;
                    });
                })
                ->map(function ($user) use ($tasks, $cohort) {
                    $submittedTasks = $tasks->map(function ($task) use ($user, $cohort) {
                        $submission = $task->submissions()
                            ->where('user_id', $user->id)
                            ->where('cohort_id', $cohort->id)
                            ->first();

                        return [
                            'id' => $task->id,
                            'user_id' => $user->id,
                            'task_id' => $task->id,
                            'cohort_id' => $cohort->id,
                            'name' => $task->name,
                            'description' => $task->description,
                            'submission_date' => $submission?->created_at,
                            'status' => $submission->status ?? 'Not Submitted',
                            'submission_id' => $submission?->id, // ← Add this line
                        ];
                    });

                    $licenseSubmissions = TaskSubmission::with('license')
                        ->where('user_id', $user->id)
                        ->where('cohort_id', $cohort->id)
                        ->whereNotNull('license_id')
                        ->get()
                        ->map(function ($submission) {
                            return [
                                'id' => $submission->license_id,
                                'user_id' => $submission->user_id,
                                'task_id' => null,
                                'cohort_id' => $submission->cohort_id,
                                'name' => $submission->license->name,
                                'description' => $submission->license->description ?? '',
                                'submission_date' => $submission->created_at,
                                'status' => $submission->status ?? 'Not Submitted',
                                'submission_id' => $submission->id,
                            ];
                        });

                    return [
                        'id' => $user->id,
                        'learner_name' => $user->name . ' ' . $user->last_name,
                        'learner_image' => $user->image,
                        'learner_client' => $user->client->name ?? "",
                        'exams' => $cohort->course->exams,
                        'submitted_tasks' => $submittedTasks->merge($licenseSubmissions), // Merged
                        'profile_photo' => $user->profilePhoto->profile_photo ?? null,
                        'profile_photo_status' => $user->profilePhoto->status ?? null,
                    ];
                });

            return [
                'cohort' => [
                    'id' => $cohort->id,
                    'course_name' => $course->name,
                    'start_date' => $cohort->start_date_time,
                    'end_date' => $cohort->end_date_time,
                    'venue' => $cohort->venue->venue_name,
                    'trainer_name' => $cohort->trainer->name ?? 'N/A',
                ],
                'learners' => $learners->values(),
            ];
        });

        // Filters
        $courses = Course::all();
        $venues = Venue::all();
        $trainers = User::role('Trainer')->get();
        $learners = User::role('Learner')->get();
        $submitted_cohorts = $cohorts;


        return view('backend.dashboard.admin_self_study', compact(
            'trainers', 'courses','cohorts', 'venues', 'learners', 'groupedSubmissions', 'submitted_cohorts'
        ));
    }


    /*public function adminSelfStudy(Request $request)
    {
        $submissionsQuery = TaskSubmission::with([
            'user',             // Fetch the learner who submitted the task
            'task',             // Fetch the related task
            'cohort.course',    // Fetch the cohort and its course
            'cohort.venue',      // Fetch the venue for the cohort
            'cohort.course.exams',      // Fetch the venue for the cohort
        ])->where('task_id', '!=' , null); // Filter by trainer_id

        // Apply filters if provided
        if ($request->filled('course')) {
            $submissionsQuery->whereHas('cohort.course', function ($query) use ($request) {
                $query->where('id', $request->course);
            });
        }

        if ($request->filled('learner')) {
            $submissionsQuery->where('user_id', $request->learner);
        }

        if ($request->filled('start_date')) {
            $submissionsQuery->whereHas('cohort', function ($query) use ($request) {
                $query->whereDate('start_date_time', '>=', $request->start_date);
            });
        }

        if ($request->filled('end_date')) {
            $submissionsQuery->whereHas('cohort', function ($query) use ($request) {
                $query->whereDate('end_date_time', '<=', $request->end_date);
            });
        }

        if ($request->filled('venue')) {
            $submissionsQuery->whereHas('cohort.venue', function ($query) use ($request) {
                $query->where('id', $request->venue);
            });
        }

        if ($request->filled('trainer')) {
            $submissionsQuery->whereHas('cohort', function ($query) use ($request) {
                $query->where('trainer_id', $request->trainer);
            });
        }



        // Get the submissions
        $submissions = $submissionsQuery->orderBy('created_at','desc')->get();

        // Group submissions by both learner and cohort
        $groupedSubmissions = $submissions->groupBy(['user_id', 'cohort_id']);

        // Fetch courses and learners for the filter form
        $courses = Course::all();
        $venues = Venue::all();
        $cohorts = Cohort::all();
        $trainers = User::role('Trainer')->get();


        $learners = User::whereHas('roles', function ($q) {
            $q->where('name', 'Learner');
        })->get();

        return view('backend.dashboard.admin_self_study', compact('trainers','submissions', 'courses', 'cohorts', 'venues','learners', 'groupedSubmissions'));
    }*/

    public function adminSelfStudyDetails($id)
    {
        // Get the submission with all related data
        $submission = TaskSubmission::with([
            'user',
            'task',
            'cohort.course',
            'cohort.venue',
            'cohort.course.exams',
            'user.certifications',
            'user.applicationForm',
            'user.documentUpload',
            'license'
        ])->findOrFail($id);


        // Get the cohort's other submissions for this user
        $submissions = TaskSubmission::where('user_id', $submission->user_id)
            ->where('cohort_id', $submission->cohort_id)
            ->whereHas('task') // Only include submissions with tasks
            ->with('task') // Eager load the task
            ->get();

        // Get exam results for this user and cohort
        $examResults = ExamResult::where('learner_id', $submission->user_id)
            ->where('cohort_id', $submission->cohort_id)
            ->with('exam')
            ->get();

        // Get SCORM data if available

        $sub = TaskSubmission::with('license')
            ->where('user_id',$submission->user_id)
            //->where('cohort_id', $submission->cohort_id)
            ->where('license_id', '!=' , null)
            ->get();

//        $scormData = null;
//        if ($submission->license_id && $submission->scorm_registration_id) {
//            $scormApiService = new ScormApiService();
//            $scormData = $scormApiService->getRegistrationDetails($submission->scorm_registration_id);
//        }


        return view('backend.dashboard.admin_self_study_details', compact(
            'submission',
            'submissions',
            'examResults',
            'sub'
        ));
    }

    public function adminGradeLearner(Request $request)
    {
        $cohortsQuery = Cohort::with([
            'course.exams',
            'venue',
            'users.taskSubmissions.task',
            'users.examResults',
            'users.certificates',
            'users.highFieldCertificate',
            'users.client'
        ])->whereHas('users'); // Only include cohorts that have at least one learner


        if ($request->filled('learner')) {
            $learnerId = $request->learner;
            $cohortsQuery->whereHas('users', function ($query) use ($learnerId) {
                $query->where('users.id', $learnerId);
            });
        } else {
            $cohortsQuery->whereHas('users');
        }

        if ($request->filled('course')) {
            $cohortsQuery->where('course_id', $request->course);
        }

        if ($request->filled('cohort')) {
            $cohortsQuery->where('id', $request->cohort);
        }

        if ($request->filled('venue')) {
            $cohortsQuery->where('venue_id', $request->venue);
        }

        if ($request->filled('trainer')) {
            $cohortsQuery->whereHas('course', function ($query) use ($request) {
                $query->where('trainer_id', $request->trainer);
            });
        }

        $cohorts = $cohortsQuery->get();

        $groupedSubmissions = $cohorts->map(function ($cohort) use ($request) {
            return [
                'cohort' => [
                    'id' => $cohort->id,
                    'course_id' => $cohort->course->id,
                    'course_name' => $cohort->course->name,
                    'start_date' => $cohort->start_date_time,
                    'end_date' => $cohort->end_date_time,
                    'venue' => $cohort->venue->venue_name ?? '',
                ],
                'learners' => $cohort->users
                    ->filter(function ($user) use ($request) {
                        return !$request->filled('learner') || $user->id == $request->learner;
                    })
                    ->map(function ($user) use ($cohort) {
                        $submission = $user->taskSubmissions
                            ->where('cohort_id', $cohort->id)
                            ->first();

                        $certificate = $user->certificates
                            ->where('cohort_id', $cohort->id)
                            ->first();

                        $highfield_certificate = $user->highFieldCertificate
                            ->where('cohort_id', $cohort->id)
                            ->first();

                        return [
                            'id' => $user->id,
                            'learner_name' => $user->name . ' ' . $user->last_name,
                            'learner_image' => $user->image,
                            'learner_client' => $user->client->name ?? '',
                            'task_submission' => $submission ?? null,
                            'exams' => $cohort->course->exams,
                            'certificate' => $certificate ? $certificate->certificate_path : null,
                            'highfield_certificate' => $highfield_certificate ?? null,
                        ];
                    }),
            ];
        });



        // Apply limit only if no filters are applied
        if (!$request->filled('course') && !$request->filled('cohort') && !$request->filled('venue') && !$request->filled('trainer') && !$request->filled('learner')) {
            $groupedSubmissions = $groupedSubmissions->take(5);
        }

        $submitted_courses = Course::all();

        $submitted_cohorts = Cohort::orderBy('start_date_time', 'asc')
            ->get();

        $venues = Venue::all();
        $trainers = User::whereHas('roles', function ($q) {
            $q->where('name', 'Trainer');
        })->get();

        // Add learners query
        $learners = User::whereHas('roles', function ($q) {
            $q->where('name', 'Learner');
        })->get();



        return view('backend.dashboard.admin_grade_learner', compact('groupedSubmissions', 'submitted_courses','submitted_cohorts','venues','trainers','learners'));
    }

    public function notifyHighFieldCertificate(Request $request)
    {

        $userId = $request->input('user_id');
        $cohortId = $request->input('cohort_id');

        // Update the pivot table (cohort_user)
        DB::table('cohort_user')
            ->where('user_id', $userId)
            ->where('cohort_id', $cohortId)
            ->update(['status' => 'Approved', 'updated_at' => now()]);

        $user = User::find($userId);

        // Send notification to the learner
        $task_url = route('backend.learner.dashboard');
        $message = 'Highfield certificate has been uploaded';
        $user->notify(new \App\Notifications\HighFieldCertificate($message, $task_url));

        return response()->json([
            'success' => true,
            'message' => 'Learner status updated and notification sent.'
        ]);

    }

    public function adminHighfieldCertificate(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'nullable|exists:courses,id',
            'cohort_id' => 'nullable|exists:cohorts,id',
            'certificate' => 'required|file|mimes:pdf,jpg,jpeg,png,webp',
        ]);

        // Retrieve the uploaded file
        $file = $request->file('certificate');

        // Extract the original file name and extension
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // File name without extension
        $extension = $file->getClientOriginalExtension(); // File extension

        // Create a unique file name by appending a unique ID to the original name
        $fileName = $originalName . '_' . uniqid() . '.' . $extension;

        $learner_name = User::find($request->user_id);

        // Define storage paths
        $userDirectory = 'learners/' . $learner_name->name.'/highfield'; // Subdirectory for the learner
        $filePath = $userDirectory . '/' . $fileName; // Full path relative to storage/app/public

        // Save the file to the specified storage disk (public)
        $storedPath = $file->storeAs($userDirectory, $fileName, 'public'); // Save under storage/app/public

        HighFieldCertificate::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'cohort_id' => $request->cohort_id,
            'file_path' => $filePath,
        ]);

        return back()->with('success', 'Certificate uploaded successfully.');
    }




    public function adminReUploadHighfieldCertificate(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'nullable|exists:courses,id',
            'cohort_id' => 'nullable|exists:cohorts,id',
            'certificate' => 'required|file|mimes:pdf,jpg,jpeg,png,webp',
        ]);

        $file = $request->file('certificate');
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileName = $originalName . '_' . uniqid() . '.' . $extension;

        $learner = User::findOrFail($request->user_id);
        $userDirectory = 'learners/' . $learner->name . '/highfield';
        $filePath = $userDirectory . '/' . $fileName;

        // Save new file
        $file->storeAs($userDirectory, $fileName, 'public');

        // Find existing certificate record
        $existingCertificate = HighFieldCertificate::where([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'cohort_id' => $request->cohort_id,
        ])->first();

        if ($existingCertificate) {
            // Delete old file if exists
            if (Storage::disk('public')->exists($existingCertificate->file_path)) {
                Storage::disk('public')->delete($existingCertificate->file_path);
            }

            // Update existing record
            $existingCertificate->update([
                'file_path' => $filePath,
            ]);
        }

        return back()->with('success', 'Certificate uploaded successfully.');
    }

    public function adminRemoveHighfieldCertificate(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'nullable|exists:courses,id',
            'cohort_id' => 'nullable|exists:cohorts,id',
        ]);

        $certificate = HighFieldCertificate::where([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'cohort_id' => $request->cohort_id,
        ])->first();

        if (!$certificate) {
            return back()->with('error', 'No certificate found for this learner.');
        }

        // Delete file if exists
        if (Storage::disk('public')->exists($certificate->file_path)) {
            Storage::disk('public')->delete($certificate->file_path);
        }

        // Delete record from DB
        $certificate->delete();

        return back()->with('success', 'Certificate removed successfully.');
    }


    public function adminLearnerCertificate(Request $request)
    {
        $query = User::role('Learner')->with([
            'cohorts.course',
            'taskSubmissions.license',
            'taskSubmissions.course',
            'taskSubmissions.cohort',
        ]);

        // Apply filters if present
        if ($request->filled('course_id')) {
            $query->whereHas('taskSubmissions', function ($q) use ($request) {
                $q->where('course_id', $request->course_id);
            });
        }

        if ($request->filled('cohort_id')) {
            $query->whereHas('taskSubmissions', function ($q) use ($request) {
                $q->where('cohort_id', $request->cohort_id);
            });
        }

        if ($request->filled('license_id')) {
            $query->whereHas('taskSubmissions', function ($q) use ($request) {
                $q->where('license_id', $request->license_id);
            });
        }

        $learners = $query->orderBy('created_at','desc')->get();
        $certificates = LearnerCertificate::with(['user', 'license', 'course', 'cohort'])
            ->get();

        // Only get courses and cohorts that appear in task submissions
        $usedCourseIds = TaskSubmission::distinct()->pluck('course_id')->filter()->unique();
        $usedCohortIds = TaskSubmission::distinct()->pluck('cohort_id')->filter()->unique();

        //$submitted_courses = Course::whereIn('id', $usedCourseIds)->get();
        //$submitted_cohorts = Cohort::whereIn('id', $usedCohortIds)->get();


        $submitted_courses = Course::all();

        $submitted_cohorts = Cohort::orderBy('start_date_time', 'asc')
            ->get();



        $usedLicenseIds = TaskSubmission::whereNotNull('license_id')->pluck('license_id')->unique();
        $licenses = License::whereIn('id', $usedLicenseIds)->get(); // ✅ Correct


        return view('backend.dashboard.admin_learner_certificate', compact(
            'learners', 'certificates', 'submitted_courses', 'submitted_cohorts', 'licenses'
        ));
    }

    public function uploadCertificate(Request $request)
    {
        $request->validate([
            'certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', // Validate for PDF or image
        ]);

        if ($request->hasFile('certificate')) {

            // Retrieve the uploaded file
            $file = $request->file('certificate');

            // Extract the original file name and extension
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // File name without extension
            $extension = $file->getClientOriginalExtension(); // File extension

            // Create a unique file name by appending a unique ID to the original name
            $fileName = $originalName . '_' . uniqid() . '.' . $extension;

            $learner_name = User::find($request->learner_id);

            // Define storage paths
            $userDirectory = 'learners/' . $learner_name->name; // Subdirectory for the learner
            $filePath = $userDirectory . '/' . $fileName; // Full path relative to storage/app/public

            // Save the file to the specified storage disk (public)
            $storedPath = $file->storeAs($userDirectory, $fileName, 'public'); // Save under storage/app/public

            // Generate the public URL
            $publicUrl = Storage::url($storedPath); // Publicly accessible URL

            // Save certificate data in the database
            LearnerCertificate::create([
                'user_id' => $request->learner_id,
                'cohort_id' => $request->cohort_id,
                'certificate_path' => $filePath,
            ]);

            // Return success response
            return response()->json(['message' => 'Certificate uploaded successfully!'], 200);

        }

        return response()->json(['message' => 'File upload failed!'], 500);
    }

    public function editFormApplicationRequest(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->is_request_application_form == 1) {
            return response()->json(['success' => false, 'message' => 'Form request already made.']);
        }

        $user->is_request_application_form = 1;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Form request updated successfully.']);
    }

    public function adminGenerateCertificate(Request $request)
    {
        $request->validate([
            'learner_id' => 'required|exists:users,id',
            'cohort_id' => 'required|exists:cohorts,id',
        ]);

        $learner = User::findOrFail($request->learner_id);
        $cohort = Cohort::findOrFail($request->cohort_id);
        $licenseId = $request->license_id;

        // Check if certificate already exists
        $existingCertificate = LearnerCertificate::where('user_id', $learner->id)
            ->where('cohort_id', $cohort->id)
            ->first();

        if ($existingCertificate) {
            return response()->json([
                'message' => 'Certificate already exists.',
                'certificate_path' => $existingCertificate->certificate_path,
            ], 200);
        }


        $learnerName = $learner->name. ' '.$learner->last_name;
        $courseName = $cohort->course->name ?? 'Unknown Course';
        $courseLicense = $cohort->course->licenses->first();



        $issueDate = Carbon::now()->format('d/m/Y');

        // Load template
        $templatePath = public_path('certificate-template.pdf');
        $pdf = new Fpdi();

        $scormApiService = new ScormApiService();
        $courseData = $scormApiService->getCourse($courseLicense->course_id);

        if (isset($courseData['rootActivity']) && isset($courseData['rootActivity']['children'])) {
            $modules = array_map(function ($child) {
                return $child['title'];
            }, $courseData['rootActivity']['children']);
        }

        try {
            $pdf->AddPage();
            $pdf->setSourceFile($templatePath);
            $templateId = $pdf->importPage(1);
            $pdf->useTemplate($templateId, 0, 0, 210);

            // Fill content
            $pdf->SetFont('Helvetica', '', 12);
            $currentY = 110;

            $pdf->SetFont('Helvetica', 'I', 12);
            $pdf->SetXY(0, $currentY);
            $pdf->Cell(0, 8, "This certification is presented to", 0, 1, 'C');
            $currentY += 12;

            $pdf->SetFont('Helvetica', 'B', 18);
            $pdf->SetXY(0, $currentY);
            $pdf->Cell(0, 10, $learnerName, 0, 1, 'C');
            $currentY += 15;

            $pdf->SetFont('Helvetica', 'I', 12);
            $pdf->SetXY(0, $currentY);
            $pdf->Cell(0, 8, "has successfully completed the following course:", 0, 1, 'C');
            $currentY += 12;

            if($courseName == "Level 1 Health and Safety Awareness within Construction Environment") {
                // Break this course name into two lines
                $pdf->SetFont('Helvetica', 'B', 16);

                // First line
                $pdf->SetXY(0, $currentY);
                $pdf->Cell(0, 10, "Level 1 Health and Safety Awareness", 0, 1, 'C');
                $currentY += 10;

                // Second line
                $pdf->SetXY(0, $currentY);
                $pdf->Cell(0, 10, "within Construction Environment", 0, 1, 'C');
                $currentY += 15;
            } else {
                $pdf->SetFont('Helvetica', 'B', 16);
                $pdf->SetXY(0, $currentY);
                $pdf->Cell(0, 10, $courseName, 0, 1, 'C');
                $currentY += 15;
            }



            // Modules section header
            $pdf->SetFont('Helvetica', '', 12);
            $pdf->SetXY(0, $currentY);
            $pdf->Cell(0, 8, "A pass was achieved in the following modules:", 0, 1, 'C');
            $currentY += 10;

            $pdf->SetFont('Helvetica', '', 13);
            // Left-aligned bullet points (starting from a fixed X position)
            // Calculate the centered starting X position for bullets
            $maxWidth = 120; // Adjust width for better alignment
            $centerX = (210 - $maxWidth) / 2; // 210 is the A4 page width

            // Centered bullet points
            foreach ($modules as $module) {
                $pdf->SetXY($centerX, $currentY);
                $pdf->Cell($maxWidth, 6, "• " . $module, 0, 1, 'L'); // Still using 'L' but within a centered box
                $currentY += 7;
            }

            // Add some space before dates
            $currentY += 5;

            $pdf->SetFont('Helvetica', '', 12);
            $pdf->SetXY(0, $currentY);
            $pdf->Cell(0, 8, "Issue Date: " . $issueDate, 0, 1, 'C');

            // Save PDF
            $fileName = 'certificate_' . uniqid() . '.pdf';
            $userDir = 'learners/' . str_replace(' ', '_', strtolower($learnerName));
            $filePath = $userDir . '/' . $fileName;

            // Ensure directory exists
            Storage::disk('public')->makeDirectory($userDir);

            // Save the PDF properly
            $pdf->Output(storage_path('app/public/' . $filePath), 'F');

            // Save in DB
            LearnerCertificate::create([
                'user_id' => $learner->id,
                'cohort_id' => $cohort->id,
                'license_id' => $licenseId,
                'certificate_path' => $filePath,
            ]);

            // Update the task status
            TaskSubmission::where('cohort_id', $cohort->id)
                ->where('user_id', $learner->id)
                ->where('course_id', $cohort->course->id)
                ->update(['status' => "Approved"]);

            return response()->json(['message' => 'Certificate generated and saved successfully.']);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to generate certificate: ' . $e->getMessage()
            ], 500);
        }
    }

}
