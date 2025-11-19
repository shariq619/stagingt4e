<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Learner Exam",
 *     description="Learner Exam endpoints"
 * )
 */

class LearnerExamController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/exams/exam-result",
     *     tags={"Learner Exam"},
     *     summary="Get all exam results for the logged-in learner",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Exam results retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Exam results retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="user_id", type="integer", example=7),
     *                 @OA\Property(property="user_name", type="string", example="John Doe"),
     *                 @OA\Property(
     *                     property="results",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="course_name", type="string", example="Door Supervisor Refresher"),
     *                         @OA\Property(property="exam_name", type="string", example="Principles of working in the private security industry - MCO"),
     *                         @OA\Property(property="exam_code", type="string", example="J/617/9686"),
     *                         @OA\Property(property="type", type="string", example="MCQs"),
     *                         @OA\Property(property="score", type="integer", example=51),
     *                         @OA\Property(property="status", type="string", example="Passed"),
     *                         @OA\Property(property="description", type="string", example="Exam covers principles of private security industry operations.")
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=401),
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="code", type="integer", example=500),
     *             @OA\Property(property="message", type="string", example="Internal server error: SQLSTATE[HY000]...")
     *         )
     *     )
     * )
     */

    public function examsResult()
    {
        try {
            $learner = auth()->user();

            if (!$learner) {
                return response()->json([
                    'status' => 'error',
                    'code' => 401,
                    'message' => 'Unauthenticated'
                ], 401);
            }

            $cohorts = $learner->cohorts()
                ->with(['course', 'course.exams', 'examResults.exam'])
                ->get();

            $examResultsData = [];

            foreach ($cohorts as $cohort) {
                if (!$cohort->course) {
                    continue;
                }

                $examResults = \App\Models\ExamResult::with('exam')
                    ->where('learner_id', $learner->id)
                    ->where('cohort_id', $cohort->id)
                    ->get()
                    ->map(function ($result) use ($cohort) {
                        return [
                            'course_name' => $cohort->course->name ?? 'N/A',
                            'exam_name' => $result->exam->name ?? 'N/A',
                            'exam_code' => $result->exam->exam_code ?? null,
                            'type' => $result->exam->type ?? '',
                            'score' => $result->score ?? 0,
                            'status' => $result->status ?? 'Pending',
                            'description' => $result->exam->description ?? '',
                        ];
                    });

                if ($examResults->isNotEmpty()) {
                    $examResultsData = array_merge($examResultsData, $examResults->toArray());
                }
            }

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Exam results retrieved successfully',
                'data' => [
                    'user_id' => $learner->id,
                    'user_name' => $learner->name,
                    'results' => $examResultsData
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'Internal server error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
