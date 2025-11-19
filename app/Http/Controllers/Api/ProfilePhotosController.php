<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProfilePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

/**
 * @OA\Tag(
 *     name="Profile Photos",
 *     description="Profile photo endpoints"
 * )
 */

class ProfilePhotosController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/profile-photos",
     *     tags={"Profile Photos"},
     *     summary="Upload a profile photo",
     *     security={{"bearerAuth":{}}},
     *     description="Allows a learner to upload a profile photo.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="profile_photo",
     *                     type="string",
     *                     format="binary",
     *                     description="The profile photo file to upload"
     *                 ),
     *                 required={"profile_photo"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Profile photo uploaded successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=201),
     *             @OA\Property(property="message", type="string", example="Profile photo uploaded successfully.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request - Invalid input or profile photo already exists",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=400),
     *             @OA\Property(property="message", type="string", example="Invalid file upload.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error - Failed to upload profile photo",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Failed to upload profile photo.")
     *         )
     *     )
     * )
     */

    public function store(Request $request)
    {
        try {
            $request->validate([
                'profile_photo' => 'required|image|mimes:jpeg,png,webp,jpg,gif,svg|max:2048',
            ]);

            $user = auth()->user();
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'code' => 401,
                    'message' => 'Unauthenticated.'
                ], 401);
            }

            if (ProfilePhoto::where('user_id', $user->id)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'code'  => 400,
                    'message' => 'Profile photo already exists for this user.'
                ], 400);
            }

            if ($request->hasFile('profile_photo')) {
                $uploadedFile = $request->file('profile_photo');
                $fileName = auth()->user()->name . '_' . $uploadedFile->getClientOriginalName();
                $filePath = $uploadedFile->storeAs('learners' . '/' . auth()->user()->name . '_' . auth()->user()->last_name . '/profile_photo/', $fileName, 'public');

                $profilePhoto = new ProfilePhoto();
                $profilePhoto->user_id = $user->id;
                $profilePhoto->profile_photo = 'storage/' . $filePath;
                $profilePhoto->status = "In Progress";
                $profilePhoto->save();

                return response()->json([
                    'status' => 'success',
                    'code'  => 201,
                    'message' => 'Profile photo uploaded successfully.',
                    'data' => [
                        'path' => $profilePhoto->profile_photo
                    ]
                ], 201);
            }

            return response()->json([
                'status' => 'error',
                'code'  => 400,
                'message' => 'No file uploaded.'
            ], 400);
        } catch (ValidationException $ve) {
            return response()->json([
                'status' => 'error',
                'code' => 422,
                'message' => 'Validation failed.' . json_encode($ve->errors()),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Failed to upload profile photo. ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/profile-photos/{id}",
     *     tags={"Profile Photos"},
     *     summary="Update profile photo",
     *     security={{"bearerAuth":{}}},
     *     description="Allows a learner to update their profile photo. Replaces the old image.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Profile photo ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="_method",
     *                     type="string",
     *                     description="Method override for POST request",
     *                     example="POST"
     *                 ),
     *                 @OA\Property(
     *                     property="profile_photo",
     *                     type="string",
     *                     format="binary",
     *                     description="The new profile photo file to upload"
     *                 ),
     *                 required={"profile_photo"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Profile photo updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Profile photo updated successfully."),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="path", type="string", example="storage/learners/John_Doe/profile_photo/John_profile.png")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Profile photo not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=404),
     *             @OA\Property(property="message", type="string", example="Profile photo not found.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", type="integer", example=401),
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'code' => 401,
                'message' => 'Unauthenticated.'
            ], 401);
        }
        $profilePhoto = ProfilePhoto::find($id);
        if (!$profilePhoto || $profilePhoto->user_id !== $user->id) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'Profile photo not found.'
            ], 404);
        }
        if ($profilePhoto->status !== 'Rejected') {
            return response()->json([
                'status' => 'error',
                'code'  => 400,
                'message' => 'Profile photo can only be updated if status is Rejected.'
            ], 400);
        }

        if (!$profilePhoto || $profilePhoto->user_id !== $user->id) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'Profile photo not found.'
            ], 404);
        }

        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,webp,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($profilePhoto->profile_photo) {
                Storage::disk('public')->delete(str_replace('storage/', '', $profilePhoto->profile_photo));
            }

            $uploadedFile = $request->file('profile_photo');
            $fileName = $user->name . '_' . $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('learners/' . $user->name . '_' . $user->last_name . '/profile_photo/', $fileName, 'public');
            $profilePhoto->profile_photo = 'storage/' . $filePath;
        }

        $profilePhoto->status = "In Progress";
        $profilePhoto->save();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Profile photo updated successfully.',
            'data' => [
                'path' => $profilePhoto->profile_photo
            ]
        ], 200);
    }
}
