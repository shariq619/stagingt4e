<?php

// use App\Http\Controllers\Api\Backend\AssignPermissionController;
// use App\Http\Controllers\Api\Backend\AwardingBodyController;
// use App\Http\Controllers\Api\Backend\CategoryController;
// use App\Http\Controllers\Api\Backend\CourseBundleController;
// use App\Http\Controllers\Api\Backend\MethodologyController;
// use App\Http\Controllers\Api\Backend\PermissionController;
// use App\Http\Controllers\Api\Backend\ProductController;
// use App\Http\Controllers\Api\Backend\QualificationController;
// use App\Http\Controllers\Api\Backend\ResourceController;
// use App\Http\Controllers\Api\Backend\RoleController;
// use App\Http\Controllers\Api\Backend\TestController;
// use App\Http\Controllers\Api\Backend\VenueController;

use App\Http\Controllers\Api\{
    ApplicationFormController,
    DocumentUploadController,
    ProfilePhotosController,
    DashboardController,
    AuthController,
    CoursePreRequisitesController,
    LearnerExamController,
    MessageController,
    ResourceController,
    RoleController,
    TaskController
};

use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/backend/save_task', [TaskController::class, 'store']);
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/email-validate', [AuthController::class, 'emailValidate']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});

Route::prefix('dashboard')->group(function () {
    Route::get('/banner', [DashboardController::class, 'bannerData']);
    Route::get('/categories', [DashboardController::class, 'categoryData']);
    Route::get('/courses', [DashboardController::class, 'courseData']);
});

Route::middleware(['auth:sanctum'])->group(function () {

    // Route::prefix('permissions')->group(function () {
    //     Route::get('/', [PermissionController::class, 'index'])->middleware('permission:look at permissions');
    //     Route::get('/{permission}', [PermissionController::class, 'show'])->middleware('permission:look at permissions');
    //     Route::post('/', [PermissionController::class, 'store'])->middleware('permission:add permissions');
    //     Route::put('/{permission}', [PermissionController::class, 'update'])->middleware('permission:change permissions');
    //     Route::delete('/{permission}', [PermissionController::class, 'destroy'])->middleware('permission:delete permissions');
    // });

    // Route::group(['prefix' => 'assignpermission'], function () {
    //     Route::get('/', [AssignPermissionController::class, 'index'])->middleware('permission:see assign permissions');
    //     Route::get('/{role}', [AssignPermissionController::class, 'editRolePermission'])->middleware('permission:change assign permissions');
    //     Route::post('/updaterolepermission', [AssignPermissionController::class, 'updateRolePermission'])->middleware('permission:change assign permissions');
    // });

    // Route::prefix('courses-bundles')->group(function () {
    //     Route::get('/', [CourseBundleController::class, 'index'])->middleware('permission:see courses-bundle');
    //     Route::get('/{slug}', [CourseBundleController::class, 'show'])->middleware('permission:see courses-bundle');
    //     Route::post('/', [CourseBundleController::class, 'store'])->middleware('permission:add courses-bundle');
    //     Route::put('/{slug}', [CourseBundleController::class, 'update'])->middleware('permission:change courses-bundle');
    //     Route::delete('/{slug}', [CourseBundleController::class, 'destroy'])->middleware('permission:delete courses-bundle');
    // });

    // Route::prefix('categories')->group(function () {
    //     Route::get('/', [CategoryController::class, 'index'])->middleware('permission:see category');
    //     Route::post('/', [CategoryController::class, 'store'])->middleware('permission:add category');
    //     Route::get('/{category}', [CategoryController::class, 'show'])->middleware('permission:see category');
    //     Route::put('/{category}', [CategoryController::class, 'update'])->middleware('permission:change category');
    //     Route::delete('/{category}', [CategoryController::class, 'destroy'])->middleware('permission:delete category');
    // });

    // Route::prefix('venues')->group(function () {
    //     Route::get('/', [VenueController::class, 'index'])->middleware('permission:see venue');
    //     Route::get('/{venue}', [VenueController::class, 'show'])->middleware('permission:see venue');
    //     Route::post('/', [VenueController::class, 'store'])->middleware('permission:add venue');
    //     Route::put('/{venue}', [VenueController::class, 'update'])->middleware('permission:change venue');
    //     Route::delete('/{venue}', [VenueController::class, 'destroy'])->middleware('permission:delete venue');
    // });

    //    Route::prefix('resources')->group(function () {
    //        Route::get('/', [ResourceController::class, 'index'])->middleware('permission:see resource');
    //        Route::get('/{id}', [ResourceController::class, 'show'])->middleware('permission:see resource');
    //        Route::post('/', [ResourceController::class, 'store'])->middleware('permission:add resource');
    //        Route::put('/{id}', [ResourceController::class, 'update'])->middleware('permission:change resource');
    //        Route::delete('/{id}', [ResourceController::class, 'destroy'])->middleware('permission:delete resource');
    //    });

    // Route::prefix('awarding_bodies')->group(function () {
    //     Route::get('/', [AwardingBodyController::class, 'index'])->middleware('permission:see awarding_bodies');
    //     Route::get('/{id}', [AwardingBodyController::class, 'show'])->middleware('permission:see awarding_bodies');
    //     Route::post('/', [AwardingBodyController::class, 'store'])->middleware('permission:add awarding_bodies');
    //     Route::put('/{id}', [AwardingBodyController::class, 'update'])->middleware('permission:change awarding_bodies');
    //     Route::delete('/{id}', [AwardingBodyController::class, 'destroy'])->middleware('permission:delete awarding_bodies');
    // });

    // Route::prefix('products')->group(function () {
    //     Route::get('/', [ProductController::class, 'index'])->middleware('permission:see product');
    //     Route::get('/{slug}', [ProductController::class, 'show'])->middleware('permission:change product');
    //     Route::post('/', [ProductController::class, 'store'])->middleware('permission:add product');
    //     Route::put('/{slug}', [ProductController::class, 'update'])->middleware('permission:change product');
    //     Route::delete('/{slug}', [ProductController::class, 'destroy'])->middleware('permission:delete product');
    //     Route::delete('/products/{product}/documents', [ProductController::class, 'deleteDocument'])->name('products.deleteDocument');
    // });

    // Route::prefix('qualifications')->group(function () {
    //     Route::get('/', [QualificationController::class, 'index'])->middleware('permission:see qualification');
    //     Route::get('/{id}', [QualificationController::class, 'show'])->middleware('permission:see qualification');
    //     Route::post('/', [QualificationController::class, 'store'])->middleware('permission:add qualification');
    //     Route::put('/{id}', [QualificationController::class, 'update'])->middleware('permission:change qualification');
    //     Route::delete('/{id}', [QualificationController::class, 'destroy'])->middleware('permission:delete qualification');
    // });

    // Route::prefix('methodologies')->group(function () {
    //     Route::get('/', [MethodologyController::class, 'index'])->middleware('permission:see methodology');
    //     Route::get('/{methodology}', [MethodologyController::class, 'show'])->middleware('permission:see methodology');
    //     Route::post('/', [MethodologyController::class, 'store'])->middleware('permission:add methodology');
    //     Route::put('/{methodology}', [MethodologyController::class, 'update'])->middleware('permission:change methodology');
    //     Route::delete('/{methodology}', [MethodologyController::class, 'destroy'])->middleware('permission:delete methodology');
    //     Route::delete('/{methodology}/documents', [MethodologyController::class, 'deleteDocument'])->middleware('permission:delete methodology');
    // });

    // Route::prefix('roles')->group(function () {
    //     Route::get('/', [RoleController::class, 'index']);
    // });

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/auth/change-password', [AuthController::class, 'changePassword']);

    Route::prefix('application-forms')->group(function () {
        Route::get('/', [ApplicationFormController::class, 'index'])->middleware('permission:see application-form');
        Route::get('/hear-about-it', [ApplicationFormController::class, 'hearAboutIt'])->middleware('permission:see application-form');
        Route::post('/', [ApplicationFormController::class, 'store'])->middleware('permission:add application-forms');
        Route::put('/{id}', [ApplicationFormController::class, 'update'])->name('application-forms.update')->middleware('permission:change application-forms');
    });


    Route::prefix('document-uploads')->group(function () {
        Route::get('/document/config', [DocumentUploadController::class, 'documentConfig']);
        Route::post('/group-a', [DocumentUploadController::class, 'storeGroupA']);
        Route::post('/group-b', [DocumentUploadController::class, 'storeGroupB']);
        Route::put('/{id}', [DocumentUploadController::class, 'update']);
    });

    Route::prefix('profile-photos')->group(function () {
        Route::post('/', [ProfilePhotosController::class, 'store']);
        Route::put('/{id}', [ProfilePhotosController::class, 'update']);
    });

    Route::prefix('task')->group(function () {
        Route::post('/learner/submission', [TaskController::class, 'submitTask']);
        Route::get('/english-assessment', [TaskController::class, 'EnglishAssessmentController']);
        Route::get('/learner-tasks', [TaskController::class, 'getAllLearnerTasks']);
        Route::get('/ds-refresher-workbook', [TaskController::class, 'ds_refresher_workbook']);
        Route::get('/ds-refresher-workbook-2', [TaskController::class, 'ds_refresher_workbook_two']);
        Route::get('/sg-refresher-questions', [TaskController::class, 'sg_refresher_questions']);
        Route::get('/cctv-activity-questions', [TaskController::class, 'cctv_activity_questions']);
        Route::get('/ds-activity-sheet', [TaskController::class, 'door_supervisor_activity_section']);
        Route::get('/pi-health-questionnaire', [TaskController::class, 'pi_ealth_questionnaire']);
    });

    Route::prefix('messages')->group(function () {
        Route::get('/inbox', [MessageController::class, 'inbox']);
        Route::get('/sent', [MessageController::class, 'sent']);
        Route::post('/', [MessageController::class, 'store']);
    });

    Route::prefix('exams')->group(function () {
        Route::get('/exam-result', [LearnerExamController::class, 'examsResult']);
    });

    Route::post('/course-prerequisites', [CoursePreRequisitesController::class, 'store']);
    Route::post('/course-prerequisites/skip', [CoursePreRequisitesController::class, 'skipCertification']);

    Route::get('/resources', [ResourceController::class, 'getFlipbookResources']);
    Route::get('/dashboard/admins', [DashboardController::class, 'getAdmins']);
});
