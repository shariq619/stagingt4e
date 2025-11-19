<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(name="Qualification",
 * description="Qualifications endpoints"
 * )
 */

class QualificationController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/backend/qualifications",
     *     tags={"Qualification"},
     *     summary="Get all qualifications",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of qualifications"
     *     )
     * )
     */

    public function index()
    {
        try {
            $qualifications = Qualification::all();
            if ($qualifications) {
                return response()->json(['success' => true, 'data' => $qualifications], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Qualification not found'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/backend/qualifications/{id}",
     *     tags={"Qualification"},
     *     summary="Get single qualification by id",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the qualification",
     *         @OA\Schema(type="integer", example="1")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Venue detail"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Venue not found"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */

    public function show($id)
    {
        try {
            $qualification = Qualification::find($id);
            if (!$qualification) {
                return response()->json(['success' => false, 'message' => 'Qualification not found'], 404);
            }

            return response()->json(['success' => true, 'data' => $qualification], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/backend/qualifications",
     *     tags={"Qualification"},
     *     summary="Create a new qualification",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Grand Hall"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="qualification created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:qualifications,name'
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }

            $validatedData = $validator->validated();
            $validatedData['user_id'] = auth()->id();
            Qualification::create($validatedData);

            return response()->json(['success' => true, 'data' => $validatedData], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/backend/qualifications/{id}",
     *     tags={"Qualification"},
     *     summary="Update qualifications by id",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the qualification to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="_method", type="string", default="PUT"),
     *             @OA\Property(property="name", type="string", example="Grand Hall"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Qualification updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Qualification updated successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Qualification not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Qualification not found")
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

    public function update(Request $request, $id)
    {
        try {
            $qualification = Qualification::find($id);
            if (!$qualification) {
                return response()->json(['success' => false, 'message' => 'Qualification not found'], 404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:qualifications,name,' . $id,
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }

            $validatedData = $validator->validated();
            $validatedData['user_id'] = auth()->id();
            $qualification->update($validatedData);

            return response()->json(['success' => true, 'data' => $qualification], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/backend/qualifications/{id}",
     *     tags={"Qualification"},
     *     summary="Delete Qualification",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *          @OA\Schema(type="string", example="1")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Qualification deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Qualification deleted successfully")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Qualification not found"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */

    public function destroy($id)
    {
        try {
            $qualification = Qualification::find($id);
            if (!$qualification) {
                return response()->json(['success' => false, 'message' =>  'Qualification not found'], 404);
            }

            $qualification->delete();
            return response()->json(['success' => true, 'message' => 'Qualification successfully deleted'], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
