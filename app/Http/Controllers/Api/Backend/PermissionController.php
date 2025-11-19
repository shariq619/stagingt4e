<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

/**
 * @OA\Tag(name="Permissions",
 * description="Permissions endpoints"
 * )
 */


class PermissionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/backend/permissions",
     *     tags={"Permissions"},
     *     summary="Get all permissions",
     *     operationId="getAllPermissions",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="edit-posts"),
     *                     @OA\Property(property="guard_name", type="string", example="web")
     *                 )
     *             ),
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(property="total", type="integer", example=25)
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */

    public function index()
    {
        try {
            $permissions = Permission::paginate(10);
            return response()->json($permissions);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Server error', 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/backend/permissions",
     *     tags={"Permissions"},
     *     summary="Create a new permission",
     *     operationId="createPermission",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "guard_name"},
     *             @OA\Property(property="name", type="string", example="edit-posts"),
     *             @OA\Property(property="guard_name", type="string", example="web")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Permission created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Permission added successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="edit-posts"),
     *                 @OA\Property(property="guard_name", type="string", example="web")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=403, description="Forbidden")
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
            'guard_name' => 'required|string'
        ]);

        try {
            $permission = Permission::create($request->only(['name', 'guard_name']));
            return response()->json([
                'message' => 'Permission added successfully',
                'data' => $permission
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/backend/permissions/{id}",
     *     tags={"Permissions"},
     *     summary="Update permission",
     *     operationId="updatePermission",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="edit-posts"),
     *             @OA\Property(property="guard_name", type="string", example="web")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Permission updated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Permission updated successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="edit-posts"),
     *                 @OA\Property(property="guard_name", type="string", example="web")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=404, description="Permission not found"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $permission->id,
            'guard_name' => 'required|string'
        ]);

        try {
            $permission->update($request->only(['name', 'guard_name']));
            return response()->json([
                'message' => 'Permission updated successfully',
                'data' => $permission
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/backend/permissions/{id}",
     *     tags={"Permissions"},
     *     summary="Get permission by ID",
     *     operationId="getPermissionById",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Permission detail",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Permission retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="edit-posts"),
     *                 @OA\Property(property="guard_name", type="string", example="web")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=404, description="Permission not found")
     * )
     */
    public function show(Permission $permission)
    {
        return response()->json([
            'message' => 'Permission retrieved successfully',
            'data' => $permission
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/backend/permissions/{id}",
     *     tags={"Permissions"},
     *     summary="Delete permission",
     *     operationId="deletePermission",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Permission deleted",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Permission deleted successfully")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Permission not found")
     * )
     */
    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
            return response()->json(['message' => 'Permission deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error', 'message' => $e->getMessage()], 500);
        }
    }
}
