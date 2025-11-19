<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Venue;
use App\Models\Cohort;
use App\Models\Course;
use App\Models\Category;
use App\Models\LeadForm;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Laravolt\Avatar\Avatar;
use Illuminate\Http\Request;
use App\Models\TaskSubmission;
use App\Mail\LeadFormSubmitted;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Libraries\ScormApiService;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Models\LearnerElearningCourse;
use Illuminate\Support\Facades\Storage;
use App\Libraries\ScormCloud_Php_Sample;
use RusticiSoftware\Cloud\V2 as ScormCloud;
use App\Http\Requests\Backend\User\StoreUserRequest;
use App\Http\Requests\Backend\User\UpdateUserRequest;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $upcomingCourses = DB::select("
            SELECT c.*,
                   ch.id AS cohort_id,
                   ch.venue_id,
                   ch.start_date_time,
                   ch.end_date_time,
                   ch.additional_times,
                   ch.is_soldout,
                   v.venue_name,  -- ✅ Include venue details
                   v.address
            FROM courses c
            JOIN cohorts ch ON ch.course_id = c.id
            JOIN venues v ON ch.venue_id = v.id  -- ✅ Correct table name (venues instead of venue)
            WHERE ch.start_date_time = (
                SELECT MIN(ch2.start_date_time)
                FROM cohorts ch2
                WHERE ch2.course_id = c.id
                AND ch2.venue_id = ch.venue_id
                AND ch2.start_date_time >= CURDATE() + INTERVAL 1 DAY
                AND ch2.cohort_status = 1
            )
            AND ch.start_date_time >= CURDATE() + INTERVAL 1 DAY
            AND ch.cohort_status = 1
            ORDER BY ch.start_date_time ASC
            LIMIT 5;
        ");

        $topSellers = Course::whereHas('cohorts', function ($query) {
            $query->where('start_date_time', '>=', Carbon::tomorrow()); // Only upcoming cohorts
        })
            ->with(['cohorts' => function ($query) {
                $query->where('start_date_time', '>=', Carbon::tomorrow()) // Get only upcoming cohorts
                    ->orderBy('start_date_time', 'asc') // Nearest start date first
                    ->limit(1); // Get only the next upcoming cohort
            }])
            ->orderBy(
                Cohort::select('start_date_time')
                    ->whereColumn('cohorts.course_id', 'courses.id')
                    ->orderBy('start_date_time', 'asc')
                    ->limit(1)
            )
            ->limit(15) // Only 3 courses
            ->get();




        return view('frontend.home.index', compact('upcomingCourses', 'topSellers'));
    }

    public function homeNew()
    {
        return view('frontend.home.test');
    }

    public function homeDemo(Request $request)
    {
        return view('frontend.home.demo');
    }

    public function show(Course $slug)
    {
        dd('In Progress ' . $slug);
    }

    public function leadForm(Request $request)
    {
        try {

            // EMAIL BLOCK
            $blockedEmails = [
                'daveledrew@gmail.com',
                'kabantsevalexander@gmail.com',
                'alicia.howse1@gmail.com',
                'jamesparnham@outlook.com',
                'Kabantsevalexander@gmail.com',
                'mothergibson13@gmail.com',
                'nirajmodhvadia7@gmail.com',
                'tidvicious@gmail.com',
                'zekisuquc419@gmail.com'
            ];
            if (in_array(strtolower($request->email), $blockedEmails)) {
                return response()->json([
                    'errors' => ['email' => ['This email address is not allowed.']]
                ], 422);
            }


            // IP BLOCK
            $blockedIps = [
                '103.244.175.8',
                '185.39.19.21'
            ];
            $userIp = $request->ip();
            if (in_array($userIp, $blockedIps)) {

                Log::alert('Blocked IP attempt: ' . $userIp);

                return response()->json([
                    'errors' => ['ip' => ['Access from your IP address is blocked.']]
                ], 403);
            }

            $validatedData = validator($request->all(), [
                'name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:30'],
                'email' => [
                    'required',
                    'email',
                    'max:50',
                    'regex:/^[a-zA-Z0-9._%+-]+@(gmail|yahoo|hotmail|outlook)\.com$/',
                    function ($attribute, $value, $fail) {
                        $disposableDomains = [
                            'yopmail.com',
                            'mailinator.com',
                            'guerrillamail.com',
                            '10minutemail.com',
                            'tempmail.com',
                            'trashmail.com',
                            'fakeinbox.com',
                            'getnada.com',
                            'maildrop.cc',
                            'dispostable.com',
                            'mailnesia.com',
                        ];

                        $emailDomain = strtolower(substr(strrchr($value, "@"), 1));
                        if (in_array($emailDomain, $disposableDomains)) {
                            $fail('Temporary or disposable email addresses are not allowed.');
                        }
                    }
                ],
                'phone' => 'required|max:13',
                'course_interested' => 'required|string',
                'notes' => 'required|max:150|string',
                'g-recaptcha-response' => 'required|captcha'
            ], [
                'name.required' => 'Please enter your name.',
                'name.regex' => 'Name must contain only letters.',
                'name.max' => 'Name must not be more than 30 characters.',
                'email.required' => 'Please enter your email address.',
                'email.email' => 'Please enter a valid email.',
                'email.max' => 'Email must not be more than 50 characters.',
                'email.regex' => 'Only Gmail, Yahoo, Hotmail, or Outlook email is allowed.',
                'phone.required' => 'Please enter your phone number.',
                'phone.max' => 'Phone number must not be more than 13 characters.',
                'course_interested.required' => 'Please select a course.',
                'course_interested.string' => 'Course interested must be a string.',
                'notes.required' => 'Please enter your notes.',
                'notes.max' => 'Notes must not be more than 150 characters.',
                'notes.string' => 'Notes must be a string.',
                'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
                'g-recaptcha-response.captcha' => 'Captcha verification failed. Please try again.',
            ])->validate();

            // Add IP to the data before saving
            $validatedData['ip_address'] = $userIp;

            $lead = LeadForm::create(Arr::except($validatedData, ['g-recaptcha-response']));

            // Send email
            Mail::to(['riz.dean@deans-group.co.uk', 'info@training4employment.co.uk'])->send(new LeadFormSubmitted($lead->toArray()));

            return response()->json([
                'redirect' => route('thank.you'),
                'message' => 'Lead form submitted successfully.'
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function courseCalender(Request $request)
    {
        $categories = Category::all();
        $venues = Venue::all();

        $query = Cohort::with(['course', 'venue'])
            ->whereHas('course', function ($q) {
                $q->where('category_id', '!=', 7);
            })->whereDate('start_date_time', '>=', now());

        if ($request->category_id) {
            $query->whereHas('course', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }
        if ($request->venue_id) {
            $query->where('venue_id', $request->venue_id);
        }
        if ($request->month) {
            $query->whereMonth('start_date_time', $request->month);
        }
        if ($request->year) {
            $query->whereYear('start_date_time', $request->year);
        }

        $cohorts = $query->where('cohort_status',1)->orderBy('start_date_time')->paginate(10)->appends($request->all());

        return view('frontend.home.course_calender', compact('cohorts', 'categories', 'venues'));
    }

    public function courseCalenderPdf(Request $request)
    {
        $categories = Category::all();
        $venues = Venue::all();

        $query = Cohort::with(['course', 'venue'])
            ->whereHas('course', function ($q) {
                $q->where('category_id', '!=', 7)
                    ->where('id', '!=', 33); // ✅ exclude course ID 33
            })->whereDate('start_date_time', '>=', now());

        if ($request->category_id) {
            $query->whereHas('course', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }
        if ($request->venue_id) {
            $query->where('venue_id', $request->venue_id);
        }
        if ($request->month) {
            $query->whereMonth('start_date_time', $request->month);
        }
        if ($request->year) {
            $query->whereYear('start_date_time', $request->year);
        }

        $cohorts = $query->orderBy('start_date_time')->get();
        $pdf = Pdf::loadView('frontend.home.course_calender_pdf', compact('cohorts', 'categories', 'venues'));
        return $pdf->download('course-calendar.pdf');
    }
}
