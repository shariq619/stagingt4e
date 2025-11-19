<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DocumentUploadStore;
use App\Http\Requests\Api\UpdateDocumentUploadRequest;
use App\Http\Resources\DocumentUploadResource;
use App\Models\DocumentUpload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Tag(
 *     name="DocumentUpload",
 *     description="Document upload endpoints"
 * )
 */

class DocumentUploadController extends Controller
{
    // public function index()
    // {
    //     $user = auth()->user();

    //     if ($user->hasRole('Super Admin') || $user->hasRole('Admin')) {
    //         $users_documents = DocumentUpload::with('user')->get();
    //         $documents = [];

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Documents fetched successfully for admin',
    //             'data' => [
    //                 'users_documents' => $users_documents,
    //                 'documents' => $documents
    //             ]
    //         ], 200);
    //     } elseif ($user->hasRole('Learner')) {
    //         $documents = DocumentUpload::where('user_id', $user->id)->first();
    //         $users_documents = [];

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Document fetched successfully for learner',
    //             'data' => [
    //                 'documents' => $documents,
    //                 'users_documents' => $users_documents
    //             ]
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Unauthorized access',
    //         ], 403);
    //     }
    // }

    public function documentConfig()
    {
        try {
            $documentConfig = config('settings.document_upload_form');

            if (!$documentConfig) {
                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Document configuration not found'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Document configuration retrieved successfully',
                'data' => $documentConfig
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Error fetching document config' . $e->getMessage()
            ], 500);
        }
    }

    // public function show($id)
    // {
    //     $user = auth()->user();

    //     if ($user->hasRole('Super Admin') || $user->hasRole('Admin')) {
    //         $document = DocumentUpload::with('user:id')->find($id);

    //         if (!$document) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Document not found',
    //             ], 404);
    //         }

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Document fetched successfully',
    //             'data' => $document
    //         ]);
    //     }

    //     if ($user->hasRole('Learner')) {
    //         $document = DocumentUpload::where('id', $id)
    //             ->where('user_id', $user->id)->with('user:id')
    //             ->first();

    //         if (!$document) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Document not found or unauthorized',
    //             ], 404);
    //         }

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Document fetched successfully',
    //             'data' => $document
    //         ]);
    //     }

    //     return response()->json([
    //         'status' => false,
    //         'message' => 'Unauthorized access',
    //     ], 403);
    // }

    // /**
    //  * @OA\Post(
    //  *     path="/api/document-uploads",
    //  *     summary="Upload documents for verification",
    //  *     description="Upload identity and address proof documents with multiple file uploads",
    //  *     tags={"DocumentUpload"},
    //  *     security={{"bearerAuth":{}}},
    //  *     @OA\RequestBody(
    //  *         required=true,
    //  *         description="Document upload data with files",
    //  *         @OA\MediaType(
    //  *             mediaType="multipart/form-data",
    //  *             @OA\Schema(
    //  *                 required={"first_option", "second_option", "first_front_upload", "second_front_upload", "third_front_upload"},
    //  *                 @OA\Property(
    //  *                     property="first_option",
    //  *                     type="string",
    //  *                     description="Primary identity document type",
    //  *                     enum={"passport", "dvlaLicence", "dvaLicence", "birthCertificate", "residencePermit"},
    //  *                     example="passport"
    //  *                 ),
    //  *                 @OA\Property(
    //  *                     property="second_option",
    //  *                     type="array",
    //  *                     description="Secondary address proof documents (minimum 2 required)",
    //  *                     @OA\Items(
    //  *                         type="string",
    //  *                         enum={"bankStatement", "utilityBill", "creditCardStatement", "councilTaxStatement", "mortgageStatement", "officialLetter", "taxStatement", "paperDrivingLicence", "dvaLicencePhotocard", "pensionStatement", "UKfirearmslicence"},
    //  *                         example="bankStatement"
    //  *                     )
    //  *                 ),
    //  *                 @OA\Property(
    //  *                     property="first_front_upload",
    //  *                     type="string",
    //  *                     format="binary",
    //  *                     description="First document front side (required) - Allowed mimes: webp,jpeg,png,jpg,gif,pdf | Max size: 10MB"
    //  *                 ),
    //  *                 @OA\Property(
    //  *                     property="first_back_upload",
    //  *                     type="string",
    //  *                     format="binary",
    //  *                     description="First document back side (optional) - Allowed mimes: webp,jpeg,png,jpg,gif,pdf | Max size: 10MB"
    //  *                 ),
    //  *                 @OA\Property(
    //  *                     property="second_front_upload",
    //  *                     type="string",
    //  *                     format="binary",
    //  *                     description="Second document front side (required) - Allowed mimes: webp,jpeg,png,jpg,gif,pdf | Max size: 10MB"
    //  *                 ),
    //  *                 @OA\Property(
    //  *                     property="second_back_upload",
    //  *                     type="string",
    //  *                     format="binary",
    //  *                     description="Second document back side (optional) - Allowed mimes: webp,jpeg,png,jpg,gif,pdf | Max size: 10MB"
    //  *                 ),
    //  *                 @OA\Property(
    //  *                     property="third_front_upload",
    //  *                     type="string",
    //  *                     format="binary",
    //  *                     description="Third document front side (required) - Allowed mimes: webp,jpeg,png,jpg,gif,pdf | Max size: 10MB"
    //  *                 ),
    //  *                 @OA\Property(
    //  *                     property="third_back_upload",
    //  *                     type="string",
    //  *                     format="binary",
    //  *                     description="Third document back side (optional) - Allowed mimes: webp,jpeg,png,jpg,gif,pdf | Max size: 10MB"
    //  *                 )
    //  *             )
    //  *         )
    //  *     ),
    //  *     @OA\Response(
    //  *         response=201,
    //  *         description="Documents uploaded successfully",
    //  *         @OA\JsonContent(
    //  *             @OA\Property(property="status", type="boolean", example=true),
    //  *             @OA\Property(property="message", type="string", example="Proof of ID uploaded successfully"),
    //  *             @OA\Property(
    //  *                 property="data",
    //  *                 type="object",
    //  *                 @OA\Property(property="id", type="integer", example=1),
    //  *                 @OA\Property(property="user_id", type="integer", example=123),
    //  *                 @OA\Property(property="first_option", type="string", example="passport"),
    //  *                 @OA\Property(property="second_option", type="string", example="bankStatement,utilityBill"),
    //  *                 @OA\Property(property="first_front_upload", type="string", example="storage/learners/John_Doe/proof_of_id/first_front.pdf"),
    //  *                 @OA\Property(property="first_back_upload", type="string", nullable=true, example=null),
    //  *                 @OA\Property(property="second_front_upload", type="string", example="storage/learners/John_Doe/proof_of_id/second_front.jpg"),
    //  *                 @OA\Property(property="second_back_upload", type="string", nullable=true, example=null),
    //  *                 @OA\Property(property="third_front_upload", type="string", example="storage/learners/John_Doe/proof_of_id/third_front.png"),
    //  *                 @OA\Property(property="third_back_upload", type="string", nullable=true, example=null),
    //  *                 @OA\Property(property="status", type="string", example="In Progress"),
    //  *                 @OA\Property(property="created_at", type="string", format="date-time"),
    //  *                 @OA\Property(property="updated_at", type="string", format="date-time")
    //  *             )
    //  *         )
    //  *     ),
    //  *     @OA\Response(
    //  *         response=422,
    //  *         description="Validation error",
    //  *         @OA\JsonContent(
    //  *             @OA\Property(property="message", type="string", example="The given data was invalid."),
    //  *             @OA\Property(
    //  *                 property="errors",
    //  *                 type="object",
    //  *                 example={
    //  *                     "first_option": {"The first option field is required."},
    //  *                     "second_option": {"The second option must have at least 2 items."},
    //  *                     "first_front_upload": {"The first front upload must be a file of type: webp, jpeg, png, jpg, gif, pdf."}
    //  *                 }
    //  *             )
    //  *         )
    //  *     ),
    //  *     @OA\Response(
    //  *         response=401,
    //  *         description="Unauthorized",
    //  *         @OA\JsonContent(
    //  *             @OA\Property(property="message", type="string", example="Unauthenticated.")
    //  *         )
    //  *     ),
    //  *     @OA\Response(
    //  *         response=500,
    //  *         description="Internal server error",
    //  *         @OA\JsonContent(
    //  *             @OA\Property(property="message", type="string", example="Server error occurred")
    //  *         )
    //  *     )
    //  * )
    //  */

    // public function store(DocumentUploadStore $request)
    // {
    //     try {
    //         $user = auth()->user();

    //         $existing = DocumentUpload::where('user_id', $user->id)->first();

    //         if ($existing) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'code' => 422,
    //                 'message' => 'You have already submitted your document.',
    //             ], 422);
    //         }

    //         $validatedData = $request->validated();

    //         $document = new DocumentUpload();
    //         $document->user_id = $user->id;
    //         $document->first_option = $validatedData['first_option'];
    //         $document->second_option = implode(',', $validatedData['second_option']);

    //         $fileFields = [
    //             'first_front_upload',
    //             'first_back_upload',
    //             'second_front_upload',
    //             'second_back_upload',
    //             'third_front_upload',
    //             'third_back_upload'
    //         ];

    //         foreach ($fileFields as $field) {
    //             if ($request->hasFile($field)) {
    //                 $uploadedFile = $request->file($field);
    //                 $fileName = auth()->user()->name . time() . '_' . $uploadedFile->getClientOriginalName();
    //                 $filePath = $uploadedFile->storeAs('learners' . '/' . auth()->user()->name . '_' . auth()->user()->last_name . '/proof_of_id/', $fileName, 'public');
    //                 $document->{$field} = 'storage/' . $filePath;
    //             }
    //         }

    //         $document->status = 'In Progress';
    //         $document->save();

    //         return response()->json([
    //             'status' => 'success',
    //             'code' => 201,
    //             'message' => 'Proof of ID uploaded successfully',
    //             'data' => $document,
    //         ], 201);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'code' => 500,
    //             'message' => 'Document upload error: ' . $e->getMessage(),
    //         ], 500);
    //     }
    // }

    /**
     * @OA\Post(
     *     path="/api/document-uploads/group-a",
     *     summary="Upload Group A document (Primary ID)",
     *     description="Upload the primary identity document for verification (Group A). This API creates a new record for the user.",
     *     tags={"DocumentUpload"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Upload Group A document with front and optional back file",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"first_option", "first_front_upload"},
     *                 @OA\Property(
     *                     property="first_option",
     *                     type="string",
     *                     description="Primary identity document type",
     *                     enum={"passport", "dvlaLicence", "dvaLicence", "birthCertificate", "residencePermit"},
     *                     example="birthCertificate"
     *                 ),
     *                 @OA\Property(
     *                     property="first_front_upload",
     *                     type="string",
     *                     format="binary",
     *                     description="Front side of the primary document - Allowed mimes: webp,jpeg,png,jpg,gif,pdf | Max size: 10MB"
     *                 ),
     *                 @OA\Property(
     *                     property="first_back_upload",
     *                     type="string",
     *                     format="binary",
     *                     description="Back side of the primary document (optional) - Allowed mimes: webp,jpeg,png,jpg,gif,pdf | Max size: 10MB"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Group A document uploaded successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=201),
     *             @OA\Property(property="message", type="string", example="Group A documents uploaded successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=123),
     *                 @OA\Property(property="first_option", type="string", example="birthCertificate"),
     *                 @OA\Property(property="first_front_upload", type="string", example="storage/learners/John_Doe/proof_of_id/front.pdf"),
     *                 @OA\Property(property="first_back_upload", type="string", nullable=true, example=null),
     *                 @OA\Property(property="status", type="string", example="In Progress"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 example={
     *                     "first_option": {"The first option field is required."},
     *                     "first_front_upload": {"The first front upload must be a valid file."}
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Unauthenticated."))
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Error uploading Group A documents"))
     *     )
     * )
     */

    public function storeGroupA(Request $request)
    {
        try {
            $user = auth()->user();

            $validatedData = $request->validate([
                'first_option'        => 'required|in:passport,dvlaLicence,dvaLicence,birthCertificate,residencePermit',
                'first_front_upload'  => 'required|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
                'first_back_upload'   => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',

                'second_option'       => 'nullable|array|min:0',
                'second_option.*'     => 'nullable|in:bankStatement,utilityBill,creditCardStatement,councilTaxStatement,mortgageStatement,officialLetter,taxStatement,paperDrivingLicence,dvaLicencePhotocard,pensionStatement,UKfirearmslicence',
                'second_front_upload' => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
                'second_back_upload'  => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
                'third_front_upload'  => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
                'third_back_upload'   => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
            ]);

            DB::beginTransaction();

            $existing = DocumentUpload::where('user_id', $user->id)->first();

            if ($existing) {
                if ($existing->status_a === 'In Progress') {
                    DB::rollBack();
                    return response()->json([
                        'status'  => 'error',
                        'code'    => 422,
                        'message' => 'Your Group A documents are already submitted and In Progress. You cannot re-submit at this time.'
                    ], 422);
                }

                $document = $existing;
                $wasRecentlyCreated = false;
            } else {
                $document = new DocumentUpload();
                $document->user_id = $user->id;
                $wasRecentlyCreated = true;
            }

            $document->first_option = $validatedData['first_option'];
            $document->second_option = $document->second_option ?? '';
            $document->second_front_upload = $document->second_front_upload ?? '';
            $document->second_back_upload  = $document->second_back_upload  ?? '';
            $document->third_front_upload  = $document->third_front_upload  ?? '';
            $document->third_back_upload   = $document->third_back_upload   ?? '';

            $storeFile = function ($field) use ($request, $user, $document) {
                if ($request->hasFile($field)) {
                    $uploaded = $request->file($field);
                    $name = $user->name . time() . '_' . $uploaded->getClientOriginalName();
                    $relativePath = 'learners/' . $user->name . '_' . $user->last_name . '/proof_of_id/' . $name;
                    $path = $uploaded->storeAs('learners/' . $user->name . '_' . $user->last_name . '/proof_of_id', $name, 'public');
                    $storedValue = 'storage/' . $path;

                    if (!empty($document->{$field})) {
                        $oldPath = preg_replace('#^storage/#', '', $document->{$field});
                        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                            Storage::disk('public')->delete($oldPath);
                        }
                    }

                    $document->{$field} = $storedValue;
                }
            };

            foreach (['first_front_upload', 'first_back_upload'] as $field) {
                $storeFile($field);
            }

            $requires_back = in_array($document->first_option, [
                'dvlaLicence',
                'dvaLicence',
                'paperDrivingLicence',
                'dvaLicencePhotocard'
            ]);

            $statusA = 'Rejected';

            if (!empty($document->first_front_upload)) {
                if ($requires_back) {
                    if (!empty($document->first_back_upload)) {
                        $statusA = 'In Progress';
                    } else {
                        $statusA = 'Rejected';
                    }
                } else {
                    $statusA = 'In Progress';
                }
            } else {
                $statusA = 'Rejected';
            }

            $document->status_a = $statusA;

            $document->save();

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'code'    => $wasRecentlyCreated ? 201 : 200,
                'message' => $wasRecentlyCreated
                    ? 'Group A documents uploaded successfully'
                    : 'Group A documents updated successfully',
                'data'    => $document
            ], $wasRecentlyCreated ? 201 : 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'  => 'error',
                'code'    => 500,
                'message' => 'Error uploading Group A documents: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/document-uploads/group-b",
     *     summary="Upload Group B documents (Proof of address)",
     *     description="Upload secondary address proof documents (Group B). This API updates the same record created from Group A upload.",
     *     tags={"DocumentUpload"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Upload Group B documents with front/back files",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"second_option", "second_front_upload", "third_front_upload"},
     *                 @OA\Property(
     *                     property="second_option",
     *                     type="array",
     *                     description="Secondary address proof documents (minimum 2 required)",
     *                     @OA\Items(
     *                         type="string",
     *                         enum={"bankStatement", "utilityBill", "creditCardStatement", "councilTaxStatement", "mortgageStatement", "officialLetter", "taxStatement", "paperDrivingLicence", "dvaLicencePhotocard", "pensionStatement", "UKfirearmslicence"},
     *                         example="bankStatement"
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="second_front_upload",
     *                     type="string",
     *                     format="binary",
     *                     description="Second document front side - Allowed mimes: webp,jpeg,png,jpg,gif,pdf | Max size: 10MB"
     *                 ),
     *                 @OA\Property(
     *                     property="second_back_upload",
     *                     type="string",
     *                     format="binary",
     *                     description="Second document back side (optional) - Allowed mimes: webp,jpeg,png,jpg,gif,pdf | Max size: 10MB"
     *                 ),
     *                 @OA\Property(
     *                     property="third_front_upload",
     *                     type="string",
     *                     format="binary",
     *                     description="Third document front side - Allowed mimes: webp,jpeg,png,jpg,gif,pdf | Max size: 10MB"
     *                 ),
     *                 @OA\Property(
     *                     property="third_back_upload",
     *                     type="string",
     *                     format="binary",
     *                     description="Third document back side (optional) - Allowed mimes: webp,jpeg,png,jpg,gif,pdf | Max size: 10MB"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Group B documents uploaded successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Group B documents uploaded successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=123),
     *                 @OA\Property(property="second_option", type="string", example="bankStatement,utilityBill"),
     *                 @OA\Property(property="second_front_upload", type="string", example="storage/learners/John_Doe/proof_of_id/second_front.jpg"),
     *                 @OA\Property(property="second_back_upload", type="string", nullable=true, example=null),
     *                 @OA\Property(property="third_front_upload", type="string", example="storage/learners/John_Doe/proof_of_id/third_front.png"),
     *                 @OA\Property(property="third_back_upload", type="string", nullable=true, example=null),
     *                 @OA\Property(property="status", type="string", example="Completed"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Group A not found",
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="No existing Group A record found. Upload Group A first."))
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 example={
     *                     "second_option": {"At least 2 documents are required."},
     *                     "second_front_upload": {"The second front upload must be a valid file."}
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Unauthenticated."))
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Error uploading Group B documents"))
     *     )
     * )
     */

    public function storeGroupB(Request $request)
    {
        try {
            $user = auth()->user();

            if ($request->filled('second_option') && is_string($request->second_option)) {
                $decoded = json_decode($request->second_option, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $request->merge(['second_option' => $decoded]);
                } else {
                    $request->merge(['second_option' => explode(',', $request->second_option)]);
                }
            }

            $validatedData = $request->validate([
                'second_option'        => 'required|array|min:2',
                'second_option.*'      => 'in:bankStatement,utilityBill,creditCardStatement,councilTaxStatement,mortgageStatement,officialLetter,taxStatement,paperDrivingLicence,dvaLicencePhotocard,pensionStatement,UKfirearmslicence',
                'second_front_upload'  => 'required|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
                'second_back_upload'   => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
                'third_front_upload'   => 'required|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
                'third_back_upload'    => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
            ]);

            DB::beginTransaction();

            $document = DocumentUpload::where('user_id', $user->id)->first();
            if (!$document) {
                DB::rollBack();
                return response()->json([
                    'status'  => 'error',
                    'code'    => 404,
                    'message' => 'No Group A record found. Please upload Group A first.'
                ], 404);
            }

            if ($document->status_b === 'In Progress') {
                DB::rollBack();
                return response()->json([
                    'status'  => 'error',
                    'code'    => 422,
                    'message' => 'Your Group B documents are already submitted and In Progress. You cannot re-submit at this time.'
                ], 422);
            }

            $document->second_option = implode(',', $validatedData['second_option']);

            $storeFile = function ($field) use ($request, $user, $document) {
                if ($request->hasFile($field)) {
                    $uploaded = $request->file($field);
                    $name = $user->name . time() . '_' . $uploaded->getClientOriginalName();
                    $path = $uploaded->storeAs(
                        'learners/' . $user->name . '_' . $user->last_name . '/proof_of_id/',
                        $name,
                        'public'
                    );
                    $storedPath = 'storage/' . $path;

                    if (!empty($document->{$field})) {
                        $oldPath = preg_replace('#^storage/#', '', $document->{$field});
                        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                            Storage::disk('public')->delete($oldPath);
                        }
                    }

                    $document->{$field} = $storedPath;
                }
            };

            foreach (['second_front_upload', 'second_back_upload', 'third_front_upload', 'third_back_upload'] as $field) {
                $storeFile($field);
            }

            $statusB = 'Rejected';
            if (!empty($document->second_front_upload) && !empty($document->third_front_upload)) {
                $statusB = 'In Progress';
            } else {
                $statusB = 'Rejected';
            }

            $document->status_b = $statusB;

            $document->save();
            DB::commit();

            return response()->json([
                'status'  => 'success',
                'code'    => 200,
                'message' => 'Group B documents uploaded successfully',
                'data'    => $document
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'status'  => 'error',
                'code'    => 422,
                'message' => 'Validation error',
                'errors'  => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'  => 'error',
                'code'    => 500,
                'message' => 'Error uploading Group B documents: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/document-uploads/{id}",
     *     summary="Update rejected document upload",
     *     description="Update document upload records that have 'Rejected' status. Only rejected documents can be updated.",
     *     tags={"DocumentUpload"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Document Upload ID",
     *         @OA\Schema(type="integer", example=324)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Document upload data for update",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="_method",
     *                     type="string",
     *                     description="Method override for POST request",
     *                     example="POST"
     *                 ),
     *                 @OA\Property(
     *                     property="first_front_upload",
     *                     type="string",
     *                     format="binary",
     *                     description="First document front side"
     *                 ),
     *                 @OA\Property(
     *                     property="first_back_upload",
     *                     type="string",
     *                     format="binary",
     *                     description="First document back side"
     *                 ),
     *                 @OA\Property(
     *                     property="second_front_upload",
     *                     type="string",
     *                     format="binary",
     *                     description="Second document front side"
     *                 ),
     *                 @OA\Property(
     *                     property="second_back_upload",
     *                     type="string",
     *                     format="binary",
     *                     description="Second document back side"
     *                 ),
     *                 @OA\Property(
     *                     property="third_front_upload",
     *                     type="string",
     *                     format="binary",
     *                     description="Third document front side"
     *                 ),
     *                 @OA\Property(
     *                     property="third_back_upload",
     *                     type="string",
     *                     format="binary",
     *                     description="Third document back side"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Document updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Document updated successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=324),
     *                 @OA\Property(property="user_id", type="integer", example=384),
     *                 @OA\Property(property="first_front_upload", type="string", example="http://127.0.0.1:8000/storage/learners/Elton Cox_Edwards/proof_of_id/Elton Cox_1758888778_first_front_upload.png"),
     *                 @OA\Property(property="first_back_upload", type="string"),
     *                 @OA\Property(property="second_front_upload", type="string"),
     *                 @OA\Property(property="second_back_upload", type="string"),
     *                 @OA\Property(property="third_front_upload", type="string"),
     *                 @OA\Property(property="third_back_upload", type="string"),
     *                 @OA\Property(property="status", type="string", example="In Progress"),
     *                 @OA\Property(property="comments", type="string", nullable=true),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Only rejected documents can be updated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Document not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Document not found")
     *         )
     *     )
     * )
     */

    public function update(UpdateDocumentUploadRequest $request, $id)
    {
        try {
            $user = auth()->user();
            $documentUpload = DocumentUpload::findOrFail($id);

            if ($documentUpload->user_id !== $user->id) {
                return response()->json(['status' => false, 'message' => 'You are not authorized to update this document.'], 403);
            }
            if ($documentUpload->status !== 'Rejected') {
                return response()->json(['status' => false, 'message' => 'Only rejected documents can be updated.', 'current_status' => $documentUpload->status], 403);
            }

            $validatedData = $request->validated();

            if (isset($validatedData['first_option'])) {
                $documentUpload->first_option = $validatedData['first_option'];
            }
            if (isset($validatedData['second_option'])) {
                $documentUpload->second_option = implode(',', $validatedData['second_option']);
            }

            $fileFields = [
                'first_front_upload',
                'first_back_upload',
                'second_front_upload',
                'second_back_upload',
                'third_front_upload',
                'third_back_upload'
            ];

            $filesUpdated = false;

            foreach ($fileFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);

                    if ($documentUpload->{$field}) {
                        $oldFile = str_replace('storage/', '', $documentUpload->{$field});
                        if (Storage::disk('public')->exists($oldFile)) {
                            Storage::disk('public')->delete($oldFile);
                        }
                    }

                    $fileName = $user->name . '_' . time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                    $directory = 'learners/' . $user->name . '_' . $user->last_name . '/proof_of_id/';

                    Storage::disk('public')->makeDirectory($directory);

                    $path = $file->storeAs($directory, $fileName, 'public');
                    $documentUpload->{$field} = 'storage/' . $path;

                    $filesUpdated = true;
                }
            }

            if ($filesUpdated) {
                $documentUpload->status = 'In Progress';
                $documentUpload->comments = null;
            }

            $documentUpload->save();
            return response()->json([
                'status' => true,
                'message' => 'Document updated successfully.',
                'data' => new DocumentUploadResource($documentUpload)
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Error updating document.', 'error' => $e->getMessage()], 500);
        }
    }
}
