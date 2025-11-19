<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Tag(
 *     name="Resources",
 *     description="Get user-specific flipbook resources"
 * )
 */

class ResourceController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/resources",
     *     tags={"Resources"},
     *     summary="Get user-specific flipbook resources",
     *     description="Retrieve all flipbook resources (tasks and resources) assigned to the authenticated user",
     *     operationId="getFlipbookResources",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="user_id", type="integer", example=123),
     *                 @OA\Property(property="user_name", type="string", example="John Doe"),
     *                 @OA\Property(property="resources", type="array",
     *                     @OA\Items(
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="name", type="string", example="DS Distance Learning Booklet"),
     *                         @OA\Property(property="type", type="string", example="Flip Book"),
     *                         @OA\Property(property="description", type="string", example="This Distance Learning Booklet supports learners preparing for..."),
     *                         @OA\Property(property="flipbook_url", type="string", example="http://yourdomain.com/backend/flipbook/view/1"),
     *                         @OA\Property(property="resource_type", type="string", example="task")
     *                     )
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Flipbook resources retrieved successfully for user: John Doe")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="User not authenticated")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Failed to retrieve resources"),
     *             @OA\Property(property="error", type="string", example="Error message details")
     *         )
     *     )
     * )
     */

    public function getFlipbookResources(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            $flipbookTaskNames = [
                'DS Distance Learning Booklet',
                'CCTV Distance Learning Booklet',
                'DS Top-Up Textbook',
                'SG Top-Up Textbook',
                'Security Guard Course book',
                'DS Refresher Coursebook',
            ];

            $tasks = Task::whereIn('name', $flipbookTaskNames)
                ->where('type', '!=', 'Reminders')
                ->whereHas('courses.cohorts.users', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->distinct()
                ->get()
                ->map(function ($task) {
                    return [
                        'id' => $task->id,
                        'name' => $task->name,
                        'description' => $this->getTaskDescription($task->name),
                        'flipbook_url' => $task->task_code
                            ? asset($task->task_code)
                            : null,
                        'resource_type' => 'task'
                    ];
                });


            $resources = Resource::with('courses')
                ->get()
                ->map(function ($resource) {
                    return [
                        'id' => $resource->id,
                        'name' => $resource->name,
                        'description' => $resource->description ?? '',
                        'flipbook_url' => $resource->file
                            ? asset($resource->file)
                            : null,
                        'resource_type' => 'resource'
                    ];
                });

            $allResources = $tasks->merge($resources);

            return response()->json([
                'success' => true,
                'data' => [
                    'user_id' => $user->id,
                    'user_name' => $user->name,
                    'resources' => $allResources
                ],
                'message' => 'Flipbook resources retrieved successfully for user: ' . $user->name
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve resources',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function getTaskDescription($taskName)
    {
        switch ($taskName) {
            case 'DS Top-Up Textbook':
                return 'Self-study textbook designed for individuals pursuing the Highfield Level 2 Award for Door Supervisors in the Private Security Industry. It focuses on the principles of using equipment relevant to door supervisors.';

            case 'SG Top-Up Textbook':
                return 'This textbook supports learners preparing for the Highfield Level 2 Award for Security Officers in the Private Security Industry (Top-Up), focusing on minimizing personal risk for security officers.';

            case 'DS Distance Learning Booklet':
                return 'This Distance Learning Booklet supports learners preparing for the Highfield Level 2 Award for Door Supervisors in the Private Security Industry. It focuses on Module 1: Principles of Working in the Private Security Industry.';

            case 'CCTV Distance Learning Booklet':
                return 'This Distance Learning Booklet supports learners preparing for the Highfield Level 2 Award for CCTV Operators in the Private Security Industry. It focuses on Module 1: Principles of Working in the Private Security Industry.';

            default:
                return 'No description available.';
        }
    }
}
