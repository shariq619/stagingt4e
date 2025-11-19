<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\CourseEvaluationThankYou;
use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\User;
use App\Notifications\CourseWorkNotification;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Tag(
 *     name="TaskSubmission",
 *     description="Task submission endpoints"
 * )
 */

class TaskController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/task/english-assessment",
     *      tags={"TaskSubmission"},
     *     security={{"bearerAuth":{}}},
     *      summary="Get English assessment data",
     *      description="Returns English Assessment configuration data",
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", example=1),
     *                          @OA\Property(property="question", type="string", example="What is the main purpose of Text A?"),
     *                          @OA\Property(property="desc", type="string", example="Please select one answer. (1 Point)"),
     *                          @OA\Property(property="type", type="string", example="CHECK_BOX"),
     *                          @OA\Property(
     *                              property="options",
     *                              type="array",
     *                              @OA\Items(
     *                                  type="object",
     *                                  @OA\Property(property="label", type="string", example="To describe"),
     *                                  @OA\Property(property="value", type="string", example="a"),
     *                              )
     *                          ),
     *                          @OA\Property(property="placeholder", type="string", example="Type your answer here...", nullable=true),
     *                          @OA\Property(
     *                              property="rules",
     *                              type="object",
     *                              @OA\Property(property="required", type="string", example="Please provide an answer"),
     *                              @OA\Property(
     *                                  property="minLength",
     *                                  type="object",
     *                                  @OA\Property(property="value", type="integer", example=10),
     *                                  @OA\Property(property="message", type="string", example="Answer must be at least 10 characters long")
     *                              )
     *                          )
     *                      )
     *                  )
     *              )
     *          )
     *      )
     * )
     */

    public function EnglishAssessmentController()
    {
        try {
            $data = config('settings.english');
            $response = [
                'questions'  => isset($data[0]) ? $data[0] : [],
                'references' => isset($data[1]) ? $data[1] : [],
            ];

            return response()->json([
                'status' => true,
                'code'   => 200,
                'message' => 'English assessment data fetched successfully',
                'data'   => $response
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching English assessment data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/task/learner-tasks",
     *     tags={"TaskSubmission"},
     *     security={{"bearerAuth": {}}},
     *     summary="Get learner tasks (excluding reminders, empty task_code)",
     *     description="Fetches tasks where type is NOT 'Reminders' and task_code is NULL or empty",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="English Assessment"),
     *                     @OA\Property(property="type", type="string", example="CourseWork"),
     *                     @OA\Property(property="task_code", type="string", nullable=true, example=null),
     *                     @OA\Property(property="user_id", type="integer", nullable=true, example=null),
     *                     @OA\Property(property="created_at", type="string", example="2025-03-28 07:21:13"),
     *                     @OA\Property(property="updated_at", type="string", example="2025-03-28 07:21:13"),
     *                     @OA\Property(property="deleted_at", type="string", nullable=true, example=null)
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Error fetching tasks")
     *         )
     *     )
     * )
     */

    public function getAllLearnerTasks(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'code' => 401,
                'message' => 'User not authenticated',
            ], 401);
        }

        $cohortIds = DB::table('cohort_user')
            ->where('user_id', $user->id)
            ->pluck('cohort_id');

        if ($cohortIds->isEmpty()) {
            return response()->json([
                'success' => true,
                'code'    => 200,
                'data' => [
                    'user_id'   => $user->id,
                    'user_name' => $user->name,
                    'resources' => [],
                ],
                'message' => "{$user->name}: Tasks retrieved successfully",
            ]);
        }

        $rows = DB::table('cohorts as c')
            ->join('courses as crs', 'crs.id', '=', 'c.course_id')
            ->join('course_task as ct', 'ct.course_id', '=', 'crs.id')
            ->join('tasks as t', 't.id', '=', 'ct.task_id')
            ->leftJoin('task_submissions as ts', function ($j) use ($user) {
                $j->on('ts.task_id', '=', 't.id')
                    ->on('ts.cohort_id', '=', 'c.id')
                    ->on('ts.course_id', '=', 'crs.id')
                    ->where('ts.user_id', '=', $user->id);
            })
            ->whereIn('c.id', $cohortIds)
            ->where('t.type', '!=', 'Reminders')
            ->where('t.task_code', '')
            ->select(
                't.id as task_id',
                'crs.id as course_id',
                'c.id as cohort_id',
                'c.trainer_id',
                't.name',
                DB::raw("'task' as resource_type"),
                DB::raw("CASE WHEN ts.id IS NULL THEN 'Not Submitted' ELSE 'Submitted' END as status")
            )
            ->orderBy('c.id')
            ->orderBy('t.id')
            ->get();

        $resources = $rows->map(function ($r) use ($user) {
            return [
                'task_id' => (int)$r->task_id,
                'course_id' => (int)$r->course_id,
                'cohort_id' => (int)$r->cohort_id,
                'trainer_id' => $r->trainer_id ? (int)$r->trainer_id : null,
                'name' => $r->name,
                'enum' => Str::slug($r->name, '_'),
                'resource_type' => 'task',
                'user_id' => (int)$user->id,
                'status' => $r->status,
            ];
        })->values();

        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'resources' => $resources,
            ],
            'message' => "{$user->name}: Tasks retrieved successfully",
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/task/learner/submission",
     *     summary="Submit learner task (JSON to PDF)",
     *     description="Learner submits task data from mobile app. The API generates a PDF from JSON and stores submission in database.",
     *     tags={"TaskSubmission"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"task_id", "course_id", "cohort_id", "task_name", "data"},
     *             @OA\Property(property="task_id", type="integer", example=1, description="Task ID"),
     *             @OA\Property(property="course_id", type="integer", example=5, description="Course ID"),
     *             @OA\Property(property="cohort_id", type="integer", example=65, description="Cohort ID"),
     *             @OA\Property(property="trainer_id", type="integer", example=7, description="Trainer ID (optional)"),
     *             @OA\Property(property="task_name", type="string", example="English Assessment", description="Task name"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 example={
     *                     "Q1": {"To persuade"},
     *                     "Q2": {"2 weeks"},
     *                     "Q3": {"By using temporary traffic lights"}
     *                 },
     *                 description="Form responses as key-value pairs"
     *             ),
     *             @OA\Property(
     *                 property="signature",
     *                 type="string",
     *                 example="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAA...",
     *                 description="Base64-encoded signature image (optional)"
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Task submitted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Task submitted successfully"),
     *             @OA\Property(property="pdf_url", type="string", example="https://yourdomain.com/storage/learners/john_doe/652adf9d3b.pdf"),
     *             @OA\Property(property="submission_id", type="integer", example=105)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="User not authenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="User not authenticated")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Something went wrong"),
     *             @OA\Property(property="error", type="string", example="Detailed error message")
     *         )
     *     )
     * )
     */

    public function submitTask(Request $request)
    {
        try {
            $user = auth()->user();
            $data = $request->all();
            $signatureData = $request->input('signature');

            if ($signatureData) {
                $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
                $signatureData = str_replace(' ', '+', $signatureData);
                $signatureData = 'data:image/png;base64,' . $signatureData;
            } else {
                $signatureData = null;
            }

            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);

            $pdf = new Dompdf();
            $pageNumber = $request->input('page_number', 1);
            $task_name = 'modal_' . Str::snake(strtolower($data['task_name']));

            $html = view('backend.tasks.modals.' . $task_name, [
                'formData' => $data,
                'signatureData' => $signatureData,
                'pageNumber' => $pageNumber
            ])->render();

            $pdf->loadHtml($html);
            $pdf->setPaper('A4', 'portrait');
            $pdf->render();

            $canvas = $pdf->getCanvas();
            $font = $pdf->getFontMetrics()->get_font("Roboto", "normal");
            $size = 9;

            $pageCount = $pdf->get_canvas()->get_page_count();

            $leftMargin = 50;
            $rightMargin = 50;
            $bottomMargin = 820;
            $centerPosition = $canvas->get_width() / 2;

            for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
                $pageText = "Page $pageNumber of $pageCount";
                $textWidth = $pdf->getFontMetrics()->getTextWidth($pageText, $font, $size);
                $canvas->page_text($centerPosition - ($textWidth / 2), $bottomMargin, $pageText, $font, $size, array(0, 0, 0));
                $canvas->page_text($leftMargin, $bottomMargin, $user->name, $font, $size, array(0, 0, 0));

                $taskTextWidth = $pdf->getFontMetrics()->getTextWidth($data['task_name'], $font, $size);
                $canvas->page_text($canvas->get_width() - $taskTextWidth - $rightMargin, $bottomMargin, $data['task_name'], $font, $size, array(0, 0, 0));
            }

            $userDirectory = 'learners/' . $user->name;
            $fileName = uniqid() . '.pdf';
            $filePath = $userDirectory . '/' . $fileName;

            Storage::disk('public')->put($filePath, $pdf->output());

            $pdfPath = 'storage/' . $filePath;
            $tsk = Task::find($request->task_id);
            $taskSubmission = TaskSubmission::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'task_id' => $request->task_id,
                    'cohort_id' => $request->cohort_id,
                ],
                [
                    'course_id' => $request->course_id,
                    'trainer_id' => $request->trainer_id,
                    'pdf' => $pdfPath,
                    'response' => json_encode($data),
                    'learner_response' => NULL,
                    'status' => 'In Progress'
                ]
            );

            if ($request->task_id == 11) {
                Mail::to($user->email)->send(new CourseEvaluationThankYou($user));
            }

            $admins = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['Super Admin', 'Trainer']);
            })->get();
            $task_url = route('backend.trainer.dashboard');
            $message = $tsk->name . ' has been submitted by ' . $user->name;
            foreach ($admins as $admin) {
                $admin->notify(new CourseWorkNotification($message, $task_url));
            }

            if ($user->client_id) {
                $client = User::find($user->client_id);
                if ($client) {
                    $task_url = route('backend.client.dashboard');
                    $clientMessage = "Your delegate {$user->name} has submitted {$tsk->name}.";
                    $client->notify(new CourseWorkNotification($clientMessage, $task_url));
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Form submitted successfully',
                'pdfPath' => asset($pdfPath),
                'submission_id' => $taskSubmission->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Form submission failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/task/ds-refresher-workbook",
     *      tags={"TaskSubmission"},
     *     security={{"bearerAuth":{}}},
     *      summary="Get DS Refresher Workbook data",
     *      description="Returns DS Refresher Workbook configuration data",
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", example=1),
     *                          @OA\Property(property="question", type="string", example="What is the main purpose of Text A?"),
     *                          @OA\Property(property="desc", type="string", example="Please select one answer. (1 Point)"),
     *                          @OA\Property(property="type", type="string", example="CHECK_BOX"),
     *                          @OA\Property(
     *                              property="options",
     *                              type="array",
     *                              @OA\Items(
     *                                  type="object",
     *                                  @OA\Property(property="label", type="string", example="To describe"),
     *                                  @OA\Property(property="value", type="string", example="a"),
     *                              )
     *                          ),
     *                          @OA\Property(property="placeholder", type="string", example="Type your answer here...", nullable=true),
     *                          @OA\Property(
     *                              property="rules",
     *                              type="object",
     *                              @OA\Property(property="required", type="string", example="Please provide an answer"),
     *                              @OA\Property(
     *                                  property="minLength",
     *                                  type="object",
     *                                  @OA\Property(property="value", type="integer", example=10),
     *                                  @OA\Property(property="message", type="string", example="Answer must be at least 10 characters long")
     *                              )
     *                          )
     *                      )
     *                  )
     *              )
     *          )
     *      )
     * )
     */

    public function ds_refresher_workbook()
    {
        try {
            $data = config('settings.ds_refresher_workbook');

            $sections = isset($data['sections'])
                ? array_values(array_filter($data['sections'], 'is_array'))
                : [];

            $response = [
                'sections' => $sections,
                'questions' => $data['questions'] ?? [],
            ];

            return response()->json([
                'status' => true,
                'code'   => 200,
                'message' => 'DS Refresher Workbook data fetched successfully',
                'data'   => $response
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching DS Refresher Workbook data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/task/ds-refresher-workbook-2",
     *      tags={"TaskSubmission"},
     *     security={{"bearerAuth":{}}},
     *      summary="Get DS Refresher Workbook 2 data",
     *      description="Returns DS Refresher Workbook 2 configuration data",
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", example=1),
     *                          @OA\Property(property="question", type="string", example="What is the main purpose of Text A?"),
     *                          @OA\Property(property="desc", type="string", example="Please select one answer. (1 Point)"),
     *                          @OA\Property(property="type", type="string", example="CHECK_BOX"),
     *                          @OA\Property(
     *                              property="options",
     *                              type="array",
     *                              @OA\Items(
     *                                  type="object",
     *                                  @OA\Property(property="label", type="string", example="To describe"),
     *                                  @OA\Property(property="value", type="string", example="a"),
     *                              )
     *                          ),
     *                          @OA\Property(property="placeholder", type="string", example="Type your answer here...", nullable=true),
     *                          @OA\Property(
     *                              property="rules",
     *                              type="object",
     *                              @OA\Property(property="required", type="string", example="Please provide an answer"),
     *                              @OA\Property(
     *                                  property="minLength",
     *                                  type="object",
     *                                  @OA\Property(property="value", type="integer", example=10),
     *                                  @OA\Property(property="message", type="string", example="Answer must be at least 10 characters long")
     *                              )
     *                          )
     *                      )
     *                  )
     *              )
     *          )
     *      )
     * )
     */

    public function ds_refresher_workbook_two()
    {
        try {
            $data = config('settings.ds_refresher_workbook_2');

            $sections = isset($data['sections'])
                ? array_values(array_filter($data['sections'], 'is_array'))
                : [];

            $response = [
                'sections' => $sections,
                'questions' => $data['questions'] ?? [],
            ];

            return response()->json([
                'status' => true,
                'code'   => 200,
                'message' => 'DS Refresher Workbook 2 data fetched successfully',
                'data'   => $response
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching DS Refresher Workbook 2 data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * @OA\Get(
     *      path="/api/task/sg-refresher-questions",
     *      tags={"TaskSubmission"},
     *     security={{"bearerAuth":{}}},
     *      summary="Get SG Refresher questions data",
     *      description="Returns SG Refresher questions configuration data",
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", example=1),
     *                          @OA\Property(property="question", type="string", example="What is the main purpose of Text A?"),
     *                          @OA\Property(property="desc", type="string", example="Please select one answer. (1 Point)"),
     *                          @OA\Property(property="type", type="string", example="CHECK_BOX"),
     *                          @OA\Property(
     *                              property="options",
     *                              type="array",
     *                              @OA\Items(
     *                                  type="object",
     *                                  @OA\Property(property="label", type="string", example="To describe"),
     *                                  @OA\Property(property="value", type="string", example="a"),
     *                              )
     *                          ),
     *                          @OA\Property(property="placeholder", type="string", example="Type your answer here...", nullable=true),
     *                          @OA\Property(
     *                              property="rules",
     *                              type="object",
     *                              @OA\Property(property="required", type="string", example="Please provide an answer"),
     *                              @OA\Property(
     *                                  property="minLength",
     *                                  type="object",
     *                                  @OA\Property(property="value", type="integer", example=10),
     *                                  @OA\Property(property="message", type="string", example="Answer must be at least 10 characters long")
     *                              )
     *                          )
     *                      )
     *                  )
     *              )
     *          )
     *      )
     * )
     */

    public function sg_refresher_questions()
    {
        try {
            $data = config('settings.sg_refresher_questions');

            $sections = isset($data['sections'])
                ? array_values(array_filter($data['sections'], 'is_array'))
                : [];

            $response = [
                'sections' => $sections,
                'questions' => $data['questions'] ?? [],
            ];

            return response()->json([
                'status' => true,
                'code'   => 200,
                'message' => 'SG Refresher questions data fetched successfully',
                'data'   => $response
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching SG Refresher questions data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/task/cctv-activity-questions",
     *      tags={"TaskSubmission"},
     *     security={{"bearerAuth":{}}},
     *      summary="Get CCTV Activity Sheet data",
     *      description="Returns CCTV Activity Sheet configuration data",
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", example=1),
     *                          @OA\Property(property="question", type="string", example="What is the main purpose of Text A?"),
     *                          @OA\Property(property="desc", type="string", example="Please select one answer. (1 Point)"),
     *                          @OA\Property(property="type", type="string", example="CHECK_BOX"),
     *                          @OA\Property(
     *                              property="options",
     *                              type="array",
     *                              @OA\Items(
     *                                  type="object",
     *                                  @OA\Property(property="label", type="string", example="To describe"),
     *                                  @OA\Property(property="value", type="string", example="a"),
     *                              )
     *                          ),
     *                          @OA\Property(property="placeholder", type="string", example="Type your answer here...", nullable=true),
     *                          @OA\Property(
     *                              property="rules",
     *                              type="object",
     *                              @OA\Property(property="required", type="string", example="Please provide an answer"),
     *                              @OA\Property(
     *                                  property="minLength",
     *                                  type="object",
     *                                  @OA\Property(property="value", type="integer", example=10),
     *                                  @OA\Property(property="message", type="string", example="Answer must be at least 10 characters long")
     *                              )
     *                          )
     *                      )
     *                  )
     *              )
     *          )
     *      )
     * )
     */

    public function cctv_activity_questions()
    {
        try {
            $data = config('settings.cctv_activity_section');

            return response()->json([
                'status' => true,
                'code'   => 200,
                'message' => 'CCTV Activity Sheet data fetched successfully',
                'data'   => $data
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching CCTV Activity Sheet data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/task/ds-activity-sheet",
     *      tags={"TaskSubmission"},
     *     security={{"bearerAuth":{}}},
     *      summary="Get DS Activity Sheet Sheet data",
     *      description="Returns DS Activity Sheet Sheet configuration data",
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", example=1),
     *                          @OA\Property(property="question", type="string", example="What is the main purpose of Text A?"),
     *                          @OA\Property(property="desc", type="string", example="Please select one answer. (1 Point)"),
     *                          @OA\Property(property="type", type="string", example="CHECK_BOX"),
     *                          @OA\Property(
     *                              property="options",
     *                              type="array",
     *                              @OA\Items(
     *                                  type="object",
     *                                  @OA\Property(property="label", type="string", example="To describe"),
     *                                  @OA\Property(property="value", type="string", example="a"),
     *                              )
     *                          ),
     *                          @OA\Property(property="placeholder", type="string", example="Type your answer here...", nullable=true),
     *                          @OA\Property(
     *                              property="rules",
     *                              type="object",
     *                              @OA\Property(property="required", type="string", example="Please provide an answer"),
     *                              @OA\Property(
     *                                  property="minLength",
     *                                  type="object",
     *                                  @OA\Property(property="value", type="integer", example=10),
     *                                  @OA\Property(property="message", type="string", example="Answer must be at least 10 characters long")
     *                              )
     *                          )
     *                      )
     *                  )
     *              )
     *          )
     *      )
     * )
     */

    public function door_supervisor_activity_section()
    {
        try {
            $data = config('settings.door_supervisor_activity_section');

            return response()->json([
                'status' => true,
                'code'   => 200,
                'message' => 'DS Activity Sheet data fetched successfully',
                'data'   => $data
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching DS Activity Sheet data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/task/pi-health-questionnaire",
     *      tags={"TaskSubmission"},
     *     security={{"bearerAuth":{}}},
     *      summary="Get PI Health Questionnaire Sheet data",
     *      description="Returns PI Health Questionnaire Sheet configuration data",
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="array",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(property="id", type="integer", example=1),
     *                          @OA\Property(property="question", type="string", example="What is the main purpose of Text A?"),
     *                          @OA\Property(property="desc", type="string", example="Please select one answer. (1 Point)"),
     *                          @OA\Property(property="type", type="string", example="CHECK_BOX"),
     *                          @OA\Property(
     *                              property="options",
     *                              type="array",
     *                              @OA\Items(
     *                                  type="object",
     *                                  @OA\Property(property="label", type="string", example="To describe"),
     *                                  @OA\Property(property="value", type="string", example="a"),
     *                              )
     *                          ),
     *                          @OA\Property(property="placeholder", type="string", example="Type your answer here...", nullable=true),
     *                          @OA\Property(
     *                              property="rules",
     *                              type="object",
     *                              @OA\Property(property="required", type="string", example="Please provide an answer"),
     *                              @OA\Property(
     *                                  property="minLength",
     *                                  type="object",
     *                                  @OA\Property(property="value", type="integer", example=10),
     *                                  @OA\Property(property="message", type="string", example="Answer must be at least 10 characters long")
     *                              )
     *                          )
     *                      )
     *                  )
     *              )
     *          )
     *      )
     * )
     */

    public function pi_ealth_questionnaire()
    {
        try {
            $data = config('settings.pi_health_questionnaire_section');

            return response()->json([
                'status' => true,
                'code'   => 200,
                'message' => 'PI Health Questionnaire fetched successfully',
                'data'   => $data
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching PI Health Questionnaire',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
