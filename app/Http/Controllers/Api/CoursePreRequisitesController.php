<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserCertification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

/**
 * @OA\Tag(
 *     name="CoursePrerequisites",
 *     description="Course prerequisites endpoints"
 * )
 */

class CoursePreRequisitesController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/course-prerequisites",
     *     summary="Submit first aid qualification",
     *     description="Store user's first aid qualification with external or internal certification",
     *     tags={"CoursePrerequisites"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"qualification_type"},
     *                 @OA\Property(
     *                     property="qualification_type",
     *                     type="string",
     *                     enum={"external", "internal"},
     *                     description="Type of qualification - external or internal"
    *                 ),
    *                 @OA\Property(
    *                     property="external_certification_id",
    *                     type="integer",
    *                     description="ID of external certification (required if qualification_type is external)",
    *                     example=1
    *                 ),
    *                 @OA\Property(
    *                     property="internal_certification_id", 
    *                     type="integer",
    *                     description="ID of internal certification (required if qualification_type is internal)",
    *                     example=1
    *                 ),
    *                 @OA\Property(
    *                     property="course_certificate",
     *                     type="string",
     *                     format="binary",
     *                     description="Certificate file (required for external qualifications)"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Qualification submitted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=201),
     *             @OA\Property(property="message", type="string", example="Qualification submitted successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=1),
     *                 @OA\Property(property="qualification_type", type="string", example="external"),
     *                 @OA\Property(property="external_certification_id", type="integer", example=1),
     *                 @OA\Property(property="internal_certification_id", type="integer", example=null),
     *                 @OA\Property(property="course_certificate", type="string", example="storage/learners/John/course_certificate/John_1234567890_certificate.pdf"),
     *                 @OA\Property(property="status", type="string", example="In Progress"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=422),
     *             @OA\Property(property="message", type="string", example="Validation failed"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="qualification_type",
     *                     type="array",
     *                     @OA\Items(type="string", example="Please select your qualification type.")
     *                 ),
     *                 @OA\Property(
     *                     property="external_certification_id",
     *                     type="array",
     *                     @OA\Items(type="string", example="Please select an external certification.")
     *                 ),
     *                 @OA\Property(
     *                     property="internal_certification_id",
     *                     type="array",
     *                     @OA\Items(type="string", example="Please select an internal certification.")
     *                 ),
     *                 @OA\Property(
     *                     property="course_certificate",
     *                     type="array",
     *                     @OA\Items(type="string", example="Please upload your certification document (required for external qualifications).")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=500),
     *             @OA\Property(property="message", type="string", example="Server error occurred: Error message")
     *         )
     *     )
     * )
     */

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'qualification_type' => 'required|in:external,internal',
                'course_certificate' => $request->input('qualification_type') === 'external'
                    ? 'required|file|mimes:jpg,png,pdf|max:2048'
                    : 'nullable|file|mimes:jpg,png,pdf|max:2048',
            ], [
                'qualification_type.required' => 'Please select your qualification type.',
                'course_certificate.required' => 'Please upload your certification document (required for external qualifications).',
                'course_certificate.mimes'    => 'Only jpg, png, and pdf formats are allowed.',
                'course_certificate.max'      => 'The file size may not exceed 2MB.',
            ]);

            $user = auth()->user();

            $existingInProgress = UserCertification::where('user_id', $user->id)
                ->where('status', 'In Progress')
                ->first();

            if ($existingInProgress) {
                return response()->json([
                    'status'  => 'error',
                    'code'    => 409,
                    'message' => 'You already have a certification request in progress. Please wait for it to complete before submitting a new one.',
                ], 409);
            }

            $relatedCertification = $user->certifications()
                ->when(
                    Schema::hasColumn('certifications', 'qualification_type'),
                    fn($q) => $q->where('qualification_type', $request->qualification_type)
                )
                ->latest()
                ->first();

            $certificationId = $relatedCertification?->id ?? null;

            $existingRecord = UserCertification::where('user_id', $user->id)
                ->where(function ($q) {
                    $q->whereNull('status')
                        ->orWhere('status', 'Not Submitted')
                        ->orWhere('status', 'Rejected');
                })
                ->latest()
                ->first();

            if ($existingRecord) {
                $certification = $existingRecord;
                $wasNew = false;
            } else {
                $certification = new UserCertification();
                $certification->user_id = $user->id;
                $wasNew = true;
            }

            $certification->qualification_type = $validatedData['qualification_type'];
            $certification->certification_id = $certificationId;
            $certification->course_certificate = $certification->course_certificate ?? 'empty';

            if ($request->hasFile('course_certificate')) {
                $uploadedFile = $request->file('course_certificate');
                $fileName = $user->name . '_' . time() . '_' . $uploadedFile->getClientOriginalName();

                $directory = 'learners/' . $user->name . '/course_certificate';

                $filePath = $uploadedFile->storeAs(
                    $directory,
                    $fileName,
                    'public'
                );

                $certification->course_certificate = 'storage/' . $filePath;
            }

            $certification->status = 'In Progress';
            $certification->is_skip = false;
            $certification->save();

            return response()->json([
                'status'  => 'success',
                'code'    => $wasNew ? 201 : 200,
                'message' => $wasNew ? 'Qualification submitted successfully' : 'Qualification updated successfully',
                'data'    => $certification
            ], $wasNew ? 201 : 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status'  => 'error',
                'code'    => 422,
                'message' => 'Validation failed',
                'errors'  => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'code'    => 500,
                'message' => 'Server error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/course-prerequisites/skip",
     *     summary="Skip certification submission",
     *     description="Creates a record in user_certifications with is_skip = true",
     *     tags={"CoursePrerequisites"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=201,
     *         description="Certification skip recorded successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=201),
     *             @OA\Property(property="message", type="string", example="Certification skipped successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=5),
     *                 @OA\Property(property="is_skip", type="boolean", example=true),
     *                 @OA\Property(property="status", type="string", example="Skipped"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Duplicate skip request",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=409),
     *             @OA\Property(property="message", type="string", example="You have already marked certification as skipped.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=500),
     *             @OA\Property(property="message", type="string", example="Server error occurred: ...")
     *         )
     *     )
     * )
     */
    public function skipCertification(Request $request)
    {
        try {
            $user = auth()->user();

            $existingSkip = UserCertification::where('user_id', $user->id)
                ->where('is_skip', true)
                ->first();

            if ($existingSkip) {
                return response()->json([
                    'status'  => 'error',
                    'code'    => 409,
                    'message' => 'You have already marked certification as skipped.',
                ], 409);
            }

            $certification = new UserCertification();
            $certification->user_id = $user->id;
            $certification->is_skip = true;
            $certification->status = 'Not Submitted';
            $certification->save();

            return response()->json([
                'status'  => 'success',
                'code'    => 201,
                'message' => 'Certification skipped successfully',
                'data'    => $certification,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'code'    => 500,
                'message' => 'Server error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
}
