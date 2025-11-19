<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetApplicationFormRequest;
use App\Http\Requests\Api\StoreApplicationFormRequest;
use App\Http\Requests\Api\UpdateApplicationFormRequest;
use App\Http\Resources\ApplicationFormCreateResource;
use App\Http\Resources\ApplicationFormResource;
use App\Models\ApplicationForm;
use App\Services\PdfGenerationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Tag(
 *     name="Application Forms",
 *     description="API Endpoints for Application Forms Management"
 * )
 */

class ApplicationFormController extends Controller
{
    protected $pdfService;

    public function __construct(PdfGenerationService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    /**
     * @OA\Get(
     *     path="/api/application-forms",
     *     summary="Get list of application forms",
     *     description="Retrieve paginated list of application forms",
     *     tags={"Application Forms"},
     *     security={{"bearerAuth":{}}},
     *     
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page (default: 10, max: 100)",
     *         required=false,
     *         @OA\Schema(type="integer", minimum=1, maximum=100, example=10)
     *     ),
     *     
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer", minimum=1, example=1)
     *     ),
     *     
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Application forms fetched successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="learner_id", type="integer", example=123),
     *                     @OA\Property(property="is_valid_form", type="boolean", example=true),
     *                     @OA\Property(property="father_name", type="string", example="Michael"),
     *                     @OA\Property(property="middle_name", type="string", example="Robert", nullable=true),
     *                     @OA\Property(property="last_name", type="string", example="Doe"),
     *                     @OA\Property(property="birth_date", type="string", example="1990-01-15"),
     *                     @OA\Property(property="address", type="string", example="123 Main Street"),
     *                     @OA\Property(property="nationality", type="string", example="British"),
     *                     @OA\Property(property="email", type="string", example="john.doe@email.com"),
     *                     @OA\Property(property="post_code", type="string", example="SW1A 1AA"),
     *                     @OA\Property(property="phone_number", type="string", example="+441234567890", nullable=true),
     *                     @OA\Property(property="telephone", type="string", example="0123456789", nullable=true),
     *                     @OA\Property(property="status", type="string", example="Approved"),
     *                     @OA\Property(property="learner_pdf", type="string", example="http://example.com/storage/forms/1.pdf", nullable=true),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2023-01-15T10:30:00Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2023-01-15T10:30:00Z")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="per_page", type="integer", example=10),
     *                 @OA\Property(property="total", type="integer", example=100),
     *                 @OA\Property(property="last_page", type="integer", example=10)
     *             )
     *         )
     *     ),
     *     
     *     @OA\Response(
     *         response=404,
     *         description="No forms found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=404),
     *             @OA\Property(property="message", type="string", example="No application forms found")
     *         )
     *     ),
     *     
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=500),
     *             @OA\Property(property="message", type="string", example="Error fetching application forms")
     *         )
     *     )
     * )
     */

    public function index(GetApplicationFormRequest $request)
    {
        try {
            $query = ApplicationForm::query();

            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            // Pagination
            $perPage = $request->per_page ?? 10;
            $applicationForms = $query->orderBy('created_at', 'desc')
                ->paginate($perPage);

            if ($applicationForms->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'No application forms found',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Application forms fetched successfully',
                'data' => ApplicationFormResource::collection($applicationForms),
                'meta' => [
                    'current_page' => $applicationForms->currentPage(),
                    'per_page' => $applicationForms->perPage(),
                    'total' => $applicationForms->total(),
                    'last_page' => $applicationForms->lastPage(),
                ]
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Internal server error' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/application-forms/hear-about-it",
     *     summary="Get Hear About It options",
     *     description="Retrieve list of options for how applicants heard about the service",
     *     tags={"Application Forms"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Hear about it options fetched successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="1", type="string", example="Social Media (Facebook, Instagram, LinkedIn, X, TikTok, YouTube, etc.)"),
     *                 @OA\Property(property="2", type="string", example="Search Engine (Google, Yahoo, etc)"),
     *                 @OA\Property(property="3", type="string", example="Paid Google Advertisement"),
     *                 @OA\Property(property="4", type="string", example="Paid Bing Advertisement"),
     *                 @OA\Property(property="5", type="string", example="Word of Mouth"),
     *                 @OA\Property(property="6", type="string", example="Email"),
     *                 @OA\Property(property="7", type="string", example="Referred by a Trainer"),
     *                 @OA\Property(property="8", type="string", example="Referred by a Friend"),
     *                 @OA\Property(property="9", type="string", example="Third Party (Hurak, Get Licenced, etc)"),
     *                 @OA\Property(property="10", type="string", example="Other")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=500),
     *             @OA\Property(property="message", type="string", example="Error fetching hear about it options")
     *         )
     *     )
     * )
     */

    public function hearAboutIt()
    {
        try {
            $data = config('settings.hear_about_us_data');

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Hear about it options fetched successfully',
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Internal server error' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/application-forms",
     *     summary="Create a new application form with PDF generation",
     *     description="Store application form data and generate PDF similar to web controller",
     *     tags={"Application Forms"},
     *     security={{"bearerAuth":{}}},
     *     
     *     @OA\RequestBody(
     *         required=true,
     *         description="Application form data",
     *         @OA\JsonContent(
     *             required={"learner_id", "is_valid_form", "father_name", "last_name", "birth_date", "address", "nationality", "email", "post_code", "phone_number", "name", "contact_num", "term", "hear_about", "guideline1", "guideline2", "guideline3"},
     *        @OA\Property(property="learner_id", type="integer", example="123"),
     *         @OA\Property(property="is_valid_form", type="integer", example="1", description="Must be 1 to indicate a valid form"),
     *         @OA\Property(property="father_name", type="string", example="Michael"),
     *         @OA\Property(property="middle_name", type="string", example="Robert"),
     *         @OA\Property(property="last_name", type="string", example="Doe"),
     *         @OA\Property(property="birth_date", type="string", format="date", example="1990-01-15"),
     *         @OA\Property(property="address", type="string", example="123 Main Street, London"),
     *         @OA\Property(property="nationality", type="string", example="British"),
     *         @OA\Property(property="email", type="string", format="email", example="john.doe@email.com"),
     *         @OA\Property(property="post_code", type="string", example="SW1A 1AA"),
     *         @OA\Property(property="phone_number", type="string", example="+441234567890"),
     *         @OA\Property(property="telephone", type="string", example="0123456789"),
     *         @OA\Property(property="name", type="string", example="Jane Smith"),
     *         @OA\Property(property="contact_num", type="string", example="+441234567891"),
     *         @OA\Property(property="relationship_to_you", type="string", example="Friend"),
     *         @OA\Property(property="company", type="string", example="ABC Corporation"),
     *         @OA\Property(property="emp_contact_name", type="string", example="HR Department"),
     *         @OA\Property(property="emp_contact_num", type="string", example="+441234567892"),
     *         @OA\Property(property="emp_company_address", type="string", example="456 Business Ave, London"),
     *         @OA\Property(property="emp_post_code", type="string", example="EC1A 1BB"),
     *         @OA\Property(property="levy_number", type="string", example="LEVY123456"),
     *         @OA\Property(property="hear_about", type="string", example="start 1 to 10 based on options"),
     *         @OA\Property(property="guideline1", type="boolean", example=true, description="Must be true to accept guideline 1"),
     *         @OA\Property(property="guideline2", type="boolean", example=true, description="Must be true to accept guideline 2"),
     *         @OA\Property(property="guideline3", type="boolean", example=true, description="Must be true to accept guideline 3"),
     *         @OA\Property(property="term", type="boolean", example=true, description="Must be true to accept terms and conditions"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Form submitted successfully"),
     *             @OA\Property(property="pdfPath", type="string", example="http://example.com/storage/learners/John_Doe/application_form/John_application_form.pdf"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="status", type="string", example="In Progress"),
     *                 @OA\Property(property="pdf_path", type="string", example="http://example.com/storage/learners/John_Doe/application_form/John_application_form.pdf")
     *             )
     *         )
     *     )
     * )
     */

    public function store(StoreApplicationFormRequest $request)
    {
        try {
            $user = Auth::user();
            if ($request->learner_id != $user->id) {
                return response()->json([
                    'status' => 'error',
                    'code' => 403,
                    'message' => 'Learner ID mismatch. You are not authorized to submit this form.'
                ], 403);
            }
            $existingForm = ApplicationForm::where('learner_id', $user->id)
                ->where('status', 'In Progress')
                ->first();
            if ($existingForm) {
                return response()->json([
                    'status' => 'error',
                    'code' => 422,
                    'message' => 'You already have an application form in progress',
                    'data' => [
                        'existing_form_id' => $existingForm->id,
                        'status' => $existingForm->status,
                        'submitted_at' => $existingForm->created_at
                    ]
                ], 422);
            }
            $validatedData = $request->validated();

            $formData = array_merge($validatedData, [
                'term' => 1,
                'guideline1' => 1,
                'guideline2' => 1,
                'guideline3' => 1,
            ]);

            $formData['email'] = $user->email;

            $pdfPath = $this->pdfService->generateApplicationFormPdf($formData, $user);

            $applicationForm = ApplicationForm::create([
                'learner_id' => $user->id,
                'name' => $request->name,
                'is_valid_form' => 1,
                'status' => "In Progress",
                'learner_pdf' => $pdfPath,
                ...$formData
            ]);
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Form submitted successfully',
                'data' => new ApplicationFormCreateResource($applicationForm)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Error submitting form',
                'error' => 'Internal server error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/application-forms/{id}",
     *     summary="Update an existing application form with PDF regeneration",
     *     description="Update application form data and regenerate PDF if needed",
     *     tags={"Application Forms"},
     *     security={{"bearerAuth":{}}},
     *     
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Application Form ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     
     *     @OA\RequestBody(
     *         required=true,
     *         description="Application form data to update",
     *         @OA\JsonContent(
     *             required={"learner_id", "is_valid_form", "father_name", "last_name", "birth_date", "address", "nationality", "email", "post_code", "phone_number", "name", "contact_num", "term", "hear_about", "guideline1", "guideline2", "guideline3"},
     *             @OA\Property(property="learner_id", type="integer", example="123"),
     *             @OA\Property(property="is_valid_form", type="integer", example="1"),
     *             @OA\Property(property="father_name", type="string", example="Michael Updated"),
     *             @OA\Property(property="middle_name", type="string", example="Robert"),
     *             @OA\Property(property="last_name", type="string", example="Doe Updated"),
     *             @OA\Property(property="birth_date", type="string", format="date", example="1990-01-15"),
     *             @OA\Property(property="address", type="string", example="123 Main Street, London Updated"),
     *             @OA\Property(property="nationality", type="string", example="British"),
     *             @OA\Property(property="post_code", type="string", example="SW1A 1AA"),
     *             @OA\Property(property="phone_number", type="string", example="+441234567890"),
     *             @OA\Property(property="telephone", type="string", example="0123456789"),
     *             @OA\Property(property="name", type="string", example="Jane Smith Updated"),
     *             @OA\Property(property="contact_num", type="string", example="+441234567891"),
     *             @OA\Property(property="relationship_to_you", type="string", example="Friend"),
     *             @OA\Property(property="company", type="string", example="ABC Corporation Updated"),
     *             @OA\Property(property="emp_contact_name", type="string", example="HR Department"),
     *             @OA\Property(property="emp_contact_num", type="string", example="+441234567892"),
     *             @OA\Property(property="emp_company_address", type="string", example="456 Business Ave, London Updated"),
     *             @OA\Property(property="emp_post_code", type="string", example="EC1A 1BB"),
     *             @OA\Property(property="levy_number", type="string", example="LEVY123456"),
     *             @OA\Property(property="status", type="string", example="Approved"),
     *             @OA\Property(property="comments", type="string", example="Application approved after review"),
     *             @OA\Property(property="hear_about", type="string", example="start 1 to 10 based on options"),
     *             @OA\Property(property="guideline1", type="boolean", example=true, description="Must be true to accept guideline 1"),
     *             @OA\Property(property="guideline2", type="boolean", example=true, description="Must be true to accept guideline 2"),
     *             @OA\Property(property="guideline3", type="boolean", example=true, description="Must be true to accept guideline 3"),
     *             @OA\Property(property="term", type="boolean", example=true, description="Must be true to accept terms and conditions"),
     *         )
     *     ),
     *     
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Form updated successfully"),
     *             @OA\Property(property="pdfPath", type="string", example="http://example.com/storage/learners/John_Doe/application_form/John_application_form_updated.pdf"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="status", type="string", example="Approved"),
     *                 @OA\Property(property="pdf_path", type="string", example="http://example.com/storage/learners/John_Doe/application_form/John_application_form_updated.pdf")
     *             )
     *         )
     *     ),
     *     
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden - Learner ID mismatch",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=403),
     *             @OA\Property(property="message", type="string", example="Learner ID mismatch. You are not authorized to update this form.")
     *         )
     *     ),
     *     
     *     @OA\Response(
     *         response=404,
     *         description="Form not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=404),
     *             @OA\Property(property="message", type="string", example="Application form not found")
     *         )
     *     )
     * )
     */

    public function update(UpdateApplicationFormRequest $request, $id)
    {
        try {
            $user = Auth::user();
            $applicationForm = ApplicationForm::findOrFail($id);
            if ($applicationForm->status === 'In Progress') {
                return response()->json([
                    'status' => 'error',
                    'code' => 422,
                    'message' => 'Form cannot be updated because it is already In Progress.',
                    'current_status' => $applicationForm->status
                ], 422);
            }

            if ($applicationForm->learner_id != $user->id) {
                return response()->json([
                    'status' => 'error',
                    'code' => 403,
                    'message' => 'Learner ID mismatch. You are not authorized to update this form.'
                ], 403);
            }

            if ($request->has('email') && $request->email !== $user->email) {
                return response()->json([
                    'status' => 'error',
                    'code' => 422,
                    'message' => 'Email cannot be changed. Your registered email will be used automatically.',
                    'current_email' => $user->email
                ], 422);
            }

            $validatedData = $request->validated();

            if (isset($validatedData['email'])) {
                unset($validatedData['email']);
            }

            if (isset($validatedData['status'])) {
                unset($validatedData['status']);
            }

            $formData = array_merge($validatedData, [
                'term' => $request->term ?? $applicationForm->term,
                'guideline1' => $request->guideline1 ?? $applicationForm->guideline1,
                'guideline2' => $request->guideline2 ?? $applicationForm->guideline2,
                'guideline3' => $request->guideline3 ?? $applicationForm->guideline3,
                'email' => $user->email,
            ]);

            $pdfPath = $applicationForm->learner_pdf;
            $importantFields = ['father_name', 'last_name', 'birth_date', 'address', 'nationality'];
            $needsPdfUpdate = collect($importantFields)->some(function ($field) use ($request, $applicationForm) {
                return $request->has($field) && $request->$field != $applicationForm->$field;
            });

            if ($needsPdfUpdate) {
                $pdfPath = $this->pdfService->generateApplicationFormPdf($formData, $user);
            }

            $updateData = array_merge($validatedData, [
                'learner_pdf' => $pdfPath,
                'email' => $user->email,
                'status'      => 'In Progress',
            ]);

            $applicationForm->update($updateData);
            $applicationForm->refresh();

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Form updated successfully',
                'learner_pdf' => $pdfPath ? asset('storage/' . $pdfPath) : null,
                'data' => new ApplicationFormCreateResource($applicationForm)
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Application form not found', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'Application form not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error updating application form', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Error updating form',
                'error' => 'Internal server error: ' . $e->getMessage()
            ], 500);
        }
    }
}
