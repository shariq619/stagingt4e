<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRM\DashboardController;
use App\Http\Controllers\CRM\TrainingCoursesController;
use App\Http\Controllers\CRM\LearnerDelegatesController;
use App\Http\Controllers\CRM\CustomerController;
use App\Http\Controllers\CRM\ProductInvoicesController;
use App\Http\Controllers\CRM\ProductInvoicePaymentsController;
use App\Http\Controllers\CRM\LookupController;
use App\Http\Controllers\CRM\CrmStripeController;
use App\Http\Controllers\CRM\AuditController;
use App\Http\Controllers\CRM\CohortMiscController;
use App\Http\Controllers\CRM\EmailAdminController;
use App\Http\Controllers\CRM\InvoicePDFController;
use App\Http\Controllers\CRM\UserPostQualificationController;
use App\Http\Controllers\CRM\LeadController;
use App\Http\Controllers\CRM\CustomersController;
use App\Http\Controllers\CRM\NewsletterController;
use App\Http\Controllers\CRM\NewsletterCampaignController;
use App\Http\Controllers\CRM\EmailUtilityController;
use App\Http\Controllers\CRM\ErrorPageController;
use App\Services\ImapReplySyncService;

Route::group(['prefix' => 'crm', 'as' => 'crm.', 'middleware' => ['auth']], function () {

    Route::fallback([ErrorPageController::class, 'notFound'])
        ->name('fallback');

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard.index');
    });


    Route::get('emails/sync-replies', function (ImapReplySyncService $service) {
        $service->syncAll();
        return response()->json(['status' => 'ok']);
    })->name('emails.sync-replies');

    Route::prefix('training-courses')->name('training-courses.')->controller(TrainingCoursesController::class)->group(function () {
        Route::post('bulk-update-learner-status/{cohort}', 'bulkUpdateLearnerStatus')->name('bulk_update_learner_status');
        Route::get('find-user', 'findUser')->name('find-user');
        Route::get('{cohort_id}/{order_detail_id}/{id}/pdf', 'generatePdf');
        Route::match(['GET','POST'], 'generate-checklist/{cohort}/{type?}/{user?}', 'generateChecklist')
            ->where([
                'type' => '(efaw|security|register|joining-instructions|vb-certificate)',
                'user' => '[0-9]+'
            ])
            ->name('generate-checklist');
        Route::get('/certificate', 'generateCertificate');
        Route::post('add-user-to-cohort', 'addUserToCohort')->name('add-user-to-cohort');
        Route::put('update-trainers', 'updateTrainers')->name('update_trainers');
        Route::post('save-note', 'saveNote')->name('save-note');
        Route::post('generate-invoice', 'generateInvoice')->name('generate-invoice');
        Route::get('invoice-preview', 'invoicePreview')->name('invoice-preview');
        Route::get('{id}/json', 'json')->name('json');
        Route::get('{id}/learners', 'learners')->name('learners');
        Route::get('{cohort}/invoice/{user}/{detail}', 'openOrCreateInvoice')->name('open-invoice');
        Route::get('dt', 'trainingCoursesDatatables')->name('dt');
        Route::get('search-cohorts', 'searchCohorts');
        Route::post('/reassignCohort', 'reassignCohort');
        Route::get('/getCurrentInvoiceCohort/{invoice_id}', 'getCurrentInvoiceCohort');
        Route::get('/{cohort}/profit-data', 'profitData')->name('profit-data');
        Route::post('/verify-password', 'verify')->name('verify.password');
        Route::post('{cohort}/copy', 'copy')->name('copy');
        Route::post('update-status', 'updateStatus')->name('update-status');
        Route::post('bulk-update-learner-course-status/{cohort}', 'bulkUpdateLearnerCourseStatus')
            ->name('bulk_update_learner_course_status');
    });

    Route::post('/invoices/pdf-bulk', [InvoicePDFController::class, 'selected'])
        ->name('invoices.bulk');

    Route::get('/training-courses/{cohort}/invoice-pdf', [InvoicePDFController::class, 'cohortPdf'])
        ->name('training-courses.invoice-pdf');

    Route::post('/invoices/pdf-by-ids', [InvoicePDFController::class, 'selectedByInvoices'])
        ->name('invoices.bulk.by-invoices');

    Route::post('/{customer}/statement-pdf', [InvoicePDFController::class, 'customerStatement'])
        ->name('customers.statement.pdf');



    Route::prefix('training-courses')->name('training-courses.')->group(function () {
        Route::get('{cohort}/audit/dt', [AuditController::class, 'cohortDt'])
            ->name('audit.dt');
    });

    Route::post('/qualifications/post', [UserPostQualificationController::class, 'store'])->name('qualifications.post');

    Route::resource('training-courses', TrainingCoursesController::class);

    Route::prefix('learner-delegates')
        ->name('learner.delegates.')
        ->controller(LearnerDelegatesController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('dt', 'datatables')->name('dt');
            Route::get('quick', 'quick')->name('quick');

            Route::get('create/{customer}', 'create')->name('create');

            Route::get('{id}/courses/dt', 'coursesDt')->name('courses.dt');
            Route::get('{id}/correspondence/dt', 'correspondenceDt')->name('correspondence.dt');

            Route::get('{id}/correspondence/{send}', 'showCorrespondence')->name('correspondence.show');
            Route::get('{delegate}/correspondence/{send}/thread', 'threadJson')->name('correspondence.thread');

            Route::get('{id}/detail', 'show')->name('show');
                    Route::get('{id}/detail/json', 'showJson')->name('show.json');
            Route::match(['PUT','POST'], '{id}/detail', 'updateOrStore')->name('update');
            Route::post('{id}/email', 'sendEmail')->name('email.send');
            Route::post('check-unique', 'checkUnique')->name('check-unique');
        });


    Route::prefix('customers')
        ->name('customers.')
        ->controller(CustomersController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('dt', 'datatables')->name('dt');
            Route::get('quick', 'quick')->name('quick');

            Route::get('{id}/detail', 'show')->name('show');
            Route::put('{id}/detail', 'updateOrStore')->name('update');
            Route::post('{id}/email', 'sendEmail')->name('email.send');

            Route::get('{id}/delegates/dt', 'customerDelegatesDt')->name('delegates.dt');
            Route::get('{id}/detail/json', 'showJson')->name('show.json');

            Route::get('financial/{id}/json', 'financialsJson')->name('financials.json');
            Route::get('invoices/payments', 'invoicePaymentsJson')->name('invoices.payments.json');

        });

    Route::get('/customers/audit/user/{user}', [AuditController::class, 'userDt'])->name('users.audit.dt');


    Route::prefix('invoices')->name('invoices.')->controller(ProductInvoicesController::class)->group(function () {
        Route::get('{invoice}', 'show')->name('show');
        Route::get('{invoice}/json', 'json')->name('json');
        Route::put('{invoice}', 'updateHeader')->name('update');
    });

    Route::prefix('invoice-lines')->name('invoice-lines.')->controller(ProductInvoicesController::class)->group(function () {
        Route::put('{line}', 'updateLine')->name('update');
        Route::delete('{line}', 'destroyLine')->name('destroy');
    });

    Route::prefix('invoices/{invoice}/payments')->name('payments.')->controller(ProductInvoicePaymentsController::class)->group(function () {
        Route::get('/', 'json')->name('json');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
    });

    Route::prefix('invoice-payments')->name('payments.')->controller(ProductInvoicePaymentsController::class)->group(function () {
        Route::get('validate-ref', 'validateRef')->name('validateRef');
        Route::put('{payment}', 'update')->name('update');
        Route::patch('{payment}', 'update');
        Route::delete('{payment}', 'destroy')->name('destroy');
    });

    Route::prefix('payments')->controller(ProductInvoicePaymentsController::class)->group(function () {
        Route::get('{id}', 'receipt')->name('payments.receipt');
    });

    Route::prefix('lookups')->name('lookups.')->controller(LookupController::class)->group(function () {
        Route::get('{type}', 'index')->where('type', 'nominal-codes|project-codes|sources|departments')->name('select');
    });

    Route::prefix('invoices/{invoice}/stripe')->name('stripe.')->controller(CrmStripeController::class)->group(function (){
        Route::post('intent', 'intent')->name('intent');
        Route::post('allocate', 'allocate')->name('allocate');
        Route::post('refund', 'refund')->name('refund');
    });

    Route::get('stripe/balance', [CrmStripeController::class,'balance'])->name('stripe.balance');


    Route::prefix('training-courses')->name('training-courses.')->group(function () {
        Route::prefix('cohorts/{cohort}/misc')
            ->name('cohorts.misc.')
            ->controller(CohortMiscController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/dt', 'dt')->name('dt');
                Route::post('/', 'store')->name('store');
                Route::put('/exclude', 'toggleExclude')->name('toggle-exclude');
                Route::put('/{misc}', 'update')->whereNumber('misc')->name('update');
                Route::delete('/{misc}', 'destroy')->whereNumber('misc')->name('destroy');
            });
    });


    Route::prefix('email')->name('email.')->controller(EmailAdminController::class)->group(function () {
        Route::get('/', 'index')->name('index');

        Route::get('/triggers', 'triggers')->name('triggers.index');
        Route::post('/triggers', 'storeTrigger')->name('triggers.store');
        Route::delete('/triggers/{id}', 'destroyTrigger')->name('triggers.destroy');

        Route::get('/templates', 'templates')->name('templates.index');
        Route::post('/templates', 'storeTemplate')->name('templates.store');
        Route::post('/templates/draft', 'storeDraft')->name('templates.store-draft');
        Route::put('/templates/{id}', 'updateTemplate')->name('templates.update');
        Route::delete('/templates/{id}', 'destroyTemplate')->name('templates.destroy');
        Route::post('/templates/{id}/publish', 'publishDraft')->name('templates.publish');

        Route::get('/templates/{templateId}', 'showTemplate')->name('templates.show');
        Route::get('/templates/{templateId}/composer', 'composer')->name('templates.composer');
        Route::post('/templates/{templateId}/send-test', 'sendTest')->name('templates.send-test');

        Route::post('/templates/upload-asset', 'uploadAsset')->name('templates.upload-asset');

        Route::get('/mappings', 'mappings')->name('mappings.index');
        Route::post('/mappings', 'storeMapping')->name('mappings.store');
        Route::delete('/mappings/{id}', 'destroyMapping')->name('mappings.destroy');

        Route::get('/lookups/learner-statuses', 'learnerStatuses')->name('lookups.learner-statuses');
        Route::get('/lookups/trigger-keys', 'triggerKeyOptions')->name('lookups.trigger-keys');
        Route::get('/lookups/variables', 'templateVariables')->name('lookups.variables');
    });

    Route::prefix('leads')->name('leads.')->controller(LeadController::class)->group(function () {
        Route::get('/','index')->name('index');
        Route::get('/dt','dt')->name('dt');
        Route::post('/','store')->name('store');
        Route::get('/{lead}','show')->name('show');
        Route::put('/{lead}','update')->name('update');
        Route::delete('/{lead}','destroy')->name('destroy');
        Route::post('/{lead}/check-enrollment','checkEnrollment')->name('check');
        Route::post('/sync-enrollment','bulkSyncEnrollment')->name('sync');
        Route::post('/{lead}/status','updateStatus')->name('status.update');
        Route::post('/status/bulk','bulkUpdateStatus')->name('status.bulk');
        Route::post('/{lead}/auto-status','autoStatus')->name('status.auto');
        Route::post('/auto-status/bulk','autoStatusBulk')->name('status.auto-bulk');
        Route::post('/email/bulk','bulkSendEmail')->name('email.bulk');
    });

    Route::prefix('newsletters')->name('newsletters.')->controller(NewsletterController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/list', 'list')->name('list');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::put('/{newsletter}', 'update')->name('update');
        Route::delete('/{newsletter}', 'destroy')->name('destroy');
        Route::get('/{newsletter}/composer', 'composer')->name('composer');
        Route::get('/{newsletter}/json', 'show')->name('show');
    });

    Route::prefix('newsletter-campaigns')
        ->name('newsletters.campaigns.')
        ->controller(NewsletterCampaignController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/list', 'list')->name('list');
            Route::post('/build', 'build')->name('build');
            Route::post('/{campaign}/send', 'send')->name('send');
            Route::delete('/{campaign}', 'destroy')->name('destroy');

            Route::get('/datasources/dictionary', 'datasourceDict')->name('dict');
            Route::get('/datasources/select', 'datasourceSelect')->name('select');
            Route::get('/datasources/table', 'datasourceTable')->name('table');

            Route::get('/datasources/contacts', 'datasourceContacts')->name('datasource.contacts');

            Route::post('/{newsletter}/send-test', 'sendTest')->name('send_test');
            Route::get('/{campaign}/recipients', 'recipients')->name('recipients');
        });


    Route::prefix('email')->name('email.')->controller(EmailUtilityController::class)->group(function () {
        Route::post('/templates/upload-asset', 'uploadAsset')->name('templates.upload-asset');
        Route::post('/preview/{newsletter}', 'previewRender')->name('preview');
    });
});
