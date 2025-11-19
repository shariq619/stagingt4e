<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\{
    EmailValidateRequest,
    ForgotPasswordRequest,
    MeRequest,
    ResetPasswordRequest,
    VerifyOtpRequest,
};
use App\Http\Resources\{
    LoginResponse,
    MeResponse
};
use Illuminate\Support\Facades\{
    Auth,
    Hash,
    Mail,
    Validator
};
use App\Http\Controllers\Controller;
use App\Mail\SendOtpMail;
use App\Models\ApplicationForm;
use App\Models\DocumentUpload;
use App\Models\ProfilePhoto;
use App\Models\User;
use App\Models\UserCertification;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * @OA\Tag(
 *     name="Authentication",
 *     description="Authentication endpoints"
 * )
 */
class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"Authentication"},
     *     summary="User login",
     *     operationId="userLogin",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 required={"email", "password"},
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     format="email",
     *                     example="user@example.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     format="password",
     *                     example="password123"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Login successful"),
     *             @OA\Property(property="token", type="string", example="1|abcdef123456")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 example={
     *                     "email": {"The email field is required."},
     *                     "password": {"The password field is required."}
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Invalid credentials")
     *         )
     *     )
     * )
     */

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'code' => 422,
                'message' => 'Validation failed',
                'data' => [
                    'errors' => $validator->errors(),
                ]
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'code' => 401,
                'message' => 'Invalid credentials',
                'data' => null
            ], 401);
        }

        $token = $user->createToken('t4eToken')->plainTextToken;

        $applicationForm = ApplicationForm::where('learner_id', $user->id)->latest()->first();
        $profilePhotos = ProfilePhoto::where('user_id', $user->id)->latest()->first();
        $documentUpload = DocumentUpload::where('user_id', $user->id)->latest()->first();
        $userCertification = UserCertification::where('user_id', $user->id)->latest()->first();
        $documentUploadStatus = null;

        if ($documentUpload) {
            $groupAColumns = ['first_option', 'first_front_upload', 'first_back_upload'];
            $groupBColumns = ['second_option', 'second_front_upload', 'second_back_upload', 'third_front_upload', 'third_back_upload'];

            $groupAHasData = collect($groupAColumns)->contains(fn($col) => !empty($documentUpload->{$col}));
            $groupBHasData = collect($groupBColumns)->contains(fn($col) => !empty($documentUpload->{$col}));

            $groupAStatus = $documentUpload->status_a ?? 'Not Submitted';
            $groupBStatus = $documentUpload->status_b ?? 'Not Submitted';

            $documentUploadStatus = [
                'status'  => $documentUpload->status ?? null,
                'comment' => $documentUpload->comments ?? null,
                'group_a' => $groupAStatus,
                'group_b' => $groupBStatus,
            ];
        }

        $profilePhotosStatus = [
            'status' => $profilePhotos->status ?? null,
            'comment' => $profilePhotos->comments ?? null,
        ];

        $applicationFormStatus = [
            'status' => $applicationForm->status ?? null,
            'comment' => $applicationForm->comments ?? null,
        ];

        $userCertificationStatus = [
            'status' => $userCertification->status ?? null,
            'comment' => $userCertification->comments ?? null,
            'is_skip' => $userCertification->is_skip ?? null,
        ];

        $trainerData = [];
        if ($user->hasRole('Learner')) {
            $userWithCohorts = User::with('cohorts')->find($user->id);

            if ($userWithCohorts) {
                $trainerIds = $userWithCohorts->cohorts->pluck('trainer_id')->filter()->unique();

                if ($trainerIds->isNotEmpty()) {
                    $trainers = User::whereIn('id', $trainerIds)->get(['id', 'name', 'email']);

                    $trainerData = $trainers->map(function ($trainer) {
                        return [
                            'id' => $trainer->id,
                            'name' => $trainer->name,
                            'email' => $trainer->email
                        ];
                    });
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Login successful',
            'data' => [
                'token' => $token,
                'user' => new MeResponse($user),
                'profilePhotosStatus' => $profilePhotosStatus,
                'applicationFormStatus' => $applicationFormStatus,
                'documentUploadStatus'     => $documentUploadStatus,
                'userCertificationStatus' => $userCertificationStatus,
                'trainers' => $trainerData,
            ],
        ], 200)->header('Authorization', 'Bearer ' . $token);
    }

    /**
     * Get authenticated user details
     * 
     * @OA\Get(
     *     path="/api/me",
     *     tags={"Authentication"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="User details retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="reseller_id", type="integer", nullable=true, example=null),
     *             @OA\Property(property="client_id", type="integer", nullable=true, example=null),
     *             @OA\Property(property="methodology_id", type="integer", nullable=true, example=null),
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="middle_name", type="string", nullable=true, example=null),
     *             @OA\Property(property="last_name", type="string", nullable=true, example="Smith"),
     *             @OA\Property(property="email", type="string", example="john@example.com"),
     *             @OA\Property(property="email_verified_at", type="string", format="date-time", nullable=true),
     *             @OA\Property(property="gender", type="string", enum={"male", "female"}, example="male"),
     *             @OA\Property(property="birth_place", type="string", nullable=true, example="London"),
     *             @OA\Property(property="birth_date", type="string", nullable=true, example="1990-05-15"),
     *             @OA\Property(property="address", type="string", nullable=true, example="123 Main Street"),
     *             @OA\Property(property="phone_number", type="string", nullable=true, example="+1234567890"),
     *             @OA\Property(property="company", type="string", nullable=true, example="ABC Corp"),
     *             @OA\Property(property="website", type="string", nullable=true, example="https://example.com"),
     *             @OA\Property(property="telephone", type="string", nullable=true, example="+1234567890"),
     *             @OA\Property(property="image", type="string", nullable=true, example="profile.jpg"),
     *             @OA\Property(property="password_check", type="integer", example=1),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=401),
     *             @OA\Property(property="message", type="string", example="Unauthenticated"),
     *             @OA\Property(property="data", type="null", example=null)
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=500),
     *             @OA\Property(property="message", type="string", example="Internal server error"),
     *             @OA\Property(property="data", type="null", example=null)
     *         )
     *     )
     * )
     */

    public function me(MeRequest $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'User not found',
                    'code'    => 401,
                    'data'    => null,
                ], 401);
            }

            $applicationForm = ApplicationForm::where('learner_id', $user->id)->latest()->first();
            $profilePhotos   = ProfilePhoto::where('user_id', $user->id)->select('status', 'comments')->latest()->first();
            $documentUpload  = DocumentUpload::where('user_id', $user->id)->latest()->first();
            $userCertification = UserCertification::where('user_id', $user->id)->latest()->first();

            $documentUploadStatus = null;

            if ($documentUpload) {
                $groupAColumns = ['first_option', 'first_front_upload', 'first_back_upload'];
                $groupBColumns = ['second_option', 'second_front_upload', 'second_back_upload', 'third_front_upload', 'third_back_upload'];

                $groupAHasData = collect($groupAColumns)->contains(fn($col) => !empty($documentUpload->{$col}));
                $groupBHasData = collect($groupBColumns)->contains(fn($col) => !empty($documentUpload->{$col}));

                $groupAStatus = $documentUpload->status_a ?? 'Not Submitted';
                $groupBStatus = $documentUpload->status_b ?? 'Not Submitted';

                $documentUploadStatus = [
                    'status'  => $documentUpload->status ?? null,
                    'comment' => $documentUpload->comments ?? null,
                    'group_a' => $groupAStatus,
                    'group_b' => $groupBStatus,
                ];
            }

            $profilePhotosStatus = [
                'status'  => $profilePhotos->status ?? null,
                'comment' => $profilePhotos->comments ?? null,
            ];

            $status = [
                'status'  => $applicationForm->status ?? null,
                'comment' => $applicationForm->comments ?? null,
            ];

            $userCertificationStatus = [
                'status'   => $userCertification->status ?? null,
                'comment'  => $userCertification->comments ?? null,
                'is_skip'  => $userCertification->is_skip ?? null,
            ];

            $trainerData = [];
            if ($user->hasRole('Learner')) {
                $userWithCohorts = User::with('cohorts')->find($user->id);

                if ($userWithCohorts) {
                    $trainerIds = $userWithCohorts->cohorts->pluck('trainer_id')->filter()->unique();

                    if ($trainerIds->isNotEmpty()) {
                        $trainers = User::whereIn('id', $trainerIds)->get(['id', 'name', 'email']);

                        $trainerData = $trainers->map(function ($trainer) {
                            return [
                                'id'    => $trainer->id,
                                'name'  => $trainer->name,
                                'email' => $trainer->email
                            ];
                        });
                    }
                }
            }

            return response()->json([
                'status'  => 'success',
                'code'    => 200,
                'message' => 'Data retrieved successfully',
                'data'    => [
                    'profilePhotosStatus'      => $profilePhotosStatus,
                    'applicationFormStatus'    => $status,
                    'trainers'                 => $trainerData,
                    'documentUploadStatus'     => $documentUploadStatus,
                    'userCertificationStatus'  => $userCertificationStatus,
                    'user'                     => new MeResponse($user),
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'code'    => 500,
                'data'    => null,
                'message' => 'Internal server error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Forgot Password - Password Reset With OTP
     * 
     * @OA\Post(
     *     path="/api/auth/forgot-password",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "otp", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="otp", type="string", format="otp", example="123456"),
     *             @OA\Property(property="password", type="string", format="password", example="newpassword123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password reset successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Password reset successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Email not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=404),
     *             @OA\Property(property="message", type="string", example="Email not registered")
     *         )
     *     )
     * )
     */

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        try {
            $email = $request->email;
            $otp = $request->otp;
            $password = $request->password;

            $user = User::where('email', $email)->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Email not registered'
                ], 404);
            }

            if (!$user->otp) {
                return response()->json([
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'OTP not requested. Please request OTP first.'
                ], 400);
            }

            if ($user->otp != $otp) {
                return response()->json([
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Invalid OTP'
                ], 400);
            }

            if ($user->otp_expiry < now()) {
                return response()->json([
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'OTP expired. Please request a new OTP.'
                ], 400);
            }

            $user->password = Hash::make($password);
            $user->otp = null;
            $user->otp_expiry = null;
            $user->save();

            $deletedCount = PersonalAccessToken::where('tokenable_id', $user->id)->where('tokenable_type', User::class)->delete();

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Password reset successfully. Please login with your new password.',
                'tokens_deleted' => $deletedCount
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Failed to reset password',
                'message' => 'Internal server error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reset Password
     * 
     * @OA\Post(
     *     path="/api/auth/reset-password",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "otp", "password", "password_confirmation"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="otp", type="string", example="123456"),
     *             @OA\Property(property="password", type="string", format="password", example="newpassword123"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="newpassword123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password reset successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Password reset successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid OTP",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=400),
     *             @OA\Property(property="message", type="string", example="Invalid OTP")
     *         )
     *     )
     * )
     */

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $email = $request->email;
            $otp = $request->otp;
            $password = $request->password;

            $user = User::where('email', $email)->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'User not found'
                ], 404);
            }

            if (!$user->otp || $user->otp != $otp) {
                return response()->json([
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Invalid OTP'
                ], 400);
            }

            if ($user->otp_expiry < now()) {
                return response()->json([
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'OTP expired'
                ], 400);
            }

            $user->password = Hash::make($password);
            $user->otp = null;
            $user->otp_expiry = null;
            $user->save();

            $deletedCount = PersonalAccessToken::where('tokenable_id', $user->id)->where('tokenable_type', User::class)->delete();

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Password reset successfully. Please login again.',
                'token' => $deletedCount
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Internal server error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Validate email and send OTP
     * 
     * @OA\Post(
     *     path="/api/auth/email-validate",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OTP sent successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="OTP sent to your email")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Email not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=404),
     *             @OA\Property(property="message", type="string", example="Email not registered")
     *         )
     *     )
     * )
     */

    public function emailValidate(EmailValidateRequest $request)
    {
        try {
            $email = $request->email;
            $user = User::where('email', $email)->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'code' => 404
                ], 404);
            }

            $otp = rand(100000, 999999);
            $otpExpiry = now()->addMinutes(5);
            $user->otp = $otp;
            $user->otp_expiry = $otpExpiry;
            $user->updateOrCreate(['email' => $email], ['otp' => $otp, 'otp_expiry' => $otpExpiry]);

            Mail::to($email)->send(new SendOtpMail($otp));

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'data' => [
                    'email' => $email,
                    'otp_expiry' => $otpExpiry->toDateTimeString()
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Internal server error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verify OTP
     * 
     * @OA\Post(
     *     path="/api/auth/verify-otp",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "otp"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="otp", type="string", example="123456")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OTP verified successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="OTP verified successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid OTP",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=400),
     *             @OA\Property(property="message", type="string", example="Invalid or expired OTP")
     *         )
     *     )
     * )
     */

    public function verifyOtp(VerifyOtpRequest $request)
    {
        try {
            $email = $request->email;
            $otp = $request->otp;

            $user = User::where('email', $email)->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Email not registered'
                ], 404);
            }

            if ($user->otp_expiry < now()) {
                return response()->json([
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'OTP has expired'
                ], 400);
            }

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'data' => [
                    'email' => $email,
                    'otp_verified' => true,
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Internal server error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Change Password (First Time)
     * 
     * @OA\Post(
     *     path="/api/auth/change-password",
     *     tags={"Authentication"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"new_password"},
     *             @OA\Property(property="new_password", type="string", format="password", example="newpassword123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password changed successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Password changed successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid request",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=400),
     *             @OA\Property(property="message", type="string", example="Password check is already completed")
     *         )
     *     )
     * )
     */

    public function changePassword(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'code' => 401,
                    'message' => 'Unauthenticated'
                ], 401);
            }

            if ($user->password_check !== 0) {
                return response()->json([
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'Password check is already completed'
                ], 400);
            }

            $validator = Validator::make($request->all(), [
                'new_password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'code' => 422,
                    'errors' => $validator->errors(),
                ], 422);
            }

            $user->password = Hash::make($request->new_password);
            $user->password_check = 1;
            $user->save();

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Password changed successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Internal server error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Logout user",
     *     description="Logs out the currently authenticated user by revoking their access token.",
     *     tags={"Authentication"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=false,
     *         description="No body parameters required"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful logout response",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Logged out successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized - Invalid or expired token",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }
}
