<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * @OA\Tag(name="AssignPermissions",
 *     description="Assign Permissions endpoints"
 * )
 */

class AssignPermissionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/backend/assignpermission",
     *     tags={"AssignPermissions"},
     *     summary="Get all assign permissions",
     *     operationId="getAllAssignPermissions",
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
        $roles = Role::all();
        return response()->json($roles);
    }

    /**
     * @OA\Get(
     *     path="/api/backend/assignpermission/{role}",
     *     tags={"AssignPermissions"},
     *     summary="Get all permissions assigned to a role",
     *     operationId="editRolePermission",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="role",
     *         in="path",
     *         required=true,
     *         description="Role ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="role",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="admin")
     *             ),
     *             @OA\Property(
     *                 property="permissions",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="edit-posts"),
     *                     @OA\Property(property="guard_name", type="string", example="web")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="role_permission_ids",
     *                 type="array",
     *                 @OA\Items(type="integer", example=2)
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=404, description="Role not found")
     * )
     */

    public function editRolePermission(Role $role)
    {
        $permissions = Permission::all();
        $raw_role_permissions = $role->permissions()->get()->toArray();
        $role_permissions = [];

        for ($i = 0; $i < count($raw_role_permissions); $i++) {
            array_push($role_permissions, $raw_role_permissions[$i]['id']);
        }

        return response()->json([
            'role' => $role,
            'permissions' => $permissions,
            'role_permissions' => $role_permissions,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/backend/assignpermission/updaterolepermission",
     *     tags={"AssignPermissions"},
     *     summary="Update role permissions",
     *     security={{"bearerAuth":{}}},
     *     operationId="updateRolePermission",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"role_id", "update_role_permissions"},
     *                 @OA\Property(
     *                     property="role_id",
     *                     type="integer",
     *                     example=1
     *                 ),
     *                 @OA\Property(
     *                     property="update_role_permissions",
     *                     type="array",
     *                     @OA\Items(type="integer"),
     *                     example={1, 2, 3}
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Role permissions updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Role access rights updated successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The role_id field is required.")
     *         )
     *     )
     * )
     */

    public function updateRolePermission(Request $request)
    {
        $request->validate([
            'role_id' => 'required'
        ]);
        try {

            $role = Role::where('id', $request->role_id)
                ->where('guard_name', 'web')
                ->firstOrFail();

            $role->syncPermissions($request->update_role_permissions ?? []);

            return response()->json([
                'status' => 'success',
                'message' => 'Role access rights updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating role permissions: ' . $e->getMessage()
            ], 422);
        }
    }
}
