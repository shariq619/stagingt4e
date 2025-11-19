<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TaskSubmission;
use Illuminate\Http\Request;

class BackendCourseEvaluationFormController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $course_id = $request->get('course_id');
        $cohort_id = $request->get('cohort_id');
        $venue_id = $request->get('venue_id');
        $trainer_id = $request->get('trainer_id');

        $query = TaskSubmission::with('user', 'course', 'cohort', 'task')
            ->where('task_id', 11)
            ->orderBy('created_at', 'desc');

        // Apply search filter
        if (!empty($search)) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$search}%"]);
            });
        }
        if (!empty($course_id)) {
            $query->where('course_id', $course_id);
        }
        if (!empty($trainer_id)) {
            $query->where('trainer_id', $trainer_id);
        }
        if (!empty($cohort_id)) {
            $query->where('cohort_id', $cohort_id);
        }
        if (!empty($venue_id)) {
            $query->where(function ($q) use ($venue_id) {
                $q->whereHas('cohort', function ($cq) use ($venue_id) {
                    $cq->where('venue_id', $venue_id);
                })
                    ->orWhereRaw("JSON_EXTRACT(response, '$.data.venue_id') = ?", [$venue_id]);
            });
        }

        $responses = $query->paginate(100);


        // Calculate statistics
        $stats = [
            'total_responses' => TaskSubmission::where('task_id', 11)->count(),
            'meet_expectations' => $this->calculatePercentage($responses, 'Q4. Did the course meet your expectations?', 'Yes'),
            'avg_ratings' => $this->calculateAverageRatings($responses),
            'recommendation_rate' => $this->calculatePercentage($responses, 'Q13. Would you recommend this course to others?', 'Yes'),
            'take_another_course' => $this->calculatePercentage($responses, 'Q14. Would you take another course by the Training4Employment?', 'Yes'),
            'popular_courses' => $this->getPopularCourses($responses),
        ];


        return view('backend.course-evaluation-form.index', compact('responses', 'stats'));
    }

    private function calculatePercentage($responses, $question, $positiveAnswer)
    {
        $total = 0;
        $positive = 0;

        foreach ($responses as $response) {
            $data = json_decode($response->response, true);
            if (isset($data['data'][$question])) {
                $total++;
                if (in_array($positiveAnswer, (array)$data['data'][$question])) {
                    $positive++;
                }
            }
        }

        return $total > 0 ? round(($positive / $total) * 100) : 0;
    }

    private function calculateAverageRatings($responses)
    {
        $ratings = [
            'Q5' => ['Exercise and Practical Training' => 0, 'Presentation and Course Materials' => 0, 'Use of Class Time' => 0],
            'Q6' => ['Joining Instructions/ Pre-Course Materials' => 0, 'Members of Staff (other than Trainer)' => 0, 'Venue/Facilities)' => 0],
            'Q11' => ['Knowledge of Subject Matter' => 0, 'Overall Trainer Rating' => 0, 'Presentation and Delivery Skills)' => 0],
        ];

        $count = 0;

        foreach ($responses as $response) {
            $data = json_decode($response->response, true);
            if (isset($data['data'])) {
                $count++;

                // Q5 Ratings
                foreach ($ratings['Q5'] as $key => $value) {
                    if (isset($data['data']['Q5. Did the course meet your expectations?'][$key][0])) {
                        $ratingValue = $this->ratingToNumber($data['data']['Q5. Did the course meet your expectations?'][$key][0]);
                        $ratings['Q5'][$key] += $ratingValue;
                    }
                }

                // Q6 Ratings
                foreach ($ratings['Q6'] as $key => $value) {
                    if (isset($data['data']['Q6. How would you rate your Overall impressions?'][$key][0])) {
                        $ratingValue = $this->ratingToNumber($data['data']['Q6. How would you rate your Overall impressions?'][$key][0]);
                        $ratings['Q6'][$key] += $ratingValue;
                    }
                }

                // Q11 Ratings
                foreach ($ratings['Q11'] as $key => $value) {
                    if (isset($data['data']['Q11. How would you rate the trainer\'s performance?'][$key][0])) {
                        $ratingValue = $this->ratingToNumber($data['data']['Q11. How would you rate the trainer\'s performance?'][$key][0]);
                        $ratings['Q11'][$key] += $ratingValue;
                    }
                }
            }
        }

        // Calculate averages
        foreach ($ratings as $question => $categories) {
            foreach ($categories as $category => $total) {
                $ratings[$question][$category] = $count > 0 ? round($total / $count, 1) : 0;
            }
        }

        return $ratings;
    }

    private function ratingToNumber($rating)
    {
        $ratingMap = [
            'Excellent' => 5,
            'Very Good' => 4,
            'Good' => 3,
            'Fair' => 2,
            'Poor' => 1
        ];

        return $ratingMap[$rating] ?? 0;
    }

    private function getPopularCourses($responses)
    {
        $courses = [];

        foreach ($responses as $response) {
            $data = json_decode($response->response, true);
            if (isset($data['data']['Q15. Please state which course you would be interested in'])) {
                $interestedCourses = (array)$data['data']['Q15. Please state which course you would be interested in'];
                foreach ($interestedCourses as $course) {
                    if (!empty($course)) {
                        $courses[$course] = ($courses[$course] ?? 0) + 1;
                    }
                }
            }
        }

        arsort($courses);
        return array_slice($courses, 0, 5); // Top 5 courses
    }

    public function show($id)
    {
        $response = TaskSubmission::findOrFail($id);
        $data = json_decode($response->response, true);

        return view('backend.course-evaluation-form.show', compact('response', 'data'));
    }
}
