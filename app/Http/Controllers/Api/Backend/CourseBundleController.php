<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\CourseBundle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * @OA\Tag(name="CourseBundles",
 * description="Courses Bundles endpoints"
 * )
 */

class CourseBundleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/backend/courses-bundles",
     *     tags={"CourseBundles"},
     *     summary="Get all Course Bundles",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of Course bundles"
     *     )
     * )
     */

    public function index()
    {
        try {
            $course_bundles = CourseBundle::all();
            return response()->json(['success' => true, 'data' => $course_bundles], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Server error', 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/backend/courses-bundles/{slug}",
     *     tags={"CourseBundles"},
     *     summary="Get single Course Bundle by slug",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         required=true,
     *         description="ID of the Course Bundles",
     *         @OA\Schema(type="string", example="test-slug")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Course Bundles detail"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Course Bundles not found"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */

    public function show($slug)
    {
        try {
            $course_bundle = CourseBundle::where('slug', $slug)->first();
            if (!$course_bundle) {
                return response()->json([
                    'success' => false,
                    'message' => 'Course Bundle not found',
                ]);
            }
            return response()->json(['success' => true, 'message' => 'Data retrived successfully', 'data' => $course_bundle], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Server error', 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/backend/courses-bundles",
     *     tags={"CourseBundles"},
     *     summary="Create a new course bundle",
     *     security={{"bearerAuth":{}}},
     * 
     *     @OA\Parameter(
     *         name="products[]",
     *         in="query",
     *         required=true,
     *         description="Array of product IDs",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(type="integer")
     *         ),
     *         style="form",
     *         explode=true
     *     ),

     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"name", "regular_price"},
     *                 @OA\Property(property="name", type="string", example="Full Stack Bundle"),
     *                 @OA\Property(property="short_description", type="string", example="This is a short description."),
     *                 @OA\Property(property="excerpt", type="string", example="Quick overview of the bundle."),
     *                 @OA\Property(property="long_description", type="string", example="Detailed description about the bundle."),
     *                 @OA\Property(property="regular_price", type="number", format="float", example=1499.99),
     *                 @OA\Property(property="vat", type="number", format="float", example=18.0),
     *                 @OA\Property(property="courses_included", type="string", example="HTML, CSS, JS, Laravel"),
     *                 @OA\Property(property="bundle_image", type="file", description="Bundle image (jpeg, png, jpg, gif, svg, webp)")
     *             )
     *         )
     *     ),

     *     @OA\Response(
     *         response=201,
     *         description="Course Bundle created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Course Bundle created successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Validation error"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 additionalProperties=@OA\Property(type="array", @OA\Items(type="string"))
     *             )
     *         )
     *     )
     * )
     */


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'products' => 'required|array',
            'short_description' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'long_description' => 'nullable|string',
            'regular_price' => 'required|numeric',
            'vat' => 'nullable|numeric',
            'courses_included' => 'nullable|string',
            'bundle_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $validateData['slug'] = Str::slug($request->input('name'));

        if ($request->hasFile('bundle_image') && $request->file('bundle_image')->isValid()) {
            $uploadedFile = $request->file('bundle_image');
            $originalName = time() . '_' . $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('bundle_images', $originalName, 'public');
            $validateData['bundle_image'] = 'storage/' . $filePath;
        }

        if (isset($validateData['products']) && is_array($validateData['products'])) {
            $validateData['products'] = json_encode($validateData['products']);
        }

        $bundle = CourseBundle::create($validateData);

        return response()->json([
            'success' => true,
            'message' => 'Course Bundle added successfully',
            'data' => $bundle
        ], 201);
    }

    /**
     * @OA\Post(
     *     path="/api/backend/courses-bundles/{slug}",
     *     tags={"CourseBundles"},
     *     summary="Update a course bundle by slug",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter( name="slug", in="path", required=true, description="Slug of the course bundle", @OA\Schema(type="string")),
     *     @OA\Parameter(name="products[]",in="query",required=true, description="Array of product IDs",  @OA\Schema(type="array",@OA\Items(type="integer")), style="form", explode=true),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"name", "regular_price"},
     *                 @OA\Property(property="_method", type="string", default="PUT"),
     *                 @OA\Property(property="name", type="string", example="Full Stack Bundle"),
     *                 @OA\Property(property="short_description", type="string", example="This is a short description."),
     *                 @OA\Property(property="excerpt", type="string", example="Quick overview of the bundle."),
     *                 @OA\Property(property="long_description", type="string", example="Detailed description about the bundle."),
     *                 @OA\Property(property="regular_price", type="number", format="float", example=1499.99),
     *                 @OA\Property(property="vat", type="number", format="float", example=18.0),
     *                 @OA\Property(property="courses_included", type="string", example="HTML, CSS, JS, Laravel"),
     *                 @OA\Property(property="bundle_image", type="file", description="Bundle image (jpeg, png, jpg, gif, svg, webp)")
     *             )
     *         )
     *     ),

     *     @OA\Response(
     *         response=200,
     *         description="Course Bundle updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Course Bundle updated successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Course Bundle not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Course Bundle not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Validation error"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 additionalProperties=@OA\Property(type="array", @OA\Items(type="string"))
     *             )
     *         )
     *     )
     * )
     */

    public function update(Request $request, $slug)
    {
        $courseBundle = CourseBundle::where('slug', $slug)->first();

        if (!$courseBundle) {
            return response()->json([
                'success' => false,
                'message' => 'Course Bundle not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'products' => 'required|array',
            'short_description' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'long_description' => 'nullable|string',
            'regular_price' => 'required|numeric',
            'vat' => 'nullable|numeric',
            'courses_included' => 'nullable|string',
            'bundle_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validateData = $validator->validated();

        if ($request->hasFile('bundle_image') && $request->file('bundle_image')->isValid()) {
            if ($courseBundle->bundle_image && Storage::disk('public')->exists(str_replace('storage/', '', $courseBundle->bundle_image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $courseBundle->bundle_image));
            }

            $uploadedFile = $request->file('bundle_image');
            $originalName = time() . '_' . $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('bundle_images', $originalName, 'public');
            $validateData['bundle_image'] = 'storage/' . $filePath;
        } else {
            $validateData['bundle_image'] = $courseBundle->bundle_image;
        }

        if (isset($validateData['products']) && is_array($validateData['products'])) {
            $validateData['products'] = json_encode($validateData['products']);
        }

        $validateData['slug'] = Str::slug($request->input('name'));

        $courseBundle->update($validateData);

        return response()->json([
            'success' => true,
            'message' => 'Course Bundle updated successfully',
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/backend/courses-bundles/{slug}",
     *     tags={"CourseBundles"},
     *     summary="Delete Course Bundles by slug",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         required=true,
     *          @OA\Schema(type="string", example="product-name")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Course Bundles deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Course Bundles deleted successfully")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Course Bundles not found"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */

    public function destroy($slug)
    {
        try {
            $courseBundle = CourseBundle::where('slug', $slug)->firstOrFail();

            if (!$courseBundle) {
                return response()->json([
                    'success' => false,
                    'message' => 'Course Bundle not found'
                ], 404);
            }

            if ($courseBundle->bundle_image) {
                $imagePath = public_path($courseBundle->bundle_image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $courseBundle->delete();

            return response()->json([
                'success' => true,
                'message' => 'Course Bundle deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Server error', 'message' => $th->getMessage()], 500);
        }
    }
}
