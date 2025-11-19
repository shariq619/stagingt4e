<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Questionnaire;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class QuestionnairesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $questionnaires = Questionnaire::when(!empty($search), function ($q) use ($search) {
            return $q->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        })->orderBy('created_at', 'desc')->paginate(50);

        foreach ($questionnaires as $q) {
            $q->suggestion = $this->calculateSuggestion($q);
        }

        return view('backend.questionnaires.index', compact('questionnaires'));
    }

    public function stats()
    {
        $questions = ['question_1', 'question_2', 'question_3', 'question_4', 'question_5', 'question_6'];
        $options = ['A', 'B', 'C'];

        $data = [];

        foreach ($questions as $question) {
            foreach ($options as $option) {
                $count = \App\Models\Questionnaire::where($question, 'like', $option . '.%')->count();
                $data[$question][$option] = $count;
            }
        }

        $totalUsers = \App\Models\Questionnaire::count();

        return view('backend.questionnaires.stats', compact('data','totalUsers'));
    }

    private function calculateSuggestion($questionnaire)
    {
        $counts = ['A' => 0, 'B' => 0, 'C' => 0];

        for ($i = 1; $i <= 6; $i++) {
            $answer = $questionnaire->{"question_{$i}"};

            // Extract A/B/C from answer, assuming you store like: "A. Some answer text"
            if (preg_match('/^(A|B|C)/i', $answer, $match)) {
                $result = strtoupper($match[1]);
                $counts[$result]++;
            }
        }

        $a = $counts['A'];
        $b = $counts['B'];
        $c = $counts['C'];

        // Same logic as JS
        if ($a === $b && $b === $c) {
            return 'Both courses may suit you';
        } elseif ($b === $c && $b > $a) {
            return 'CCTV Operator Course';
        } elseif (max($counts) === $a) {
            return 'Door Supervisor Course';
        } elseif (max($counts) === $b || max($counts) === $c) {
            return 'CCTV Operator Course';
        }

        return 'CCTV Operator Course'; // fallback
    }

}
