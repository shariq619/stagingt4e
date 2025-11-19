<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TaskSubmission;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = auth()->user();
        $client_learners = $client->learners;
        //dd($client_learners);

        foreach($client_learners as $learner){

            $cohorts = $learner->cohorts()
                ->with(['course.tasks','course.licenses']) // Load the course with its associated tasks
                ->get();

            //dd($cohorts);

            $dashboardData = [];
            foreach ($cohorts as $cohort) {
                $courseData = [];

                if ($cohort->course) {
                    $courseData['id'] = $cohort->course->id;
                    $courseData['trainer_id'] = $cohort->trainer_id;
                    $courseData['date_enrolled'] = $cohort->pivot->created_at;
                    $courseData['name'] = $cohort->course->name;
                    $courseData['cohort_status'] = $cohort->status;
                    $courseData['venue_name'] = $cohort->venue->venue_name;

                    $courseData['tasks'] = $cohort->course->tasks->map(function ($task) use ($learner, $cohort) {
                        // Check if the learner has submitted this task
                        $submission = TaskSubmission::where('user_id', $learner->id)
                            ->where('task_id', $task->id)
                            ->where('cohort_id', $cohort->id)
                            ->first();

                        return [
                            'id' => $task->id,
                            'name' => $task->name,
                            'type' => $task->type,
                            'status' => $submission ? $submission->status : 'Not Submitted', // Fetch task submission status
                            'comments' => $submission ? $submission->comments : null, // Fetch comments, if any
                            'submission_id' => $submission ? $submission->id : null, // Fetch comments, if any
                        ];
                    });

                    // Fetch licenses
                    $courseData['licenses'] = $cohort->course->licenses->map(function ($license) use ($learner, $cohort) {


                        //dd($learner->id,$cohort->id,$license->id);

                        // Check if the learner has submitted this task
                        $submission = TaskSubmission::where('user_id', $learner->id)
                            ->where('cohort_id', $cohort->id)
                            ->where('course_id', $cohort->course->id)
                            ->where('license_id', $license->id)
                            ->first();

                        if(isset($submission)) {

                            //dd($submission);

                            return [
                                'id' => $license->id,
                                'name' => $license->name,
                                'scorm_registration_id' => $submission->scorm_registration_id,
                                'scorm_course_id' => $submission->scorm_course_id,
                                'scorm_course_link' => $submission->scorm_course_link,
                            ];

                        }


                    });

                } else {
                    $courseData['id'] = $cohort->course->id;
                    $courseData['trainer_id'] = $cohort->trainer_id;
                    $courseData['name'] = null; // No course assigned
                    $courseData['tasks'] = collect(); // Empty collection for tasks
                    $courseData['licenses'] = collect(); // Empty collection for licenses
                }

                $cuser = $cohort->users;

                $dashboardData[] = [
                    'cohort_id' => $cohort->id,
                    'start_date_time' => $cohort->start_date_time,
                    'end_date_time' => $cohort->end_date_time,
                    'course' => $courseData,
                ];
            }
        }


        $recentCohorts = collect();

        foreach ($client->learners as $learner) {
            $recentCohorts = $recentCohorts->merge(
                $learner->cohorts()->with('course')
                    ->orderByDesc('created_at')
                    ->get()
            );
        }

        // Sort and take top 5
        $recentCohorts = $recentCohorts->sortByDesc('created_at')->take(5);
        $activeCourses = $recentCohorts->where('is_soldout',0)->sortByDesc('created_at')->count();




        $client_learners_count = $client->learners->count();

        $unreadCount = auth()->user()->receivedMessages()->where('is_read', 0)->count();
        $readCount = auth()->user()->receivedMessages()->where('is_read', 1)->count();

        return view('backend.client_dashboard.index',compact('client_learners','client_learners_count','readCount','unreadCount','recentCohorts','activeCourses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
