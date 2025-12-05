<?php

use App\Http\Controllers\Backend\ApplicationFormController;
use App\Http\Controllers\Backend\AssignPermissionController;
use App\Http\Controllers\Backend\AwardingBodyController;
use App\Http\Controllers\Backend\BackendCourseEvaluationFormController;
use App\Http\Controllers\Backend\bespokeLeadController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\CohortController;
use App\Http\Controllers\Backend\CourseBundleController;
use App\Http\Controllers\Backend\CourseController as BackendCourseController;
use App\Http\Controllers\Backend\CoursePreRequisitesController;
use App\Http\Controllers\Backend\CourseTasksController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DocumentUploadController;
use App\Http\Controllers\Backend\ExamResultController;
use App\Http\Controllers\Backend\MethodologyController;
use App\Http\Controllers\Backend\QuestionnairesController;
use App\Http\Controllers\Backend\ResellerController;
use App\Http\Controllers\Backend\ResourceController;
use App\Http\Controllers\Backend\RiskAssessmentController;
use App\Http\Controllers\Backend\SeoController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontPaymentController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\LicenceController;
use App\Http\Controllers\Backend\FormSubmissionController;
use App\Http\Controllers\Backend\LearnerDashboardController;
use App\Http\Controllers\Backend\ExamController;
use App\Http\Controllers\Backend\LeadFormController;
use App\Http\Controllers\Backend\MessageController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\OrderController as BackendOrderController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\PostCategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ProfilePhotoController;
use App\Http\Controllers\Backend\QualificationController;
use App\Http\Controllers\Backend\ResetPasswordUserController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\ScormController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SubscriberController as BackendSubscriberController;
//use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\TaskController;
use App\Http\Controllers\Backend\TrainerDashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VenueController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\CourseBundleController as FrontendCourseBundleController;
use App\Http\Controllers\Frontend\CourseController as FrontendCourseController;
use App\Http\Controllers\Frontend\LocationController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\QuestionnaireController;
use App\Http\Controllers\Frontend\RequestBespokeController;
use App\Http\Controllers\Frontend\RequestFormController;
use App\Http\Controllers\Frontend\SubscriberController;
use App\Http\Controllers\HighfieldQualificationController;
use App\Http\Controllers\ImpersonateController;
use App\Http\Controllers\SendLearnerFeedbackController;
use App\Http\Controllers\Backend\VideoFeedbackController;
use App\Libraries\ScormApiService;
use App\Models\Cohort;
use App\Models\LearnerCertificate;
use App\Models\License;
use App\Models\TaskSubmission;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Storage;
use Laravelium\Sitemap\Sitemap;
use setasign\Fpdi\Tcpdf\Fpdi;




Route::get('/send-feedback-emails', SendLearnerFeedbackController::class)
    //->middleware(['auth', 'role:Super Admin']) // Optional: restrict to admins
    ->name('learners.send.feedback');




Route::get('/test-reminders', function () {

    $datesToCheck = [Carbon::now()->addDays(3)->startOfDay(), Carbon::now()->addDay()->startOfDay()];
    foreach ($datesToCheck as $date) {
        $cohorts = Cohort::with(['learners', 'course.tasks'])
            //->whereDate('start_date_time', $date)
            ->get();

        foreach ($cohorts as $cohort) {
            foreach ($cohort->users as $learner) {
                $incompleteTasks = [];

                $filteredTasks = $cohort->course->tasks
                    ->where('type', '!=', 'Reminders')
                    ->whereNotIn('id', [12, 13, 14, 15, 18, 19]);

                foreach ($filteredTasks as $task) {
                    $submission = $task->submissions()
                        ->where('user_id', $learner->id)
                        ->where('cohort_id', $cohort->id)
                        ->first();

                    if (!$submission || $submission->status !== 'Approved') {
                        $incompleteTasks[] = $task->name; // collect task name
                    }
                }

                if (count($incompleteTasks) > 0) {
                    // Send email and pass incomplete task names
                    //                    Mail::to($learner->email)->send(
                    //                        new \App\Mail\TaskReminderMail($cohort, $learner, $incompleteTasks, $date)
                    //                    );

                    //                    Log::channel('cron')->info('Task reminder generated', [
                    //                        'learner_id' => $learner->id,
                    //                        'learner_email' => $learner->email,
                    //                        'cohort' => $cohort->name,
                    //                        'start_date' => \Carbon\Carbon::parse($cohort->start_date_time)->toDateTimeString(),
                    //                        'incomplete_tasks' => $incompleteTasks,
                    //                        'reminder_for_date' => $date->toDateString(),
                    //                    ]);


                }
            }
        }
    }
});


Route::get('/test-scorm', function () {

    //    $courseId = 4;
    //    $course_id = 4;
    //    $learner_id = "Waqar";
    //    $learnerEmail = "waqar87@outlook.com";
    //    $learnerFirstName = "Waqar";
    //    $learnerLastName = "Yamin";
    //    $registration_id = 'reg_' . $courseId . '_' . uniqid();
    //    // Usage Example
    //    $scormApiService = new ScormApiService();
    //    $registrationId = $registration_id;
    //    $learner = [
    //        'id' => $learner_id,
    //        'email' => $learnerEmail,
    //        'firstName' => $learnerFirstName,
    //        'lastName' => $learnerLastName ?? "",
    //    ];
    //
    //    // Create the registration
    //    //dd($registrationId,$learner,$courseId);
    //    $registrationResponse = $scormApiService->createRegistration($registrationId, $learner, $courseId);
    //
    //    // Generate the launch link
    //    $launchLinkResponse = $scormApiService->generateLaunchLink($registrationId, 2592000, 'Message');
    //
    //    if (!isset($launchLinkResponse['launchLink'])) {
    //        throw new \Exception("Launch link not generated for registration ID: $registrationId");
    //    }
    //
    //    $launchUrl = $launchLinkResponse['launchLink'];
    //
    //    try {
    //        TaskSubmission::create([
    //            'user_id' => 23,
    //            'license_id' => 1,
    //            'course_id' => $course_id,
    //            'cohort_id' => $cohort->id,
    //            'trainer_id' => $cohort->trainer_id,
    //            'scorm_registration_id' => $registration_id,
    //            'scorm_course_link' => $launchUrl,
    //        ]);
    //    } catch (\Exception $e) {
    //        Log::error('TaskSubmission creation failed: ' . $e->getMessage());
    //        throw $e; // Re-throw exception to handle it properly
    //    }

});



Route::get('/generate-certificate', function () {




    $templatePath = public_path('act_awareness-template (1).pdf');
    $pdf = new Fpdi();

    // Add a page and use the template
    $pdf->AddPage();
    $pdf->setSourceFile($templatePath);
    $templateId = $pdf->importPage(1);
    $pdf->useTemplate($templateId, 0, 0, 210);

    // Set default font
    $pdf->SetFont('Helvetica', '', 12);

    // Dynamic data
    $studentName = "Burhanuddin A Mohamed";
    $courseName = "Emergency First Aid At Work";
    $issueDate = "02/04/2025";

    $scormApiService = new ScormApiService();
    $courseData = $scormApiService->getCourse('HIGHFIELD_EMERGENCYFIRSTAIDATWORK_SINGLESCO_V1.5.3d48fbcc5-bcdd-4bc7-8657-817f52f26a7e');

    if (isset($courseData['rootActivity']) && isset($courseData['rootActivity']['children'])) {
        $modules = array_map(function ($child) {
            return $child['title'];
        }, $courseData['rootActivity']['children']);
    }

    // ADJUSTED VERTICAL POSITIONS (MOVED UP BY 20mm IN THIS EXAMPLE)
    $currentY = 78; // Changed from 110 to 90 (moved up 20mm)

    // "This certification is presented to" text
    //    $pdf->SetFont('Helvetica', 'I', 12);
    //    $pdf->SetXY(0, $currentY);
    //    $pdf->Cell(0, 8, "This certification is presented to", 0, 1, 'C');
    //    $currentY += 12;

    // Student Name (centered) - NOW POSITIONED HIGHER
    $pdf->SetFont('Helvetica', 'B', 18);
    $pdf->SetXY(0, $currentY);
    $pdf->Cell(0, 10, $studentName, 0, 1, 'C');
    $currentY += 15;

    // "has successfully completed..." text
    //    $pdf->SetFont('Helvetica', 'I', 12);
    //    $pdf->SetXY(0, $currentY);
    //    $pdf->Cell(0, 8, "has successfully completed the following course:", 0, 1, 'C');
    //    $currentY += 12;
    //
    //    // Course Name (centered)
    //    $pdf->SetFont('Helvetica', 'B', 16);
    //    $pdf->SetXY(0, $currentY);
    //    $pdf->Cell(0, 10, $courseName, 0, 1, 'C');
    //    $currentY += 15;

    // Modules section header
    //    $pdf->SetFont('Helvetica', '', 12);
    //    $pdf->SetXY(0, $currentY);
    //    $pdf->Cell(0, 8, "A pass was achieved in the following modules:", 0, 1, 'C');
    //    $currentY += 10;
    //
    //    $pdf->SetFont('Helvetica', '', 13);
    //    $maxWidth = 120;
    //    $centerX = (210 - $maxWidth) / 2;
    //
    //    foreach ($modules as $module) {
    //        $pdf->SetXY($centerX, $currentY);
    //        $pdf->Cell($maxWidth, 6, "• " . $module, 0, 1, 'L');
    //        $currentY += 7;
    //    }

    // Add some space before dates
    $currentY += 72;

    // Issue Date (centered)
    $pdf->SetFont('Helvetica', '', 12);
    $pdf->SetXY(48, $currentY);
    $pdf->Cell(0, 8,  $issueDate, 0, 1, 'C');

    // Output the PDF
    $pdf->Output('certificate.pdf', 'I');
});


/*
|--------------------------------------------------------------------------
| Sitemap XML
|--------------------------------------------------------------------------
|
|
*/



Route::get('/sitemap.xml', function (Sitemap $sitemap) {
    $sitemap->add(url('/'), now(), '1.0', 'daily');
    $sitemap->add(url('/examination-requirements'), now(), '0.8', 'weekly');
    $sitemap->add(url('/expert-resources'), now(), '0.8', 'weekly');
    $sitemap->add(url('/contact'), now(), '0.8', 'weekly');
    $sitemap->add(url('/sia-courses'), now(), '0.8', 'weekly');
    $sitemap->add(url('/e-learning'), now(), '0.8', 'weekly');
    $sitemap->add(url('/category/construction'), now(), '0.8', 'weekly');
    $sitemap->add(url('/category/sia-security-training'), now(), '0.8', 'weekly');
    $sitemap->add(url('/category/alcohol'), now(), '0.8', 'weekly');
    $sitemap->add(url('/category/e-learning-and-bite-size-courses'), now(), '0.8', 'weekly');
    $sitemap->add(url('/category/fire-safety-for-fire-wardens'), now(), '0.8', 'weekly');
    $sitemap->add(url('/category/first-aid-training'), now(), '0.8', 'weekly');
    $sitemap->add(url('/category/traffic-marshall-training'), now(), '0.8', 'weekly');
    $sitemap->add(url('/thankyou'), now(), '0.8', 'weekly');
    $sitemap->add(url('/sia-security-training-courses-leicester'), now(), '0.8', 'weekly');
    $sitemap->add(url('/sia-security-training-courses-nottingham'), now(), '0.8', 'weekly');
    $sitemap->add(url('/sia-security-training-courses-manchester'), now(), '0.8', 'weekly');
    $sitemap->add(url('/sia-security-training-courses-birmingham'), now(), '0.8', 'weekly');
    $sitemap->add(url('/e-learning/first-aid-training-at-work'), now(), '0.8', 'weekly');
    $sitemap->add(url('/e-learning/paediatric-first-aid'), now(), '0.8', 'weekly');
    $sitemap->add(url('/e-learning/principles-of-the-role-of-a-fire-marshal'), now(), '0.8', 'weekly');
    $sitemap->add(url('/e-learning/introduction-to-fire-safety-at-workplace'), now(), '0.8', 'weekly');
    $sitemap->add(url('/e-learning/awareness-of-modern-slavery'), now(), '0.8', 'weekly');
    $sitemap->add(url('/e-learning/equality-and-diversity'), now(), '0.8', 'weekly');
    $sitemap->add(url('/e-learning/general-data-protection-regulation-gdpr'), now(), '0.8', 'weekly');
    $sitemap->add(url('/e-learning/manual-handling'), now(), '0.8', 'weekly');
    $sitemap->add(url('/e-learning/food-safety-in-manufacturing'), now(), '0.8', 'weekly');
    $sitemap->add(url('/e-learning/food-safety-level-3'), now(), '0.8', 'weekly');
    $sitemap->add(url('/e-learning/food-safety-level-2'), now(), '0.8', 'weekly');
    $sitemap->add(url('/e-learning/an-awareness-of-warehousing-and-storage'), now(), '0.8', 'weekly');
    $sitemap->add(url('/e-learning/customer-service'), now(), '0.8', 'weekly');
    $sitemap->add(url('/e-learning/introduction-to-working-at-height'), now(), '0.8', 'weekly');
    $sitemap->add(url('/e-learning/asbestos-awareness'), now(), '0.8', 'weekly');
    $sitemap->add(url('/courses/sia-door-supervisor'), now(), '0.8', 'weekly');
    $sitemap->add(url('/courses/door-supervisor-refresher'), now(), '0.8', 'weekly');
    $sitemap->add(url('/courses/sia-cctv-operator'), now(), '0.8', 'weekly');
    $sitemap->add(url('/courses/security-guard-refresher'), now(), '0.8', 'weekly');
    $sitemap->add(url('/courses/level-1-health-and-safety-awareness-within-construction-environment'), now(), '0.8', 'weekly');
    $sitemap->add(url('/courses/health-and-safety-awareness-hsa'), now(), '0.8', 'weekly');
    $sitemap->add(url('/courses/sssts-site-supervision-safety'), now(), '0.8', 'weekly');
    $sitemap->add(url('/courses/sssts-refresher'), now(), '0.8', 'weekly');
    $sitemap->add(url('/courses/smsts-site-management-safety'), now(), '0.8', 'weekly');
    $sitemap->add(url('/courses/smsts-refresher'), now(), '0.8', 'weekly');
    $sitemap->add(url('/courses/first-aid-at-work'), now(), '0.8', 'weekly');
    $sitemap->add(url('/courses/emergency-first-aid-at-work'), now(), '0.8', 'weekly');
    $sitemap->add(url('/courses/paediatric-first-aid-training-course'), now(), '0.8', 'weekly');




    $sitemap->add(url('/courses/aphl-persolanal-licence'), now(), '0.8', 'weekly');
    $sitemap->add(url('/products'), now(), '0.8', 'weekly');
    $sitemap->add(url('/product/first-aid-handbook'), now(), '0.8', 'weekly');
    $sitemap->add(url('/product/cctv-course-book'), now(), '0.8', 'weekly');
    $sitemap->add(url('/product/door-supervisor-course-book'), now(), '0.8', 'weekly');
    $sitemap->add(url('/product/clip-on-uniform-tie'), now(), '0.8', 'weekly');
    $sitemap->add(url('/product/badge-holders'), now(), '0.8', 'weekly');
    $sitemap->add(url('/product/hand-tally-counter'), now(), '0.8', 'weekly');
    $sitemap->add(url('/about-us'), now(), '0.8', 'weekly');
    $sitemap->add(url('/faq'), now(), '0.8', 'weekly');
    $sitemap->add(url('/refer-a-friend'), now(), '0.8', 'weekly');
    $sitemap->add(url('/corporate-training-solutions'), now(), '0.8', 'weekly');
    $sitemap->add(url('/help-center'), now(), '0.8', 'weekly');
    $sitemap->add(url('/booking-terms-and-conditions'), now(), '0.8', 'weekly');
    $sitemap->add(url('/privacy-policy'), now(), '0.8', 'weekly');
    $sitemap->add(url('/sia-courses-bundles'), now(), '0.8', 'weekly');
    $sitemap->add(url('/sia-courses-bundles/door-supervisor-refresher-cctv-bundle'), now(), '0.8', 'weekly');
    $sitemap->add(url('/sia-courses-bundles/door-supervisor-cctv-bundle-emergency-first-aid-at-work'), now(), '0.8', 'weekly');
    $sitemap->add(url('/sia-courses-bundles/door-supervisor-health-and-safety-awareness-hsa-bundle'), now(), '0.8', 'weekly');
    $sitemap->add(url('/sia-courses-bundles/door-supervisor-cctv-health-and-safety-awareness-hsa-bundle'), now(), '0.8', 'weekly');
    $sitemap->add(url('/sia-courses-bundles/door-supervisor-traffic-marshal-vehicle-banksman-bundle'), now(), '0.8', 'weekly');
    $sitemap->add(url('/sia-courses-bundles/door-supervisor-refresher-traffic-marshal-vehicle-banksman-bundle'), now(), '0.8', 'weekly');
    $sitemap->add(url('/sia-courses-bundles/health-and-safety-awareness-hsa-traffic-marshal-vehicle-banksman-bundle'), now(), '0.8', 'weekly');
    return $sitemap->render('xml');
});




/*
|--------------------------------------------------------------------------
| 301 Redirections
|--------------------------------------------------------------------------
|
|
*/



Route::redirect('/index.html', '/', 301);


Route::redirect('https://training4employment.co.uk/wp-info.php', '/', 301);



Route::redirect('/courses-bundles-new', '/courses-bundles', 301);
Route::redirect('/courses/copy-of-first-aid-at-work-1/', '/', 301);
Route::redirect('/thank-you-enq/', '/', 301);
Route::redirect('/courses/l1-health-and-safety-within-a-construction-environment-course-online/', '/', 301);
Route::redirect('/wp-content/uploads/2021/08/Traffic-Marshall-Course-Leaflet_2.0.pdf/', '/', 301);
Route::redirect('/fire-arms-training-course/', '/', 301);
Route::redirect('/you-can-still-train-employees-who-work-remotely/', '/', 301);
Route::redirect('/changes-to-close-protection-training-coming-in-april-2022/', '/', 301);
Route::redirect('/finance/', '/', 301);
Route::redirect('/e-learning/emergency-first-aid-at-work/', '/e-learning', 301);
Route::redirect('/e-learning/stress-management/', '/e-learning', 301);
Route::redirect('/e-learning/introduction-to-allergens/', '/e-learning', 301);
Route::redirect('/e-learning/health-and-safety-level-1/', '/e-learning', 301);
Route::redirect('/e-learning/team-working/', '/e-learning', 301);
Route::redirect('/sia-security-training-courses-nottingham', '/sia-security-training-courses-in-nottingham', 301);
Route::redirect('/courses', '/sia-courses', 301);
Route::redirect('/e-learning/principles-of-the-role-of-a-fire-marshal', '/e-learning/level-2-principles-of-the-role-of-a-fire-marshal', 301);


Route::redirect('/courses/health-and-safety-awareness-course', '/courses/health-and-safety-awareness-hsa', 301);
Route::redirect('/courses/traffic-marshall-trainining', '/courses/traffic-marshall-training', 301);
Route::redirect('/sia-courses-bundles/traffic-marshall-training', '/sia-courses-bundles', 301);


Route::redirect('/resources', '/expert-resources', 301);

Route::redirect('/frontend/pdf/T4E_Course-Dates_2025_Updated03012025.pdf', '/public//frontend/pdf/T4E_CourseCourseDates.pdf', 301);
Route::redirect('/public/frontend/pdf/T4E_Course-Dates_2025_Updated03012025.pdf', '/public//frontend/pdf/T4E_CourseCourseDates.pdf', 301);
Route::redirect('wp-content/uploads/2023/09/T4E_Courses-2023_15-09-2023.pdf', '/public//frontend/pdf/T4E_CourseCourseDates.pdf', 301);
Route::redirect('/public//frontend/pdf/T4E_Course-Dates_2025_Updated03012025.pdf', '/public//frontend/pdf/T4E_CourseCourseDates.pdf', 301);

// Main pages
//Route::redirect('/public/', '/', 301);
Route::redirect('/public/about', '/about', 301);
Route::redirect('/public/booking-terms-and-conditions', '/booking-terms-and-conditions', 301);
Route::redirect('/public/cart', '/cart', 301);
Route::redirect('/public/contact', '/contact', 301);
Route::redirect('/public/corporate-training-solutions', '/corporate-training-solutions', 301);
Route::redirect('/public/e-learning', '/e-learning', 301);
Route::redirect('/public/examination-requirements', '/examination-requirements', 301);
Route::redirect('/public/faq', '/faq', 301);
Route::redirect('/public/products', '/products', 301);
Route::redirect('/public/refer-a-friend', '/refer-a-friend', 301);
Route::redirect('/public/sia-courses', '/sia-courses', 301);
Route::redirect('/public/sia-courses-bundles', '/sia-courses-bundles', 301);
Route::redirect('/public/blog', '/blog', 301);

// Category pages
Route::redirect('/public/category/alcohol', '/category/alcohol', 301);
Route::redirect('/public/category/construction', '/category/construction', 301);
Route::redirect('/public/category/fire-safety-for-fire-wardens', '/category/fire-safety-for-fire-wardens', 301);
Route::redirect('/public/category/first-aid-training', '/category/first-aid-training', 301);
Route::redirect('/public/category/sia-security-training', '/category/sia-security-training', 301);
Route::redirect('/public/category/traffic-marshall-training', '/category/traffic-marshall-training', 301);

// Course pages
Route::redirect('/public/courses/aphl-personal-licence', '/courses/aphl-personal-licence', 301);
Route::redirect('/public/courses/asbestos-awareness', '/courses/asbestos-awareness', 301);
Route::redirect('/public/courses/door-supervisor-refresher', '/courses/door-supervisor-refresher', 301);
Route::redirect('/public/courses/emergency-first-aid-at-work', '/courses/emergency-first-aid-at-work', 301);
Route::redirect('/public/courses/fire-safety-for-fire-wardens', '/courses/fire-safety-for-fire-wardens', 301);
Route::redirect('/public/courses/first-aid-at-work', '/courses/first-aid-at-work', 301);
Route::redirect('/public/courses/first-aid-training-at-work', '/courses/first-aid-training-at-work', 301);
Route::redirect('/public/courses/food-safety-in-manufacturing', '/courses/food-safety-in-manufacturing', 301);
Route::redirect('/public/courses/food-safety-level-1', '/courses/food-safety-level-1', 301);
Route::redirect('/public/courses/health-and-safety-awareness-hsa', '/courses/health-and-safety-awareness-hsa', 301);
Route::redirect('/public/courses/introduction-to-working-at-height', '/courses/introduction-to-working-at-height', 301);
Route::redirect('/public/courses/level-1-health-and-safety-awareness-within-construction-environment', '/courses/level-1-health-and-safety-awareness-within-construction-environment', 301);
Route::redirect('/public/courses/paediatric-first-aid-training-course', '/courses/paediatric-first-aid-training-course', 301);
Route::redirect('/public/courses/principles-of-the-role-of-a-fire-marshal', '/courses/principles-of-the-role-of-a-fire-marshal', 301);
Route::redirect('/public/courses/security-guard-refresher', '/courses/security-guard-refresher', 301);
Route::redirect('/public/courses/sia-cctv-operator', '/courses/sia-cctv-operator', 301);
Route::redirect('/public/courses/sia-door-supervisor', '/courses/sia-door-supervisor', 301);
Route::redirect('/public/courses/smsts-refresher', '/courses/smsts-refresher', 301);
Route::redirect('/public/courses/smsts-site-management-safety', '/courses/smsts-site-management-safety', 301);
Route::redirect('/public/courses/sssts-refresher', '/courses/sssts-refresher', 301);
Route::redirect('/public/courses/sssts-site-supervision-safety', '/courses/sssts-site-supervision-safety', 301);
Route::redirect('/public/courses/traffic-marshall-training', '/courses/traffic-marshall-training', 301);

// E-learning pages
Route::redirect('/public/e-learning/an-awareness-of-warehousing-and-storage', '/e-learning/an-awareness-of-warehousing-and-storage', 301);
Route::redirect('/public/e-learning/asbestos-awareness', '/e-learning/asbestos-awareness', 301);
Route::redirect('/public/e-learning/awareness-of-modern-slavery', '/e-learning/awareness-of-modern-slavery', 301);
Route::redirect('/public/e-learning/customer-service', '/e-learning/customer-service', 301);
Route::redirect('/public/e-learning/equality-and-diversity', '/e-learning/equality-and-diversity', 301);
Route::redirect('/public/e-learning/first-aid-training-at-work', '/e-learning/first-aid-training-at-work', 301);
Route::redirect('/public/e-learning/food-safety-in-manufacturing', '/e-learning/food-safety-in-manufacturing', 301);
Route::redirect('/public/e-learning/food-safety-level-1', '/e-learning/food-safety-level-1', 301);
Route::redirect('/public/e-learning/food-safety-level-2', '/e-learning/food-safety-level-2', 301);
Route::redirect('/public/e-learning/food-safety-level-3', '/e-learning/food-safety-level-3', 301);
Route::redirect('/public/e-learning/general-data-protection-regulation-gdpr', '/e-learning/general-data-protection-regulation-gdpr', 301);
Route::redirect('/public/e-learning/introduction-to-fire-safety-at-workplace', '/e-learning/introduction-to-fire-safety-at-workplace', 301);
Route::redirect('/public/e-learning/introduction-to-working-at-height', '/e-learning/introduction-to-working-at-height', 301);
Route::redirect('/public/e-learning/manual-handling', '/e-learning/manual-handling', 301);
Route::redirect('/public/e-learning/paediatric-first-aid', '/e-learning/paediatric-first-aid', 301);
Route::redirect('/public/e-learning/principles-of-the-role-of-a-fire-marshal', '/e-learning/principles-of-the-role-of-a-fire-marshal', 301);

// Location pages
Route::redirect('/public/location/Leicester', '/location/Leicester', 301);
Route::redirect('/public/location/birmingham', '/location/birmingham', 301);
Route::redirect('/public/location/london', '/location/london', 301);
Route::redirect('/public/location/manchester', '/location/manchester', 301);
Route::redirect('/public/location/nottingham', '/location/nottingham', 301);

// Product pages
Route::redirect('/public/product/badge-holders', '/product/badge-holders', 301);
Route::redirect('/public/product/cctv-course-book', '/product/cctv-course-book', 301);
Route::redirect('/public/product/clip-on-uniform-tie', '/product/clip-on-uniform-tie', 301);
Route::redirect('/public/product/door-supervisor-course-book', '/product/door-supervisor-course-book', 301);
Route::redirect('/public/product/first-aid-handbook', '/product/first-aid-handbook', 301);
Route::redirect('/public/product/hand-tally-counter', '/product/hand-tally-counter', 301);

// Course bundles
Route::redirect('/public/sia-courses-bundles/door-supervisor-cctv-bundle', '/sia-courses-bundles/door-supervisor-cctv-bundle-emergency-first-aid-at-work', 301);
Route::redirect('/public/sia-courses-bundles/door-supervisor-cctv-health-and-safety-awareness-hsa-bundle', '/sia-courses-bundles/door-supervisor-cctv-health-and-safety-awareness-hsa-bundle', 301);
Route::redirect('/public/sia-courses-bundles/door-supervisor-health-and-safety-awareness-hsa-bundle', '/sia-courses-bundles/door-supervisor-health-and-safety-awareness-hsa-bundle', 301);
Route::redirect('/public/sia-courses-bundles/door-supervisor-refresher-traffic-marshal-vehicle-banksman-bundle', '/sia-courses-bundles/door-supervisor-refresher-traffic-marshal-vehicle-banksman-bundle', 301);
Route::redirect('/public/sia-courses-bundles/door-supervisor-traffic-marshal-vehicle-banksman-bundle', '/sia-courses-bundles/door-supervisor-traffic-marshal-vehicle-banksman-bundle', 301);
Route::redirect('/public/sia-courses-bundles/emergency-first-aid-at-work-door-supervisor-refresher-cctv-operator', '/sia-courses-bundles/emergency-first-aid-at-work-door-supervisor-refresher-cctv-operator', 301);
Route::redirect('/public/sia-courses-bundles/health-and-safety-awareness-hsa-traffic-marshal-vehicle-banksman-bundle', '/sia-courses-bundles/health-and-safety-awareness-hsa-traffic-marshal-vehicle-banksman-bundle', 301);

// SIA training locations
Route::redirect('/public/sia-security-training-courses-in-birmingham', '/sia-security-training-courses-in-birmingham', 301);
Route::redirect('/public/sia-security-training-courses-in-leicester', '/sia-security-training-courses-in-leicester', 301);
Route::redirect('/public/sia-security-training-courses-in-london', '/sia-security-training-courses-in-london', 301);
Route::redirect('/public/sia-security-training-courses-in-manchester', '/sia-security-training-courses-in-manchester', 301);
Route::redirect('/public/sia-security-training-courses-in-nottingham', '/sia-security-training-courses-in-nottingham', 301);


// Additional pages
Route::redirect('/public/page-construction-courses', '/page-construction-courses', 301);
Route::redirect('/public/page-energy-and-utilities', '/page-energy-and-utilities', 301);
Route::redirect('/public/partner', '/partner', 301);


Route::redirect('/public//frontend/pdf/T4E_Course-Dates_2025_Updated03012025.pdf', '/public/frontend/pdf/T4E_CourseCourseDates.pdf', 301);



Route::redirect('/courses/principles-of-the-role-of-a-fire-marshal', '/e-learning/level-2-principles-of-the-role-of-a-fire-marshal', 301);


Route::redirect('/courses/cctv-operator-course-public-surveillance', '/courses/sia-cctv-operator', 301);
Route::redirect('/courses/door-supervisor-course-birmingham', '/courses/sia-door-supervisor', 301);
Route::redirect('/courses/sia-security-guard-top-up-course', '/courses/security-guard-refresher', 301);
Route::redirect('/courses/trafficmarshall-banksman', '/courses/traffic-marshall-training', 301);
Route::redirect('/courses/upskilling-door-supervisors', '/courses/door-supervisor-refresher', 301);



Route::redirect('/location/birmingham', '/sia-security-training-courses-in-birmingham', 301);
Route::redirect('/location/nottingham', '/sia-security-training-courses-in-nottingham', 301);
Route::redirect('/location/london', '/sia-security-training-courses-in-london', 301);
Route::redirect('/location/manchester', '/sia-security-training-courses-in-manchester', 301);
Route::redirect('/location/Leicester', '/sia-security-training-courses-in-leicester', 301);

Route::redirect('/sssts', 'https://training4employment.co.uk/courses/sssts-site-supervision-safety', 301);
Route::redirect('/smsts-r', 'https://training4employment.co.uk/courses/smsts-refresher', 301);
Route::redirect('/sssts-r', 'https://training4employment.co.uk/courses/sssts-refresher', 301);
Route::redirect('/smsts', 'https://training4employment.co.uk/courses/smsts-site-management-safety', 301);
//Route::redirect('/blogs/blog/', '/', 301);

//Route::redirect('/blog/', '/blogs', 301);
Route::redirect('/partner/', '/refer-a-friend', 301);
Route::redirect('/page-construction-courses/', '/category/construction', 301);
Route::redirect('/page-energy-and-utilities/', '/', 301);




Route::get('/wp-content/uploads/2021/04/Title-Page-2.jpg', function () {
    return Redirect::to('https://training4employment.co.uk/blogs/wp-content/uploads/2021/04/Title-Page-2.jpg', 301);
});



Route::redirect('/home', '/', 301);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!|
*/


// Frontend Routes

// Route::post('/process-paypal-payment', [FrontPaymentController::class, 'processPayPalPayment']);
// Route::post('/create-order', [CheckoutController::class, 'createOrder'])->name('checkout.createOrder');

// 404

//Route::get('/public/{path?}', function ($path = null) {
//    return redirect('/' . $path);
//})->where('path', '.*');



//Route::get('/blogs/{any?}', function () {
//    return redirect('/blogs');
//})->where('any', '.*');

// Route::fallback(function () {
//     $path = request()->path();

//     $staticExtensions = ['js', 'css', 'png', 'jpg', 'jpeg', 'gif', 'ico', 'svg', 'woff', 'woff2', 'ttf', 'eot', 'pdf'];
//     $extension = pathinfo($path, PATHINFO_EXTENSION);

//     // let web server handle real/static files
//     if (in_array($extension, $staticExtensions)) {
//         abort(404);
//     }

//     // 🔥 IMPORTANT PART:
//     // if the URL is /blogs or starts with /blogs/, DO NOT return Blade 404.
//     // we abort(404) so Apache keeps control (and WP/.htaccess in blogs kicks in)
//     if ($path === 'blogs' || str_starts_with($path, 'blogs/')) {
//         abort(404);
//     }

//     // otherwise show Laravel's 404 page
//     return view('frontend.not-found.index');
// });




Route::get('/', [HomeController::class, 'index'])->name('home.index');
//Route::get('/home-new', [HomeController::class, 'homeNew'])->name('home.test');
Route::get('/demo', [HomeController::class, 'homeDemo'])->name('home.demo');
Route::post('/request-form', [RequestFormController::class, 'store'])->name('frontend.request.form.store');


// Route::get('/questionnaire', [QuestionnaireController::class, 'index']);
Route::post('/lead-form', [HomeController::class, 'leadForm'])->name('lead.form');
Route::post('/questionnaire', [QuestionnaireController::class, 'store'])->name('questionnaire.store');

Route::get('/sia-courses', [FrontendCourseController::class, 'index'])->name('courses.index');
Route::get('/courses-calender', [HomeController::class, 'courseCalender'])->name('courses.calender');
Route::get('/courses/calender/pdf', [HomeController::class, 'courseCalenderPdf'])->name('courses.calender.pdf');
Route::get('/request-bespoke', [RequestBespokeController::class, 'index'])->name('request.');
Route::post('/request-bespoke/store', [RequestBespokeController::class, 'store'])->name('bespoke.store');

Route::get('/category/{category}', [FrontendCourseController::class, 'getCoursesByCategory'])->name('courses.byCategory');


Route::get('/e-learning', [FrontendCourseController::class, 'elearning'])->name('elearning.index');
Route::get('/e-learning/{slug}', [FrontendCourseController::class, 'eLearningShow'])->name('elearning.course');

Route::get('/courses/{slug}', [FrontendCourseController::class, 'show'])->name('course.show');
Route::get('/booking/{slug}/checkout', [HomeController::class, 'show'])->name('booking.show.checkout');

// Producrs Route

Route::get('/products', [FrontendProductController::class, 'index'])->name('frontend.product.index');
Route::get('/product/{slug}', [FrontendProductController::class, 'show'])->name('frontend.product.show');

// Locations Route
// Route::get('/location', [LocationController::class, 'index'])->name('location');
//Route::get('/location/{slug}', [LocationController::class, 'show'])->name('locations.show');

Route::get('/sia-security-training-courses-in-{slug}', [LocationController::class, 'show'])->name('locations.show');



// E- Learning
//Route::get('/e-learning', [FrontendCourseController::class, 'getCoursesByCategory'])->name('elearning.index');



// Locations Route End
// Category Route
Route::get('/categories/first-aid-training', [FrontendCategoryController::class, 'firstAidTraining'])->name('firstAidTraining');
Route::get('/categories/personal-licence-holder-aplh', [FrontendCategoryController::class, 'personalLicence'])->name('personalLicence');
Route::get('/categories/construction-training', [FrontendCategoryController::class, 'constructionRraining'])->name('constructionRraining');
Route::get('/categories/traffic-marshal-vehicle-banksman-training', [FrontendCategoryController::class, 'trafficMarshalVb'])->name('trafficMarshalVb');
// Category Route End
Route::get('/about', [PagesController::class, 'about'])->name('about');

Route::get('/faq', [PagesController::class, 'faq'])->name('faq');
Route::get('/contact/', [PagesController::class, 'contact'])->name('contact');
Route::get('/refer-a-friend', [PagesController::class, 'referFriend'])->name('refer.friend');
Route::get('/corporate-training-solutions', [PagesController::class, 'corporate'])->name('corporate.training');
Route::get('/help-center', [PagesController::class, 'helpCenter'])->name('help.center');
Route::get('/booking-terms-and-conditions', [PagesController::class, 'bookingConditions'])->name('booking.conditions');
Route::get('/privacy-policy', [PagesController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/examination-requirements', [PagesController::class, 'examinationRequirements'])->name('examination.requirements');
Route::get('/expert-resources', [PagesController::class, 'expertResources'])->name('expert.resources');


Route::post('/contact-submit', [PagesController::class, 'contactSubmit'])->name('contact.submit');

Route::post('/subscriber/store', [SubscriberController::class, 'store'])->name('subscriber.store');

Route::get('/check-cookie', function (Request $request) {
    return response()->json([
        'form_submitted' => $request->cookie('form_submitted', false)
    ]);
});



Route::get('/thank-you', [PagesController::class, 'thankYou'])->name('thank.you');

// Course Bundle Route
Route::get('/sia-courses-bundles', [FrontendCourseBundleController::class, 'index'])->name('course.bundle');

Route::get('/sia-courses-bundles/{slug}', [FrontendCourseBundleController::class, 'show'])->name('course.bundle.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::post('/coupon-exist', [CheckoutController::class, 'couponCode'])->name('checkout.coupon');


Route::post('/remove-coupon', [CheckoutController::class, 'removeCoupon'])->name('coupon.remove');



Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'processPayment'])->name('checkout.process');
Route::get('/thankyou', [CheckoutController::class, 'thankyou'])->name('checkout.thankyou');
Route::get('/payment-return', [CheckoutController::class, 'handleReturn'])->name('payment.return');

Route::middleware('auth')->group(function () {
    Route::post('/orders', [OrderController::class, 'createOrder'])->name('order.create');
    Route::post('/payments/{order}', [FrontPaymentController::class, 'processPayment'])->name('payment.process');
});

// Course Bundle Route End

// Frontend Routes End

Route::get('/login', function () {
    return redirect()->route('login');
})->name('home.login');


//Route::get('/email-test', function () {
//    $to_name = 'Recipient Name';
//    $to_email = 'web@deans-group.co.uk';
//
//    $data = [
//        'name' => "Test User",
//        'body' => "This is a test email sent from the Laravel server."
//    ];
//
//    Mail::raw($data['body'], function ($message) use ($to_name, $to_email) {
//        $message->to($to_email, $to_name)
//            ->subject('Laravel Test Email');
//        $message->from('your-email@example.com', 'Your Name');
//    });
//
//    return 'Test email sent successfully!';
//})->name('email.test');


Auth::routes([
    'register' => false,
    'reset' => true,
    'verify' => false,
]);

//Route::impersonate();

Route::get('/regions', function () {
    return getRegions();
});

Route::get('/cities/{region}', function ($region) {
    return getCities($region);
});


Route::get('/impersonate/take/{id}', [ImpersonateController::class, 'take'])->name('impersonate');
Route::get('/impersonate/leave', [ImpersonateController::class, 'leave'])->name('impersonate.leave');


Route::group(['prefix' => 'backend', 'as' => 'backend.', 'middleware' => ['auth', 'forcePasswordChange']], function () {

    Route::group([
        'prefix' => 'video-feedback',
        'as'     => 'video-feedback.',
    ], function () {

        Route::get('/', [VideoFeedbackController::class, 'create'])
            ->name('create');

        Route::post('/', [VideoFeedbackController::class, 'store'])
            ->name('store');

        Route::get('/my', [VideoFeedbackController::class, 'my'])
            ->name('my');

        Route::get('/my/data', [VideoFeedbackController::class, 'myData'])
            ->name('my.data');

        Route::get('/list', [VideoFeedbackController::class, 'index'])
            ->name('index');


       Route::get('/list/data', [VideoFeedbackController::class, 'adminData'])
            ->name('index.data')
            ->middleware('permission:see learner-video-feedback');

        Route::get('/{id}/view', [VideoFeedbackController::class, 'show'])
            ->name('show')
            ->middleware('permission:see learner-video-feedback');

        Route::post('/{id}/approve', [VideoFeedbackController::class, 'approve'])
            ->name('approve')
            ->middleware('permission:approve learner-video-feedback');

        Route::post('/{id}/reject', [VideoFeedbackController::class, 'reject'])
            ->name('reject')
            ->middleware('permission:reject learner-video-feedback');
    });


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('permission:view dashboard');

    Route::get('/admin-self-study', [DashboardController::class, 'adminSelfStudy'])->name('admin.self.study');
    Route::get('/admin-self-study-details/{id}', [DashboardController::class, 'adminSelfStudyDetails'])->name('admin.self.study.details');


    Route::get('/admin-grade-learner', [DashboardController::class, 'adminGradeLearner'])->name('admin.grade.learner');

    Route::post('/notify-learner', [DashboardController::class, 'notifyHighFieldCertificate'])->name('notify.learner');

    Route::post('/admin-highfield-certificate-upload', [DashboardController::class, 'adminHighfieldCertificate'])
        ->name('admin.highfield.certificate');


    Route::post('/admin/highfield-certificate', [DashboardController::class, 'adminReUploadHighfieldCertificate'])
        ->name('admin.reuploadhighfield.certificate');


    Route::post('/admin/highfield-certificate/remove', [DashboardController::class, 'adminRemoveHighfieldCertificate'])
        ->name('admin.removehighfield.certificate');


    Route::get('/admin/highfield-qualifications', [HighfieldQualificationController::class, 'index'])->name('highfield.index');
    Route::post('/admin/highfield-qualifications/update', [HighfieldQualificationController::class, 'update'])->name('highfield.update');


    Route::get('/admin-learner-certificate', [DashboardController::class, 'adminLearnerCertificate'])->name('admin.learner.certificate');

    Route::post('/admin-generate-certificate', [DashboardController::class, 'adminGenerateCertificate'])->name('generate.certificate');


    Route::post('/upload-act-document', [LearnerDashboardController::class, 'uploadActDocument']);
    Route::post('/remove-act-document', [LearnerDashboardController::class, 'removeActDocument']);


    Route::post('/upload-certificate', [DashboardController::class, 'uploadCertificate'])->name('upload.certificate');

    Route::get('/required-tasks', function () {
        //        $user = auth()->user();
        //        if($user->hasRole('Learner')) {
        return view('backend.required_tasks');
        //        } else {
        //            return redirect()->back();
        //        }
    })->name('required.tasks')->middleware('permission:view learner dashboard');


    Route::post('/edit-form-request/{id}', [DashboardController::class, 'editFormApplicationRequest'])->name('edit_form_request.dashboard')->middleware('permission:add learner dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update/{id}', [ProfileController::class, 'updateGeneralInformation'])->name('profile.update.information');
    Route::put('/profile/update/password/{id}', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::post('/profile/update/image', [ProfileController::class, 'updateImage'])->name('profile.update.image');

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:see roles');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission:add roles');
        Route::post('/', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:add roles');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:change roles');
        Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:change roles');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:delete role');
    });

    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permissions.index')->middleware('permission:look at permissions');
        Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware('permission:add permissions');
        Route::post('/', [PermissionController::class, 'store'])->name('permissions.store')->middleware('permission:add permissions');
        Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('permission:change permissions');
        Route::put('/{permission}', [PermissionController::class, 'update'])->name('permissions.update')->middleware('permission:change permissions');
        Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy')->middleware('permission:delete permissions');
    });

    Route::group(['prefix' => 'assignpermission'], function () {
        Route::get('/', [AssignPermissionController::class, 'index'])->name('assignpermission.index')->middleware('permission:see assign permissions');
        Route::get('/{role}/edit', [AssignPermissionController::class, 'editRolePermission'])->name('assignpermission.edit')->middleware('permission:change assign permissions');
        Route::post('/updaterolepermission', [AssignPermissionController::class, 'updateRolePermission'])->name('assignpermission.update')->middleware('permission:change assign permissions');
    });

    // Course Bundle Routes

    Route::resource('courses-bundles', CourseBundleController::class)
        ->parameters([
            'courses-bundles' => 'slug'
        ])
        ->names([
            'index' => 'courses-bundle.index',
            'create' => 'courses-bundle.create',
            'store' => 'courses-bundle.store',
            'show' => 'courses-bundle.show',
            'edit' => 'courses-bundle.edit',
            'update' => 'courses-bundle.update',
            'destroy' => 'courses-bundle.destroy',
        ])
        ->middleware([
            'index' => 'permission:see courses-bundle',
            'create' => 'permission:add courses-bundle',
            'store' => 'permission:add courses-bundle',
            'edit' => 'permission:change courses-bundle',
            'update' => 'permission:change courses-bundle',
            'destroy' => 'permission:delete courses-bundle',
        ]);

    Route::get('/bespoke', [bespokeLeadController::class, 'index'])->name('request.bespoke.index')->middleware('permission:see bespoke');
    Route::post('/bespoke/mark-as-read', [bespokeLeadController::class, 'markAsRead'])->name('request.bespoke.markAsRead')->middleware('permission:see bespoke');


    Route::group(['prefix' => 'resellers'], function () {
        Route::get('/', [ResellerController::class, 'index'])->name('resellers.index')->middleware('permission:see reseller');
        Route::get('/create', [ResellerController::class, 'create'])->name('resellers.create')->middleware('permission:add reseller');
        Route::post('/', [ResellerController::class, 'store'])->name('resellers.store')->middleware('permission:add reseller');
        Route::get('/{reseller}/edit', [ResellerController::class, 'edit'])->name('resellers.edit')->middleware('permission:change reseller');
        Route::put('/{reseller}', [ResellerController::class, 'update'])->name('resellers.update')->middleware('permission:change reseller');
        Route::delete('/{reseller}', [ResellerController::class, 'destroy'])->name('resellers.destroy')->middleware('permission:delete reseller');
        Route::get('/{reseller}', [ResellerController::class, 'show'])->name('resellers.show')->middleware('permission:see reseller');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index')->middleware('permission:see user');
        Route::get('/create', [UserController::class, 'create'])->name('users.create')->middleware('permission:add user');
        Route::get('/filterCohorts', [UserController::class, 'filterCohorts'])->name('users.filterCohorts');
        Route::post('/', [UserController::class, 'store'])->name('users.store')->middleware('permission:add user');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:change user');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update')->middleware('permission:change user');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:delete user');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show')->middleware('permission:see user');

        Route::put('/users/{user}/resetpassword', [ResetPasswordUserController::class, 'resetPassword'])->name('users.reset.password')->middleware('permission:change user');

        Route::put('/user-cohort-payments/{id}', [UserController::class, 'updatePayment'])->name('userCohortPayments.update');

        Route::get('/user-history/{user}', [UserController::class, 'showHistory'])->name('user.history');

        Route::get('/resend-email/{id}', [UserController::class, 'resendEmail'])->name('users.resendEmail');

        Route::post('/users/resend-email', [UserController::class, 'ajaxResendEmail'])
            ->name('users.ajaxResendEmail');



    });


    Route::group(['prefix' => 'course-evaluation-form'], function () {
        Route::get('/index', [BackendCourseEvaluationFormController::class, 'index'])->name('course-evaluation-form.index');
        Route::get('/{id}', [BackendCourseEvaluationFormController::class, 'show'])->name('course-evaluation-form.show');
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/index', [BackendOrderController::class, 'index'])->name('order.index')->middleware('permission:see order');
        // Route::get('/create', [BackendOrderController::class, 'create'])->name('order.create')->middleware('permission:add order');
        // Route::post('/', [BackendOrderController::class,'store'])->name('order.store')->middleware('permission:add order');
        // Route::get('/{order}/edit', [BackendOrderController::class, 'edit'])->name('order.edit')->middleware('permission:change order');
        // Route::put('/{order}', [BackendOrderController::class, 'update'])->name('order.update')->middleware('permission:change order');
        // Route::delete('/{order}', [BackendOrderController::class, 'destroy'])->name('order.destroy')->middleware('permission:delete order');
        Route::get('/{order}', [BackendOrderController::class, 'show'])->name('order.show')->middleware('permission:see order');
        Route::put('/order-status/{order}', [BackendOrderController::class, 'updateStatus'])->name('order.update.status');

        Route::post('/orders/{order}/refund', [BackendOrderController::class, 'refund'])->name('order.refund');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/index', [SettingController::class, 'index'])->name('setting.index')->middleware('permission:see settings');
        Route::put('/updateinformation/{setting}/', [SettingController::class, 'updateInformation'])->name('setting.update.information')->middleware('permission:change settings');
        Route::put('/updatelogo/{setting}/', [SettingController::class, 'updateLogo'])->name('setting.update.logo')->middleware('permission:change settings');
        Route::put('/updatefrontimage/{setting}/', [SettingController::class, 'updateFrontImage'])->name('setting.update.front.image')->middleware('permission:change settings');
    });

    Route::group(['prefix' => 'resources'], function () {
        Route::get('/index', [ResourceController::class, 'index'])->name('resources.index')->middleware('permission:see resource');
        Route::get('/create', [ResourceController::class, 'create'])->name('resources.create')->middleware('permission:add resource');
        Route::post('/store', [ResourceController::class, 'store'])->name('resources.store')->middleware('permission:add resource');
        Route::get('/{resource}/edit', [ResourceController::class, 'edit'])->name('resources.edit')->middleware('permission:change resource');
        Route::put('/{resource}', [ResourceController::class, 'update'])->name('resources.update')->middleware('permission:change resource');
        Route::delete('/{resource}', [ResourceController::class, 'destroy'])->name('resources.destroy')->middleware('permission:delete resource');
    });

    Route::group(['prefix' => 'seo'], function () {
        Route::get('/index', [SeoController::class, 'index'])->name('seo.index')->middleware('permission:see seo');
        Route::get('/create', [SeoController::class, 'create'])->name('seo.create')->middleware('permission:add seo');
        Route::post('/store', [SeoController::class, 'store'])->name('seo.store')->middleware('permission:add seo');
        Route::get('/{seo}/edit', [SeoController::class, 'edit'])->name('seo.edit')->middleware('permission:change seo');
        Route::put('/{seo}', [SeoController::class, 'update'])->name('seo.update')->middleware('permission:change seo');
        Route::delete('/{seo}', [SeoController::class, 'destroy'])->name('seo.destroy')->middleware('permission:delete seo');
    });

    Route::group(['prefix' => 'methodologies'], function () {
        Route::get('/index', [MethodologyController::class, 'index'])->name('methodologies.index')->middleware('permission:see methodology');
        Route::get('/create', [MethodologyController::class, 'create'])->name('methodologies.create')->middleware('permission:add methodology');
        Route::post('/store', [MethodologyController::class, 'store'])->name('methodologies.store')->middleware('permission:add methodology');
        Route::get('/{methodology}/edit', [MethodologyController::class, 'edit'])->name('methodologies.edit')->middleware('permission:change methodology');
        Route::put('/{methodology}', [MethodologyController::class, 'update'])->name('methodologies.update')->middleware('permission:change methodology');
        Route::delete('/{methodology}', [MethodologyController::class, 'destroy'])->name('methodologies.destroy')->middleware('permission:delete methodology');

        Route::delete('/methodologies/{methodology}/documents', [MethodologyController::class, 'deleteDocument'])->name('methodologies.deleteDocument');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/index', [CategoryController::class, 'index'])->name('categories.index')->middleware('permission:see category');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('permission:add category');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store')->middleware('permission:add category');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('permission:change category');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update')->middleware('permission:change category');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('permission:delete category');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('/index', [ProductController::class, 'index'])->name('products.index')->middleware('permission:see product');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create')->middleware('permission:add product');
        Route::post('/store', [ProductController::class, 'store'])->name('products.store')->middleware('permission:add product');
        Route::get('/{slug}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware('permission:change product');
        Route::put('/{slug}', [ProductController::class, 'update'])->name('products.update')->middleware('permission:change product');
        Route::delete('/{slug}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('permission:delete product');

        Route::delete('/products/{product}/documents', [ProductController::class, 'deleteDocument'])->name('products.deleteDocument');
    });

    Route::group(['prefix' => 'qualifications'], function () {
        Route::get('/index', [QualificationController::class, 'index'])->name('qualifications.index')->middleware('permission:see qualification');
        Route::get('/create', [QualificationController::class, 'create'])->name('qualifications.create')->middleware('permission:add qualification');
        Route::post('/store', [QualificationController::class, 'store'])->name('qualifications.store')->middleware('permission:add qualification');
        Route::get('/{qualification}/edit', [QualificationController::class, 'edit'])->name('qualifications.edit')->middleware('permission:change qualification');
        Route::put('/{qualification}', [QualificationController::class, 'update'])->name('qualifications.update')->middleware('permission:change qualification');
        Route::delete('/{qualification}', [QualificationController::class, 'destroy'])->name('qualifications.destroy')->middleware('permission:delete qualification');
    });

    Route::group(['prefix' => 'exams'], function () {
        Route::get('/index', [ExamController::class, 'index'])->name('exams.index')->middleware('permission:see exam');
        Route::get('/create', [ExamController::class, 'create'])->name('exams.create')->middleware('permission:add exam');
        Route::post('/store', [ExamController::class, 'store'])->name('exams.store')->middleware('permission:add exam');
        Route::get('/{exam}/edit', [ExamController::class, 'edit'])->name('exams.edit')->middleware('permission:change exam');
        Route::put('/{exam}', [ExamController::class, 'update'])->name('exams.update')->middleware('permission:change exam');
        Route::delete('/{exam}', [ExamController::class, 'destroy'])->name('exams.destroy')->middleware('permission:delete exam');
    });

    //    Route::group(['prefix' => 'sub-categories'], function () {
    //        Route::get('/index', [SubCategoryController::class, 'index'])->name('sub-categories.index')->middleware('permission:see subcategory');
    //        Route::get('/create', [SubCategoryController::class, 'create'])->name('sub-categories.create')->middleware('permission:add subcategory');
    //        Route::post('/store', [SubCategoryController::class, 'store'])->name('sub-categories.store')->middleware('permission:add subcategory');
    //        Route::get('/{subCategory}/edit', [SubCategoryController::class, 'edit'])->name('sub-categories.edit')->middleware('permission:change subcategory');
    //        Route::put('/{subCategory}', [SubCategoryController::class, 'update'])->name('sub-categories.update')->middleware('permission:change subcategory');
    //        Route::delete('/{subCategory}', [SubCategoryController::class, 'destroy'])->name('sub-categories.destroy')->middleware('permission:delete subcategory');
    //    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/index', [SettingController::class, 'index'])->name('setting.index')->middleware('permission:see settings');
        Route::put('/updateinformation/{setting}/', [SettingController::class, 'updateInformation'])->name('setting.update.information')->middleware('permission:change settings');
        Route::put('/updatelogo/{setting}/', [SettingController::class, 'updateLogo'])->name('setting.update.logo')->middleware('permission:change settings');
        Route::put('/updatefrontimage/{setting}/', [SettingController::class, 'updateFrontImage'])->name('setting.update.front.image')->middleware('permission:change settings');
    });

    Route::group(['prefix' => 'venues'], function () {
        Route::get('/index', [VenueController::class, 'index'])->name('venues.index')->middleware('permission:see venue');
        Route::get('/create', [VenueController::class, 'create'])->name('venues.create')->middleware('permission:add venue');
        Route::post('/store', [VenueController::class, 'store'])->name('venues.store')->middleware('permission:add venue');
        Route::get('/{venue}/edit', [VenueController::class, 'edit'])->name('venues.edit')->middleware('permission:change venue');
        Route::put('/{venue}', [VenueController::class, 'update'])->name('venues.update')->middleware('permission:change venue');
        Route::delete('/{venue}', [VenueController::class, 'destroy'])->name('venues.destroy')->middleware('permission:delete venue');
    });

    // course_tasks
    Route::group(['prefix' => 'course_tasks'], function () {
        Route::get('/index', [CourseTasksController::class, 'index'])->name('course_tasks.index')->middleware('permission:see course_tasks');
        Route::get('/create', [CourseTasksController::class, 'create'])->name('course_tasks.create')->middleware('permission:add course_tasks');
        Route::post('/store', [CourseTasksController::class, 'store'])->name('course_tasks.store')->middleware('permission:add course_tasks');
        Route::get('/{course_tasks}/edit', [CourseTasksController::class, 'edit'])->name('course_tasks.edit')->middleware('permission:change course_tasks');
        Route::put('/{course_tasks}', [CourseTasksController::class, 'update'])->name('course_tasks.update')->middleware('permission:change course_tasks');
        Route::delete('/{course_tasks}', [CourseTasksController::class, 'destroy'])->name('course_tasks.destroy')->middleware('permission:delete course_tasks');
    });

    Route::group(['prefix' => 'awarding_bodies'], function () {
        Route::get('/index', [AwardingBodyController::class, 'index'])->name('awarding_bodies.index')->middleware('permission:see awarding_bodies');
        Route::get('/create', [AwardingBodyController::class, 'create'])->name('awarding_bodies.create')->middleware('permission:add awarding_bodies');
        Route::post('/store', [AwardingBodyController::class, 'store'])->name('awarding_bodies.store')->middleware('permission:add awarding_bodies');
        Route::get('/{awardingBody}/edit', [AwardingBodyController::class, 'edit'])->name('awarding_bodies.edit')->middleware('permission:change awarding_bodies');
        Route::put('/{awardingBody}', [AwardingBodyController::class, 'update'])->name('awarding_bodies.update')->middleware('permission:change awarding_bodies');
        Route::delete('/{awardingBody}', [AwardingBodyController::class, 'destroy'])->name('awarding_bodies.destroy')->middleware('permission:delete awarding_bodies');
    });

    Route::group(['prefix' => 'elearning_licences'], function () {
        Route::get('/index', [LicenceController::class, 'index'])->name('elearning_licences.index')->middleware('permission:see elearning_licences');
        Route::get('/create', [LicenceController::class, 'create'])->name('elearning_licences.create')->middleware('permission:add elearning_licences');
        Route::post('/store', [LicenceController::class, 'store'])->name('elearning_licences.store')->middleware('permission:add elearning_licences');
        Route::get('/{elearningLicence}/edit', [LicenceController::class, 'edit'])->name('elearning_licences.edit')->middleware('permission:change elearning_licences');
        Route::put('/{elearningLicence}', [LicenceController::class, 'update'])->name('elearning_licences.update')->middleware('permission:change elearning_licences');
        Route::delete('/{elearningLicence}', [LicenceController::class, 'destroy'])->name('elearning_licences.destroy')->middleware('permission:delete elearning_licences');
    });

    Route::group(['prefix' => 'cohorts'], function () {
        Route::get('/index', [CohortController::class, 'index'])->name('cohorts.index')->middleware('permission:see cohorts');
        Route::get('/create', [CohortController::class, 'create'])->name('cohorts.create')->middleware('permission:add cohorts');
        Route::post('/store', [CohortController::class, 'store'])->name('cohorts.store')->middleware('permission:add cohorts');
        Route::get('/{cohort}/edit', [CohortController::class, 'edit'])->name('cohorts.edit')->middleware('permission:change cohorts');
        Route::put('/{cohort}', [CohortController::class, 'update'])->name('cohorts.update')->middleware('permission:change cohorts');
        Route::delete('/{cohort}', [CohortController::class, 'destroy'])->name('cohorts.destroy')->middleware('permission:delete cohorts');

        Route::get('/cohorts/{id}/users', [CohortController::class, 'showUsers'])->name('cohorts.users');

        Route::post('/cohorts/send-reminder', [CohortController::class, 'sendReminder'])
            ->name('cohorts.sendReminder');


        Route::post('/task-submissions/approve', [CohortController::class, 'approve'])->name('task-submissions.approve');


        Route::post('/task-submissions/create', [CohortController::class, 'taskCreate'])->name('task-submissions.create');



        Route::post('/cohorts/toggle-status', [CohortController::class, 'toggleStatus'])
            ->name('cohorts.toggle-status');
    });

    Route::group(['prefix' => 'courses'], function () {
        Route::get('/index', [BackendCourseController::class, 'index'])->name('courses.index')->middleware('permission:see course');
        // Route::get('/search', [BackendCourseController::class, 'search'])->name('courses.search')->middleware('permission:see course');
        Route::get('/create', [BackendCourseController::class, 'create'])->name('courses.create')->middleware('permission:add course');
        Route::post('/store', [BackendCourseController::class, 'store'])->name('courses.store')->middleware('permission:add course');
        Route::get('/{id}/edit', [BackendCourseController::class, 'edit'])->name('courses.edit')->middleware('permission:change course');
        Route::put('/{id}', [BackendCourseController::class, 'update'])->name('courses.update')->middleware('permission:change course');
        Route::delete('/{course}', [BackendCourseController::class, 'destroy'])->name('courses.destroy')->middleware('permission:delete course');
        Route::get('/get-subcategories/{category}', [BackendCourseController::class, 'getSubcategories'])->name('courses.getSubcategories')->middleware('permission:add course');
        Route::get('/by-delivery-mode/{deliveryMode}', [BackendCourseController::class, 'getByDeliveryMode'])->name('courses.byDeliveryMode');
    });
    //Route::get('/learner-dashboard', [LearnerDashboardController::class, 'learnerDashboard'])->name('learner.dashboard')->middleware('permission:view learner dashboard');

    /* Start Learner Dashboard */

    Route::get('/learner-dashboard', [LearnerDashboardController::class, 'learnerDashboard'])
        ->name('learner.dashboard')
        ->middleware(['permission:view learner dashboard', 'check.learner.submission']);

    Route::get('/scorm/launch-link/{registrationId}', [LearnerDashboardController::class, 'getLaunchLink']);



    Route::group(['prefix' => 'application-forms'], function () {
        Route::get('/index', [ApplicationFormController::class, 'index'])->name('application-forms.index')->middleware('permission:see application-forms');
        Route::get('/create', [ApplicationFormController::class, 'create'])->name('application-forms.create')->middleware('permission:add application-forms');
        Route::post('/store', [ApplicationFormController::class, 'store'])->name('application-forms.store')->middleware('permission:add application-forms');
        Route::get('/{application_form}/edit', [ApplicationFormController::class, 'edit'])->name('application-forms.edit')->middleware('permission:change application-forms');
        Route::put('/{application_form}', [ApplicationFormController::class, 'update'])->name('application-forms.update')->middleware('permission:change application-forms');
        Route::delete('/{application_form}', [ApplicationFormController::class, 'destroy'])->name('application-forms.destroy')->middleware('permission:delete application-forms');
        Route::post('/preview', [ApplicationFormController::class, 'preview'])->name('application-forms.preview')->middleware('permission:add application-forms');
        Route::post('/update-preview/{id}', [ApplicationFormController::class, 'updatePreview'])->name('application-forms.update-preview')->middleware('permission:edit application-forms');
        // Route::get('/application/pdf/{id}', [ApplicationFormController::class, 'generatePdf'])->name('application.pdf');
        Route::get('/approve/{id}', [ApplicationFormController::class, 'approve'])->name('application-forms.approve');
        Route::post('/reject/{id}', [ApplicationFormController::class, 'reject'])->name('application-forms.reject');
    });

    Route::group(['prefix' => 'profile-photo'], function () {
        Route::get('/index', [ProfilePhotoController::class, 'index'])->name('profile-photo.index')->middleware('permission:see profile photo');
        Route::get('/create', [ProfilePhotoController::class, 'create'])->name('profile-photo.create')->middleware('permission:add profile photo');
        Route::post('/store', [ProfilePhotoController::class, 'store'])->name('profile-photo.store')->middleware('permission:add profile photo');

        Route::get('/{profile_photo}/edit', [ProfilePhotoController::class, 'edit'])->name('profile-photo.edit')->middleware('permission:change profile photo');
        Route::put('/{profile_photo}', [ProfilePhotoController::class, 'update'])->name('profile-photo.update')->middleware('permission:change profile photo');

        Route::post('/upload', [ProfilePhotoController::class, 'upload'])->name('profile-photo.upload')->middleware('permission:add profile photo');

        Route::get('/approve/{id}', [ProfilePhotoController::class, 'approve'])->name('profile.photo.approve');
        Route::post('/reject/{id}', [ProfilePhotoController::class, 'reject'])->name('profile.photo.reject');
    });

    Route::group(['prefix' => 'proof-of-id'], function () {
        Route::get('/index', [DocumentUploadController::class, 'index'])->name('document-uploads.index')->middleware('permission:see document uploads');
        Route::get('/create', [DocumentUploadController::class, 'create'])->name('document-uploads.create')->middleware('permission:add document uploads');
        Route::post('/store', [DocumentUploadController::class, 'store'])->name('document-uploads.store')->middleware('permission:add document uploads');

        Route::get('/{documentUpload}/edit', [DocumentUploadController::class, 'edit'])->name('document-uploads.edit')->middleware('permission:change document uploads');
        Route::put('/{documentUpload}', [DocumentUploadController::class, 'update'])->name('document-uploads.update')->middleware('permission:change document uploads');

        Route::get('/approve/{id}', [DocumentUploadController::class, 'approve'])->name('document-uploads.approve');
        Route::post('/reject/{id}', [DocumentUploadController::class, 'reject'])->name('document-uploads.reject');
    });

    Route::group(['prefix' => 'course-pre-requisites'], function () {
        Route::get('/index', [CoursePreRequisitesController::class, 'index'])->name('course-pre-requisites.index')->middleware('permission:see course-pre-requisites');
        Route::get('/create', [CoursePreRequisitesController::class, 'create'])->name('course-pre-requisites.create')->middleware('permission:add course-pre-requisites');
        Route::post('/store', [CoursePreRequisitesController::class, 'store'])->name('course-pre-requisites.store')->middleware('permission:add course-pre-requisites');

        Route::get('/{preRequisites}/edit', [CoursePreRequisitesController::class, 'edit'])->name('course-pre-requisites.edit')->middleware('permission:change course-pre-requisites');
        Route::put('/{preRequisites}', [CoursePreRequisitesController::class, 'update'])->name('course-pre-requisites.update')->middleware('permission:change course-pre-requisites');

        Route::get('/approve/{id}', [CoursePreRequisitesController::class, 'approve'])->name('course-pre-requisites.approve');
        Route::post('/reject/{id}', [CoursePreRequisitesController::class, 'reject'])->name('course-pre-requisites.reject');
    });

    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/fetch-notifications', [NotificationController::class, 'fetch'])->name('notifications.fetch');
        Route::post('/notifications/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    });


    Route::group(['prefix' => 'tasks'], function () {
        Route::post('/task/submission', [TaskController::class, 'taskSubmission'])->name('task.submission');
        Route::post('/task/preview', [TaskController::class, 'taskFormPreview'])->name('task.preview');
        //Route::get('/task/{id}', [TaskController::class, 'show'])->name('tasks.show');
        Route::get('/task/{id}/{course_id}/{cohort_id}/{trainer_id}', [TaskController::class, 'show'])->name('tasks.show');
        Route::get('/task/{id}/display', [TaskController::class, 'display'])->name('tasks.display');
        Route::post('/task/save-progress', [TaskController::class, 'saveProgress'])->name('tasks.save-progress');
    });

    Route::group(['prefix' => 'messages'], function () {
        Route::get('/index', [MessageController::class, 'index'])->name('messages.index')->middleware('permission:see messages');
        Route::get('/create', [MessageController::class, 'create'])->name('messages.create')->middleware('permission:add messages');
        Route::post('/store', [MessageController::class, 'store'])->name('messages.store')->middleware('permission:add messages');
        Route::get('/sent', [MessageController::class, 'sent'])->name('messages.sent');
        Route::post('reply/{message}', [MessageController::class, 'reply'])->name('messages.reply');
        Route::get('/view/{id}', [MessageController::class, 'viewMessage'])->name('messages.view');
    });

    Route::get('/forms', [FormSubmissionController::class, 'index'])->name('form.index');
    Route::post('/forms/submit', [FormSubmissionController::class, 'submit'])->name('form.submit');
    Route::get('/password/change', [DashboardController::class, 'showChangeForm'])->name('password.change');

    //    Route::group(['prefix' => 'cctv_activity_sheet'], function () {
    //        Route::get('/cctv_activity_sheet', [LearnerDashboardController::class, 'cctvActivitySheet'])->name('cctv_activity_sheet.index')->middleware('permission:see cctv_activity_sheet');;
    //    });

    Route::get('/flipbook/view/{task}', [LearnerDashboardController::class, 'viewFlipbook'])->name('flipbook.view');

    Route::get('/flipbook/view/resource/{resource}', [LearnerDashboardController::class, 'viewResourceFlipbook'])->name('flipbook.resource.view');

    Route::get('/learner/task/submit/{task}', [LearnerDashboardController::class, 'showTaskSubmissionForm'])
        ->name('learner.task.submit');

    Route::post('/learner/task/submit/{task}', [LearnerDashboardController::class, 'submitTask'])
        ->name('learner.task.submit.post');

    Route::get('learner/taskResponse/{submission}', [LearnerDashboardController::class, 'learnerViewTaskSubmission'])->name('view.task.submission');

    // Trainer Dashboard
    Route::get('/trainer-dashboard', [TrainerDashboardController::class, 'index'])->name('trainer.dashboard')->middleware('permission:view trainer dashboard');
    Route::get('/trainer-my-courses', [TrainerDashboardController::class, 'trainerMyCourses'])->name('trainer.my.courses')->middleware('permission:view trainer courses');
    Route::get('/trainer-my-learners', [TrainerDashboardController::class, 'trainerMyLearners'])->name('trainer.my.learners')->middleware('permission:view trainer learners');
    Route::get('/trainer-my-tasks', [TrainerDashboardController::class, 'trainerMyTasks'])->name('trainer.my.tasks')->middleware('permission:view trainer tasks');
    Route::get('review-mark/{user_id}/{task_id}', [TrainerDashboardController::class, 'reviewMark'])->name('review.mark');


    Route::get('/trainer-assessment/{cohort}', [TrainerDashboardController::class, 'riskAssessment'])->name('risk.assessment');
    Route::post('/trainer-risk-assessment', [TrainerDashboardController::class, 'storeRiskAssessment'])->name('risk.assessment.store');




    Route::resource('risk-assessments', RiskAssessmentController::class);



    Route::get('/trainer/filter-learners', [TrainerDashboardController::class, 'trainerMyLearners'])->name('trainer.filterLearners');
    //Route::get('trainer/learner/{cohort}/{learner}', [TrainerDashboardController::class, 'showLearnerDetails'])->name('trainer.learner.details');
    Route::get('/trainer/submission/{user_id}/{task_id}/{cohort_id}', [TrainerDashboardController::class, 'viewTaskSubmission'])->name('trainer.viewSubmission');

    Route::post('trainer/bulk-update', [TrainerDashboardController::class, 'bulkUpdate'])->name('trainer.bulkUpdate');

    Route::post('trainer/taskResponse/{submission}', [TrainerDashboardController::class, 'trainerTaskResponse'])->name('task.response');

    Route::post('trainer/exam-results/', [ExamResultController::class, 'examSubmission'])->name('exam-results.store');
    //Route::post('/exam-results/update', [ExamResultController::class, 'update'])->name('exam-results.update');

    Route::post('/exam-results/fetch-exams', [ExamResultController::class, 'fetchExams'])->name('exam-results.fetch-exams');
    Route::post('/exam-results/bulk-store', [ExamResultController::class, 'bulkStore'])->name('exam-results.bulk-store');


    // web.php
    Route::post('/upload-lesson-plan', [TrainerDashboardController::class, 'uploadLessonPlan'])->name('upload.lesson.plan');
    Route::post('/invoice/upload', [TrainerDashboardController::class, 'uploadInvoice'])->name('invoice.upload');

    // Client Dashboard
    Route::get('/client-dashboard', [ClientController::class, 'index'])->name('client.dashboard')->middleware('permission:view client dashboard');

    Route::group(['prefix' => 'request-forms'], function () {
        Route::get('/index', [\App\Http\Controllers\Backend\RequestFormController::class, 'index'])->name('request-forms.index')->middleware('permission:see request-forms');
    });

    // Subscriber
    Route::group(['prefix' => 'subscribers'], function () {
        Route::get('/', [BackendSubscriberController::class, 'index'])->name('subscribers-forms.index')->middleware('permission:see subscribers');
        Route::get('/export', [BackendSubscriberController::class, 'export'])->name('subscribers.export')->middleware('permission:see subscribers');
    });

    // Subscriber
    Route::group(['prefix' => 'questionnaires'], function () {
        Route::get('/', [QuestionnairesController::class, 'index'])->name('questionnaires-forms.index')->middleware('permission:see questionnaires');
        Route::get('/stats', [QuestionnairesController::class, 'stats'])->name('questionnaires.stats');
    });

    // Lead Forms
    Route::group(['prefix' => 'lead-forms'], function () {
        Route::get('/', [LeadFormController::class, 'index'])->name('lead_form.index')->middleware('permission:see lead_form');
    });


    // Search for users CRuD

    // Route::get('/user/search', [UserController::class, 'search'])->name('users.search')->middleware('permission:see user');
});

Route::get('/backend/user/change-password', [UserController::class, 'showChangePasswordForm'])->name('backend.user.changePassword');
Route::post('/backend/user/change-password', [UserController::class, 'updatePassword'])->name('user.changePassword');

Route::get('/scorm', [ScormController::class, 'main']);

Route::get('clear-cache', function () {
    // Artisan::call('migrate:fresh --seed');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('optimize');
    return back();
})->name('clear-cache');
