<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\AwardingBody;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(name="AwardingBody",
 * description="Awarding Bodies endpoints"
 * )
 */

class AwardingBodyController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/backend/awarding_bodies",
     *     tags={"AwardingBody"},
     *     summary="Get all awarding bodies",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of awarding bodies"
     *     )
     * )
     */

    public function index()
    {
        try {
            $awardingBodies =  AwardingBody::all();
            return response()->json([
                'success' => true,
                'data' => $awardingBodies
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
     *     path="/api/backend/awarding_bodies/{id}",
     *     tags={"AwardingBody"},
     *     summary="Get single awarding body by id",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the awarding body",
     *         @OA\Schema(type="integer", example="1")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="awarding body detail"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="awarding body not found"
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
            $awardingBodie =  AwardingBody::find($id);
            if (!$awardingBodie) {
                return response()->json([
                    'success' => false,
                    'message' => 'AwardingBody not found'
                ]);
            }
            return response()->json([
                'success' => true,
                'data' => $awardingBodie
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/backend/awarding_bodies",
     *     tags={"AwardingBody"},
     *     summary="Create a new awarding body",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Grand awarding body Hall"),
     *             @OA\Property(property="description", type="string", example="description"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Awarding Body created successfully"
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
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);
            $validatedData = $validator->validate();
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            $validatedData['user_id'] = auth()->id();
            AwardingBody::create($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'AwardingBody Created Successfully',
                'data' => $validatedData
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/backend/awarding_bodies/{id}",
     *     tags={"AwardingBody"},
     *     summary="Update awarding body by id",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="awarding body id",
     *         required=true,
     *         @OA\Schema(type="integer", example="1")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Grand awarding body Hall"),
     *             @OA\Property(property="description", type="string", example="description"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="awarding body updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="awarding body updated successfully"),
     *             @OA\Property(property="awardingbody", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Awarding body not found"
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

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $awardingBody = AwardingBody::find($id);
            if (!$awardingBody) {
                return response()->json([
                    'success' => false,
                    'message' => 'AwardingBody not found'
                ], 404);
            }

            $awardingBody->update([
                'name' => $request->name,
                'description' => $request->description,
                'user_id' => auth()->id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'AwardingBody Updated Successfully',
                'data' => $awardingBody
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/backend/awarding_bodies/{id}",
     *     tags={"AwardingBody"},
     *     summary="Delete Awarding Body by id",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *          @OA\Schema(type="integer", example="1")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Awarding Body deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Awarding Body deleted successfully")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Awarding Body not found"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */

    public function destroy($id)
    {
        try {
            $awardingBody = AwardingBody::find($id);
            if (!$awardingBody) {
                return response()->json([
                    'success' => false,
                    'message' => 'AwardingBody not found'
                ], 404);
            }
            $awardingBody->delete();
            return response()->json([
                'success' => true,
                'message' => 'AwardingBody Deleted Successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
