<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *     name="Resource",
 *     description="Resources endpoints"
 * )
 */

class ResourceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/backend/resources",
     *     tags={"Resource"},
     *     summary="Get all resources",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of resources"
     *     )
     * )
     */

    public function index()
    {
        try {
            $resources = Resource::with('courses:id,name')->get();

            $data = $resources->map(function ($resource) {
                return [
                    'id' => $resource->id,
                    'name' => $resource->name,
                    'file' => $resource->file,
                    'user_id' => $resource->user_id,
                    'created_at' => $resource->created_at,
                    'updated_at' => $resource->updated_at,
                    'courses' => $resource->courses->pluck('name'),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/backend/resources/{id}",
     *     tags={"Resource"},
     *     summary="Get single venue by id",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Slug of the venue",
     *         @OA\Schema(type="string", example="london")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resource detail"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */

    public function show(Request $request, $id)
    {
        try {
            $resource = Resource::with('courses:id,name')->findOrFail($id);

            if (!$resource) {
                return response()->json([
                    'success' => false,
                    'message' => 'Resource not found'
                ], 404);
            }

            $data = [
                'id' => $resource->id,
                'name' => $resource->name,
                'file' => $resource->file,
                'user_id' => $resource->user_id,
                'created_at' => $resource->created_at,
                'updated_at' => $resource->updated_at,
                'courses' => $resource->courses->pluck('name'),
            ];

            return response()->json([
                'success' => true,
                'message' => 'Resource retrieved successfully',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {

            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'nullable|string|max:255',
                'file' => 'required|mimes:pdf,jpg,jpeg,png,gif',
                'user_id' => 'nullable|integer|exists:users,id',
                'course_ids' => 'required|array',
                'course_ids.*' => 'integer|exists:courses,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $validated = $validator->validated();

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('resources'), $fileName);

            $resource = Resource::create([
                'name' => $validated['name'] ?? null,
                'file' => 'resources/' . $fileName,
                'user_id' => $validated['user_id'] ?? null,
            ]);

            $resource->courses()->attach($validated['course_ids']);

            return response()->json([
                'success' => true,
                'message' => 'Resource created successfully',
                'data' => $resource
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'nullable|string|max:255',
                'file' => 'nullable|mimes:pdf,jpg,jpeg,png,gif',
                'user_id' => 'nullable|integer|exists:users,id',
                'course_ids' => 'required|array',
                'course_ids.*' => 'integer|exists:courses,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $validated = $validator->validated();
            $resource = Resource::findOrFail($id);

            if ($request->hasFile('file')) {
                if ($resource->file && file_exists(public_path($resource->file))) {
                    unlink(public_path($resource->file));
                }

                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('resources'), $fileName);
                $resource->file = 'resources/' . $fileName;
            }

            $resource->name = $validated['name'] ?? $resource->name;
            $resource->user_id = $validated['user_id'] ?? $resource->user_id;
            $resource->save();

            $resource->courses()->sync($validated['course_ids']);

            return response()->json([
                'success' => true,
                'message' => 'Resource updated successfully',
                'data' => $resource
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $resource = Resource::find($id);

            if (!$resource) {
                return response()->json([
                    'success' => false,
                    'message' => 'Resource not found',
                ], 404);
            }

            $resource->courses()->detach();

            if ($resource->file && file_exists(public_path($resource->file))) {
                unlink(public_path($resource->file));
            }

            $resource->delete();

            return response()->json([
                'success' => true,
                'message' => 'Resource deleted successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
