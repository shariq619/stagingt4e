<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\User\StoreUserRequest;
use App\Http\Requests\Backend\User\UpdateUserRequest;
use App\Libraries\ScormApiService;
use App\Libraries\ScormCloud_Php_Sample;
use App\Mail\WelcomeEmail;
use App\Models\Category;
use App\Models\CheckoutDetail;
use App\Models\Cohort;
use App\Models\Course;
use App\Models\FrontOrder;
use App\Models\FrontOrderDetails;
use App\Models\FrontPayment;
use App\Models\LearnerCertificate;
use App\Models\LearnerElearningCourse;
use App\Models\License;
use App\Models\Methodology;
use App\Models\Payment;
use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\User;
use App\Models\UserCertification;
use App\Models\UserCohortPayment;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravolt\Avatar\Avatar;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use RusticiSoftware\Cloud\V2 as ScormCloud;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'desc');
        $search = $request->get('search', '');
        $role = $request->get('role', '');

        // Fetch all roles for the dropdown
        $roles = Role::all();

        // Start with a query builder
        $query = User::query();

        // Filter by search term if provided
        if (!empty($search)) {
            $query->where(function ($q) use ($request) {
                $nameInput = $request->search;

                $q->where('name', 'like', '%' . $nameInput . '%')
                    ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$nameInput}%"])
                    ->orWhere('id', $nameInput);
            });
        }

        // Filter by role if selected
        if (!empty($role)) {
            $query->whereHas('roles', function ($q) use ($role) {
                $q->where('name', $role);
            });
        }

        // Apply sorting and pagination
        $users = $query->orderBy('id', $sort)->paginate(10);

        return view('backend.user.index', compact('users', 'sort', 'search', 'roles', 'role'));
    }

    public function showHistory(User $user)
    {
        $histories = UserHistory::where('user_id', $user->id)->latest()->paginate(10);
        $tasks = Task::all()->keyBy('id');
        $licenses = License::all()->keyBy('id');
        $cohorts = Cohort::all()->keyBy('id');
        $courses = Course::all()->keyBy('id');
        return view('backend.user.history', compact('user', 'histories', 'tasks', 'licenses', 'cohorts', 'courses'));
    }

    // public function search(Request $request)
    // {
    //     $text = $request->input('text');

    //     if (empty($text)) {
    //         $users = User::all();
    //     } else {
    //         $users = User::where('name', 'like', '%' . $text . '%')->get();
    //     }

    //     return view('backend.user.search_rows', compact('users'));
    // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = new User();
        $roles = Role::all();
        $categories = Category::all();
        $courses = Course::all();
        $methodologies = Methodology::all();

        $sortField = $request->get('sortField', 'start_date_time');
        $sortOrder = $request->get('sortOrder', 'desc');
        $cohorts = Cohort::with('course', 'corporateClient', 'trainer', 'venue')
            ->whereDate('start_date_time', '>=', today())
            ->orderBy('start_date_time', 'asc')
            //->orderBy($sortField, $sortOrder)
            ->get();

        //->paginate(10);

        //$cohorts = Cohort::with('course', 'corporateClient', 'trainer')->paginate(10);
        $clients = User::role('Corporate Client')->get();
        $selectedCourses = [];
        $assignedTasks = [];

//        $cohortDates = DB::table('cohorts')
//            ->select(DB::raw('YEAR(start_date_time) as year'), DB::raw('MONTH(start_date_time) as month'))
//            ->distinct()
//            ->orderBy('year', 'desc')
//            ->orderBy('month', 'desc')
//            ->get();

        $cohortDates = DB::table('cohorts')
            ->select(DB::raw('YEAR(start_date_time) as year'), DB::raw('MONTH(start_date_time) as month'))
            ->whereDate('start_date_time', '>=', today()) // Filter only today and future dates
            ->distinct()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        //dd($cohortDates);

        // Check if the request is AJAX
        if ($request->ajax()) {
            return view('backend.user.partials.cohorts_table', compact('cohorts', 'user', 'selectedCourses'));
        }


        $idFormEdit = false;
        return view('backend.user.create', compact('idFormEdit', 'methodologies', 'cohortDates', 'user', 'roles', 'categories', 'courses', 'cohorts', 'clients', 'selectedCourses', 'sortField', 'sortOrder', 'assignedTasks'));
    }

    public function filterCohorts(Request $request)
    {
        $categoryId = $request->input('category_id');
        $courseId = $request->input('course_id');
        $filterDate = $request->input('filter_date');

        // Query the cohorts based on filters
        $query = Cohort::with('course', 'corporateClient', 'trainer');

        if ($categoryId) {
            $query->whereHas('course.category', function ($q) use ($categoryId) {
                $q->where('id', $categoryId);
            });
        }

        if ($courseId) {
            $query->where('course_id', $courseId);
        }

        if ($filterDate) {
            $dateParts = explode('-', $filterDate);
            $year = $dateParts[0];
            $month = $dateParts[1];
            $query->whereYear('start_date_time', $year)
                ->whereMonth('start_date_time', $month)
                ->where('start_date_time', '>=', now());
        } else {
            // If no filter date is provided, exclude past cohorts
            $query->where('start_date_time', '>=', now());
        }


        $cohorts = $query->paginate(10);

        // Return the partial view with updated cohorts
        return response()->json([
            'cohorts' => view('backend.user.partials.cohorts_table', compact('cohorts'))->render()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {

            $validatedData = $request->validate([
                'user_type' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'telephone' => 'required',
                'birth_date' => 'nullable|date',
                'address' => 'nullable|string|max:255',
                'company' => 'nullable|string|max:255',
                'website' => 'nullable|string|max:255',
                'cohort_ids' => ['nullable', 'array'], // Default rule
                'cohort_ids.*' => 'exists:cohorts,id', // Validate each cohort ID
            ]);

            $imageName = null;
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // Correct reference to 'image' field
                $uploadedFile = $request->file('image');

                // Create a unique file name
                $fileName = time() . '_' . $uploadedFile->getClientOriginalName();

                // Store the file in the 'public' disk under 'profile_images' directory
                $filePath = $uploadedFile->storeAs('profile_images', $fileName, 'public');

                // Save the full path to store in the database
                $imageName = 'storage/' . $filePath;
            }

            unset($validatedData['user_type']);
            unset($validatedData['cohort_ids']);
            // Generate and assign password
            $password = Str::random(10);
            $validatedData['image'] = $imageName;
            $validatedData['password'] = Hash::make($password);

            if ($request->corporate_client_id) {
                $validatedData['client_id'] = $request->corporate_client_id;
            }


            if ($request->user_type == 3) {
                $validatedData['methodology_id'] = $request->methodology_id ?? null;
            }


            $user = User::create($validatedData);
            $user->assignRole($request->user_type);
            // If the user is a learner
            if ($request->user_type == 4) {

                // Sync cohorts
                $cohortIds = $request->input('cohort_ids', []);
                $user->cohorts()->sync($cohortIds);


                // front order and front order detail

                // 1. Create front_order
//                $frontOrder = FrontOrder::create([
//                    'user_id' => $user->id,
//                    'total_amount' => 0, // will be calculated
//                    'payment_method' => null,
//                    'order_status' => 'Processing',
//                    'shipping_cost' => 0,
//                    'tax_amount' => 0,
//                    'discount_amount' => 0,
//                    'remaining_balance' => 0,
//                ]);

                $totalOrderAmount = 0;

                // 2. Create front_order_details
//                foreach ($cohortIds as $cohortId) {
//                    $cohort = \App\Models\Cohort::with('course')->find($cohortId);
//                    if (!$cohort) continue;
//
//                    $course = $cohort->course;
//                    $price = $course->price ?? 0;
//                    $quantity = 1;
//                    $totalPrice = $price * $quantity;
//
//                    $detail = FrontOrderDetails::create([
//                        'order_id' => $frontOrder->id,
//                        'is_bundle' => 0,
//                        'courses' => $course->id,
//                        'course_id' => $course->id,
//                        'cohort_id' => $cohortId,
//                        'bundle_id' => null,
//                        'product_id' => null,
//                        'course_name' => $course->name,
//                        'course_price' => $price,
//                        'cost_price' => ($price/100)*80,
//                        'vat' => ($price/100)*20,
//                        'quantity' => $quantity,
//                        'total_price' => $totalPrice,
//                        'deposit_paid' => 0,
//                        'deposit_amount' => 0,
//                        'remaining_balance' => $totalPrice,
//                        'discount' => 0,
//                    ]);
//
//                    $totalOrderAmount += $totalPrice;
//                }

                // 3. Update order total and remaining balance
//                $frontOrder->update([
//                    'total_amount' => $totalOrderAmount,
//                    'remaining_balance' => $totalOrderAmount,
//                ]);

                // 4. Create a placeholder payment (optional, can be updated later)
//                FrontPayment::create([
//                    'order_id' => $frontOrder->id,
//                    'amount' => 0,
//                    'payment_method' => 'stripe',
//                    'status' => 'pending',
//                ]);

                // 5. Optionally create checkout details
//                CheckoutDetail::create([
//                    'order_id' => $frontOrder->id,
//                    'first_name' => $request->input('first_name', 'N/A'),
//                    'last_name' => $request->input('last_name', 'N/A'),
//                    'company_name' => $request->input('company_name'),
//                    'street_address' => $request->input('street_address', 'N/A'),
//                    'unit' => $request->input('unit'),
//                    'city' => $request->input('city', 'N/A'),
//                    'postcode' => $request->input('postcode', '00000'),
//                    'phone' => $request->input('phone', '000000000'),
//                    'email' => $user->email,
//                    'attendee_details' => null,
//                    'hear_about' => $request->input('hear_about'),
//                    'declaration' => false,
//                    'terms' => false,
//                ]);





                foreach ($cohortIds as $cohortId) {

                    $cohort = Cohort::find($cohortId);

                    UserCohortPayment::create([
                        'user_id' => $user->id,
                        'cohort_id' => $cohortId,
                        'total_fee' => $cohort->course->price,
                        'amount_paid' => 0,
                        'balance_amount' => $cohort->course->price,
                        //'due_date' => '2025-01-31',
                    ]);

                }

                if (!empty($cohortIds)) {
                    foreach ($cohortIds as $cohort_id) {
                        $cohort = Cohort::find($cohort_id);



                        foreach ($cohort->course->licenses as $license) {

                             if ($license->name == "ACT Awareness" || $license->name == "ACT Security" || $license->name == "Emergency First Aid at Work" || $license->name == "Health and Safety in a Construction Environment") {

                                $courseId = $license->course_id;
                                $course_id = $cohort->course->id;
                                $learner_id = $validatedData['name'];
                                $learnerEmail = $validatedData['email'];
                                $learnerFirstName = $validatedData['name'];
                                $learnerLastName = $validatedData['last_name'];
                                $registration_id = 'reg_' . $courseId . '_' . uniqid();


                                 if ($license->name == "ACT Awareness" || $license->name == "ACT Security"){
                                     $registration_id = null;
                                     $launchUrl = null;
                                 } else {

                                     // Usage Example
                                     $scormApiService = new ScormApiService();
                                     $registrationId = $registration_id;
                                     $learner = [
                                         'id' => $learner_id,
                                         'email' => $learnerEmail,
                                         'firstName' => $learnerFirstName,
                                         'lastName' => $learnerLastName ?? "",
                                     ];

                                     $registrationResponse = $scormApiService->createRegistration($registrationId, $learner, $courseId);
                                     $launchLinkResponse = $scormApiService->generateLaunchLink($registrationId, 7776000, 'Message');
                                     if (!isset($launchLinkResponse['launchLink'])) {
                                         throw new \Exception("Launch link not generated for registration ID: $registrationId");
                                     }
                                     $launchUrl = $launchLinkResponse['launchLink'];
                                 }


                                try {
                                    TaskSubmission::create([
                                        'user_id' => $user->id,
                                        'license_id' => $license->id,
                                        'course_id' => $course_id,
                                        'cohort_id' => $cohort->id,
                                        'trainer_id' => $cohort->trainer_id,
                                        'scorm_registration_id' => $registration_id,
                                        'scorm_course_link' => $launchUrl,
                                    ]);
                                } catch (\Exception $e) {
                                    Log::error('TaskSubmission creation failed: ' . $e->getMessage());
                                    throw $e; // Re-throw exception to handle it properly
                                }

                            }
                        }

                    }
                }

            }


            // Send welcome email
            Mail::to($user->email)->send(new WelcomeEmail($user, $password));
            DB::commit(); // Commit the transaction if everything is successful


            return redirect()->route('backend.users.index')->with('success', 'User added successfully');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction on error
            // Log the error for debugging purposes
            Log::error('User creation failed: ' . $e->getMessage());
            return redirect()->route('backend.users.index')->with('error', 'Failed to create user. Please try again. ' . $e->getMessage());
        }
    }

    public function show(User $user)
    {
        return view('backend.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $idFormEdit = true;
        $roles = Role::all();
        $categories = Category::all();
        $courses = Course::all();
        $cohorts = Cohort::with('course', 'corporateClient', 'trainer')->orderBy('start_date_time', 'asc')->get();
        $clients = User::role('Corporate Client')->get();
        $methodologies = Methodology::all();

        // Retrieve selected e-learning courses using DB query
        $selectedCourses = DB::table('learner_elearning_courses')
            ->where('learner_id', $user->id)
            ->pluck('course_name')
            ->toArray();


        $coursesGeneralEnrolment = Task::where('type', 'GeneralEnrolment')->get();
        $coursesCourseWork = Task::where('type', 'CourseWork')->get();
        $coursesReminders = Task::where('type', 'Reminders')->get();
        $coursesPostCompletion = Task::where('type', 'PostCompletion')->get();


        $cohortDates = DB::table('cohorts')
            ->select(DB::raw('YEAR(start_date_time) as year'), DB::raw('MONTH(start_date_time) as month'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        //$assignedTasks = $user->tasks->pluck('id')->toArray();

        // Fetch payment details for the user s
//        $userCohortPayments = $user->userCohortPayments()
//            ->with('cohort.course')
//            ->get();

//        $userCohortPayments = $user->userCohortPayments()
//            ->whereHas('cohort', function ($query) {
//                $query->whereNull('deleted_at'); // Exclude soft-deleted cohorts
//            })
//            ->with(['cohort.course'])
//            ->get();

        $userCohortPayments = $user->cohorts()->get();


        //dd($userCohortPayments);


        return view('backend.user.edit', compact('userCohortPayments', 'methodologies', 'cohortDates', 'user', 'roles', 'categories', 'courses', 'cohorts', 'clients', 'idFormEdit', 'selectedCourses', 'coursesGeneralEnrolment', 'coursesCourseWork', 'coursesReminders', 'coursesPostCompletion'));
    }

    public function updatePayment(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $payment = UserCohortPayment::findOrFail($id);
        if ($request->amount > $payment->balance_amount) {
            return response()->json(['success' => false, 'message' => 'The payment amount exceeds the balance.']);
        }

        $payment->amount_paid += $request->amount;
        $payment->balance_amount -= $request->amount;

        $payment->status = $payment->balance_amount == 0 ? 'Paid' : 'Partially Paid';

        $payment->save();

        return response()->json(['success' => true]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $imageName = $user->image; // Set the default to the current image in the database
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $uploadedFile = $request->file('image');
                $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
                $filePath = $uploadedFile->storeAs('profile_images', $fileName, 'public');
                $imageName = 'storage/' . $filePath;
            }

            $user->update([
                'name' => $request->name,
                'client_id' => isset($request->corporate_client_id) ? $request->corporate_client_id : null,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'image' => $imageName ?? null,
                'birth_date' => $request->birth_date,
                'address' => $request->address,
                'company' => $request->company,
                'website' => $request->website,
                'telephone' => $request->telephone,
                'methodology_id' => $request->methodology_id,
            ]);

            $user->syncRoles($request->user_type);

            if ($request->user_type == 4) { // learner

                // USER HISTORY
                $oldCohortIds = $user->cohorts()->select('cohorts.id')->pluck('cohorts.id')->toArray();
                $taskOldSubmission = TaskSubmission::where('user_id', $user->id)->get()->toArray();
                $learnerOldCertifications = LearnerCertificate::where('user_id', $user->id)->get()->toArray();

                $user_history = UserHistory::create([
                    'user_id' => $user->id,
                    'cohort_ids' => json_encode($oldCohortIds),
                    'task_submissions' => json_encode($taskOldSubmission),
                    'learner_certificates' => json_encode($learnerOldCertifications),
                ]);
                // USER HISTORY


                // Sync cohorts
                $cohortIds = $request->input('cohort_ids', []);
                $user->cohorts()->sync($cohortIds);

                if (!empty($cohortIds)) {

                    foreach ($cohortIds as $cohort_id) {
                        $cohort = Cohort::find($cohort_id);
                        if (!$cohort || !$cohort->course) {
                            continue; // skip invalid or deleted cohort/course
                        }
                        foreach ($cohort->course->licenses as $license) {


                            if ($license->name == "Health and Safety in a Construction Environment" || $license->name == "Emergency First Aid at Work") {




                                    $existingTaskSubmission = TaskSubmission::where('license_id', $license->id)
                                        ->where('user_id', $user->id)
                                        ->whereNotNull('scorm_registration_id')
                                        ->whereNotNull('scorm_course_link')
                                        ->where('course_id', $cohort->course->id) // check same course
                                        ->first();



                                    if ($existingTaskSubmission) {

                                        if($existingTaskSubmission->license_id == 4){

                                            // Update only the submissions related to this course
                                            TaskSubmission::where('user_id', $user->id)
                                                ->where('course_id', $cohort->course->id)
                                                ->update([
                                                    'cohort_id' => $cohort->id,
                                                    'course_id' => $cohort->course->id,
                                                ]);

                                        }

                                    } else {

                                        // create new scorm

                                        $courseId = $license->course_id;
                                        $registrationId = 'reg_' . $courseId . '_' . uniqid();

                                        $scormApiService = new ScormApiService();
                                        $learner = [
                                            'id' => $request->name,
                                            'email' => $request->email,
                                            'firstName' => $request->name,
                                            'lastName' => $request->last_name ?? '',
                                        ];

                                        $registrationResponse = $scormApiService->createRegistration($registrationId, $learner, $courseId);
                                        $launchLinkResponse = $scormApiService->generateLaunchLink($registrationId, 7776000, 'Message');
                                        $launchUrl = $launchLinkResponse['launchLink'];

                                        TaskSubmission::create([
                                            'user_id' => $user->id,
                                            'cohort_id' => $cohort->id,
                                            'license_id' => $license->id,
                                            'course_id' => $cohort->course->id,
                                            'trainer_id' => $cohort->trainer_id,
                                            'scorm_registration_id' => $registrationId,
                                            'scorm_course_link' => $launchUrl,
                                        ]);

                                    }


                            } else {

                                // Update only the submissions related to this course
                                TaskSubmission::where('user_id', $user->id)
                                    ->where('course_id', $cohort->course->id)
                                    ->update([
                                        'cohort_id' => $cohort->id,
                                        'course_id' => $cohort->course->id,
                                    ]);


                                TaskSubmission::updateOrCreate(
                                    [
                                        'user_id'    => $user->id,
                                        'course_id'  => $cohort->course->id,
                                        'license_id' => $license->id,
                                    ],
                                    [
                                        'cohort_id'  => $cohort->id,
                                        'trainer_id' => $cohort->trainer_id,
                                    ]
                                );


                            }




//                            if ($license->name == "Emergency First Aid at Work" || $license->name == "Health and Safety in a Construction Environment") {
//
//                                $existingTaskSubmission = TaskSubmission::where('license_id', $license->id)
//                                    ->where('user_id', $user->id)
//                                    ->whereNotNull('scorm_registration_id')
//                                    ->whereNotNull('scorm_course_link')
//                                    ->where('course_id', $cohort->course->id) // check same course
//                                    ->first();
//
//                                if ($existingTaskSubmission) {
//
//
//                                    TaskSubmission::updateOrCreate(
//                                        [
//                                            'user_id' => $user->id,
//                                            'license_id' => $license->id,
//                                        ],
//                                        [
//                                            'cohort_id' => $cohort->id,
//                                            'course_id' => $cohort->course->id,
//                                            'trainer_id' => $cohort->trainer_id,
//                                            'scorm_registration_id' => $existingTaskSubmission->scorm_registration_id,
//                                            'scorm_course_link' => $existingTaskSubmission->scorm_course_link,
//                                        ]
//                                    );
//
//
//
//                                    // Update LearnerCertificate similarly if needed
//                                    LearnerCertificate::where('user_id', $user->id)
//                                        ->where('license_id', $license->id) // if license_id exists in LearnerCertificate
//                                        ->update([
//                                            'cohort_id' => $cohort->id,
//                                            'course_id' => $cohort->course->id,
//                                        ]);
//
//                                    Log::info("SCORM reused or updated for user {$user->id} and license {$license->id}");
//
//
//                                } else {
//
//                                    $courseId = $license->course_id;
//                                    $registrationId = 'reg_' . $courseId . '_' . uniqid();
//
//                                    $scormApiService = new ScormApiService();
//                                    $learner = [
//                                        'id' => $request->name,
//                                        'email' => $request->email,
//                                        'firstName' => $request->name,
//                                        'lastName' => $request->last_name ?? '',
//                                    ];
//
//                                    $registrationResponse = $scormApiService->createRegistration($registrationId, $learner, $courseId);
//                                    $launchLinkResponse = $scormApiService->generateLaunchLink($registrationId, 2592000, 'Message');
//                                    $launchUrl = $launchLinkResponse['launchLink'];
//
//                                    TaskSubmission::create([
//                                        'user_id' => $user->id,
//                                        'cohort_id' => $cohort->id,
//                                        'license_id' => $license->id,
//                                        'course_id' => $cohort->course->id,
//                                        'trainer_id' => $cohort->trainer_id,
//                                        'scorm_registration_id' => $registrationId,
//                                        'scorm_course_link' => $launchUrl,
//                                    ]);
//
//                                    Log::info("SCORM created for user {$user->id} with new registration ID {$registrationId}");
//                                }
//
//
//                            } elseif ($license->name == "ACT Awareness" || $license->name == "ACT Security"){
//
//                                $existingTaskSubmission = TaskSubmission::where('license_id', $license->id)
//                                    ->where('user_id', $user->id)
//                                    ->whereNotNull('scorm_registration_id')
//                                    ->whereNotNull('scorm_course_link')
//                                    ->where('course_id', $cohort->course->id) // check same course
//                                    ->first();
//
//
//                                if ($existingTaskSubmission) {
//
//
//                                    TaskSubmission::updateOrCreate(
//                                        [
//                                            'user_id' => $user->id,
//                                            'license_id' => $license->id,
//                                        ],
//                                        [
//                                            'cohort_id' => $cohort->id,
//                                            'course_id' => $cohort->course->id,
//                                            'trainer_id' => $cohort->trainer_id,
//                                            'scorm_registration_id' => $existingTaskSubmission->scorm_registration_id,
//                                            'scorm_course_link' => $existingTaskSubmission->scorm_course_link,
//                                        ]
//                                    );
//
//
//                                    LearnerCertificate::where('user_id', $user->id)
//                                        ->where('license_id', $license->id) // if license_id exists in LearnerCertificate
//                                        ->update([
//                                            'cohort_id' => $cohort->id,
//                                            'course_id' => $cohort->course->id,
//                                        ]);
//
//                                    Log::info("SCORM reused or updated for user {$user->id} and license {$license->id}");
//
//
//                                } else {
//
//                                    TaskSubmission::create([
//                                        'user_id' => $user->id,
//                                        'cohort_id' => $cohort->id,
//                                        'license_id' => $license->id,
//                                        'course_id' => $cohort->course->id,
//                                        'trainer_id' => $cohort->trainer_id,
//                                    ]);
//
//
//                                }
//
//                            }
                        }

                    }
                }

            }

            DB::commit();
            return redirect()->route('backend.users.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        /*if (Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }*/

        //$user->cohorts()->detach();
        //$user->userCohortPayments()->delete();

        $user->delete();
        return redirect()->route('backend.users.index')->with('success', 'User deleted successfully');
    }

    public function showChangePasswordForm()
    {
        return view('backend.user.changePassword');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->password_check = 1;
        $user->save();
        return redirect()->route('backend.learner.dashboard')->with('success', 'Password changed successfully');
    }

    public function resendEmail($id)
    {
        $user = User::findOrFail($id);

        // Option 1: Generate a new random password each time you resend
        $password = Str::random(10);
        $user->password = Hash::make($password);
        $user->save();

        // Send email again
        Mail::to([$user->email, 'web@deans-group.co.uk', 'info@training4employment.co.uk'])
            ->send(new WelcomeEmail($user, $password));


        return redirect()->back()->with('success', 'Welcome email resent successfully with a new password.');
    }

    public function ajaxResendEmail(Request $request)
    {
        try {
            $user = User::findOrFail($request->user_id);
            $email = $request->email;

            // Optionally update the email if user changed it in the form (not yet saved)
            $user->email = $email;
            $user->save();

            // Generate a new random password (optional)
            $password = Str::random(10);
            $user->password = Hash::make($password);
            $user->save();

            // Send email
            Mail::to($email)
                ->cc(['web@deans-group.co.uk', 'info@training4employment.co.uk'])
                ->send(new WelcomeEmail($user, $password));

            return response()->json(['status' => 'success', 'message' => 'Welcome email resent successfully!']);
        } catch (\Exception $e) {
            Log::error('Resend Email Failed: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to send email.']);
        }
    }


}
