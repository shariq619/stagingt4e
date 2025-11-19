<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @OA\Tag(name="Dashboard",
 * description="Learner Dashboard endpoints"
 * )
 */

class DashboardController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/dashboard/banner",
     *     tags={"Dashboard"},
     *     summary="Get home banner",
     *     @OA\Response(
     *         response=200,
     *         description="Home banner retrieved successfully"
     *     )
     * )
     */

    public function bannerData()
    {
        try {
            $homeBanner = config('settings.home_banner');

            if (!$homeBanner) {
                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Home banner not found'
                ], 404);
            }

            $homeBannerArray = array_values($homeBanner);

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Home banner retrieved successfully',
                'data' => $homeBannerArray
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Error fetching home banner: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/dashboard/categories",
     *     tags={"Dashboard"},
     *     summary="Get all categories",
     *     @OA\Response(
     *         response=200,
     *         description="List of categories"
     *     )
     * )
     */

    public function categoryData()
    {
        try {
            $categories = Category::all();

            if ($categories->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'No categories found'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Categories retrieved successfully',
                'data' => $categories
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Error fetching categories: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/dashboard/courses",
     *     tags={"Dashboard"},
     *     summary="Get all courses",
     *     @OA\Response(
     *         response=200,
     *         description="List of courses"
     *     )
     * )
     */

    public function courseData()
    {
        try {
            $courses = Course::select('id', 'status', 'slug', 'course_image', 'name', 'category_id', 'qualification', 'description', 'vat', 'price', 'duration', 'certification', 'awarding_bodies', 'delivery_mode', 'course_type', 'qualification_type')->get();
            if ($courses->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'No courses found'
                ], 404);
            }
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Courses retrieved successfully',
                'data' => $courses
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Error fetching courses: ' . $th->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/dashboard/admins",
     *     tags={"Dashboard"},
     *     summary="Get all admins and super admins",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Admins retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Admins retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="admins",
     *                     type="array",
     *                     @OA\Items(
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="name", type="string", example="John Doe"),
     *                         @OA\Property(property="email", type="string", example="john@example.com"),
     *                         @OA\Property(property="role", type="string", example="Super Admin")
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="total",
     *                     type="integer",
     *                     example=5
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=401),
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=500),
     *             @OA\Property(property="message", type="string", example="Internal server error")
     *         )
     *     )
     * )
     */
    public function getAdmins()
    {
        try {
            $admins = User::role(['Admin', 'Super Admin'])
                ->select('id', 'name', 'email')
                ->get()
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                    ];
                });

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Admins retrieved successfully',
                'data' => $admins
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Failed to retrieve admins',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
