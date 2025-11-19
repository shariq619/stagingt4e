<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamResultController extends Controller
{
    public function examSubmission(Request $request)
    {

        //dd($request->all());

        $validated = $request->validate([
            'learner_id' => 'required|exists:users,id',
            'exam_id' => 'required|exists:exams,id',
            'cohort_id' => 'required|exists:cohorts,id',
            'status' => 'required|in:Passed,Failed',
            'score' => 'nullable',
        ]);


        ExamResult::updateOrCreate(
            [
                'learner_id' => $validated['learner_id'],
                'exam_id' => $validated['exam_id'],
                'cohort_id' => $validated['cohort_id'],
            ],
            [
                'status' => $validated['status'],
                'score' => $validated['score'],
                'user_id' => auth()->user()->id,
            ]
        );

        return response()->json(['message' => 'Exam result updated successfully.']);
        //return redirect()->back()->with('success', 'Exam result updated successfully.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'pk' => 'required|exists:exam_results,id', // Primary key of the row
            'name' => 'required|string|in:score,status', // Column name
            'value' => 'required', // New value
        ]);

        // Find the ExamResult by its ID
        $examResult = ExamResult::findOrFail($request->pk);

        // Update the requested column with the new value
        $examResult->{$request->name} = $request->value;
        $examResult->save();

        return response()->json([
            'success' => true,
            'message' => ucfirst($request->name) . ' updated successfully.',
        ]);
    }

    public function fetchExams(Request $request)
    {
        $learnerId = $request->learner_id;
        $cohortId = $request->cohort_id;

        // Step 1: Get the cohort
        $cohort = \App\Models\Cohort::findOrFail($cohortId);

        // Step 2: Get the course of the cohort
        $course = $cohort->course; // assumes you have a `course()` relationship in Cohort model

        $exams = $course->exams->sortBy(function ($exam) {
            // Defaults
            $code = 0;
            $typeRank = 1; // 0 = MCQ, 1 = Practical

            // Extract code and type from name
            if (preg_match('/\(([^)]+)\)/', $exam->name, $matches)) {
                $parts = explode('/', $matches[1]);
                $code = isset($parts[2]) ? (int)$parts[2] : 0;
            }

            // Determine if it's MCQ or Practical
            if (stripos($exam->name, 'MCQ') !== false) {
                $typeRank = 0;
            }

            // Return a composite key for sorting: code descending, type (MCQ first)
            return sprintf('%05d-%d', 99999 - $code, $typeRank);
        })->values(); // reset keys

        // Step 4: Get existing results (if any)
        $results = \App\Models\ExamResult::where('learner_id', $learnerId)
            ->where('cohort_id', $cohortId)
            ->get()
            ->keyBy('exam_id');

        return view('backend.partials.exam-modal-body', compact('exams', 'results', 'learnerId', 'cohortId'))->render();
    }


    public function bulkStore(Request $request)
    {
        foreach ($request->input('exams', []) as $examData) {
            $validated = Validator::make($examData, [
                'learner_id' => 'required|exists:users,id',
                'exam_id' => 'required|exists:exams,id',
                'cohort_id' => 'required|exists:cohorts,id',
                'status' => 'required|in:Passed,Failed',
                'score' => 'nullable|numeric',
            ])->validate();

            ExamResult::updateOrCreate(
                [
                    'learner_id' => $validated['learner_id'],
                    'exam_id' => $validated['exam_id'],
                    'cohort_id' => $validated['cohort_id'],
                ],
                [
                    'status' => $validated['status'],
                    'score' => $validated['score'],
                    'user_id' => auth()->id(),
                ]
            );
        }

        return response()->json(['success' => true, 'message' => 'Exam results saved successfully.']);
    }


}
