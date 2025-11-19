<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\CourseEvaluationThankYou;
use App\Models\Cohort;
use App\Models\FormResponse;
use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\User;
use App\Notifications\CourseWorkNotification;
use Dompdf\Dompdf;
use App\Notifications\ApplicationFormNotification;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function show($id, Request $request)
    {


        $task = Task::findOrFail($id);
        $user = auth()->user();
        $formResponse = TaskSubmission::where('user_id', $user->id)
            ->where('task_id', $task->id)
            ->where('cohort_id', $request->cohort_id)
            ->first();

        $learner_response = []; // ✅ Fix: initialize properly as empty array

        if(isset($formResponse)) {
            if ($formResponse->status == "Rejected") {
                $learner_response = json_decode($formResponse->response, true);
            } else {

                if (isset($formResponse)) {
                    $learner_response = json_decode($formResponse->learner_response, true);
                } else {
                    $learner_response = [];
                }
            }
        }


        //dd($learner_response);

        // Get the cohort of the learner related to the task
        // Assuming Task is linked to the cohort through a many-to-many relationship with courses
        $cohort = $user->cohorts()
            ->whereHas('course.tasks', function ($query) use ($task) {
                $query->where('task_id', $task->id);
            })
            ->first();


        if ($cohort) {
            // Get course_id, cohort_id, and trainer_id from the cohort
            $course_id = $request->course_id;
            $cohort_id = $request->cohort_id;
            $trainer_id = $request->trainer_id;
        } else {
            // Handle the case where the cohort is not found
            $course_id = null;
            $cohort_id = null;
            $trainer_id = null;
        }

        $cohort_info = Cohort::with('venue','trainer')->find($request->cohort_id);



        return view('backend.tasks.show', compact('task','learner_response', 'course_id', 'cohort_id', 'trainer_id','cohort_info'));
    }

    public function taskFormPreview(Request $request)
    {
        $user = auth()->user();
        $previewData = $request->all();
        $signatureData = $request->input('signature');
        if ($signatureData) {
            $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
            $signatureData = str_replace(' ', '+', $signatureData);
            $signatureData = 'data:image/png;base64,' . $signatureData;
        } else {
            $signatureData = null;
        }

        $pageNumber = $request->input('page_number', 1);
        $task_name = 'modal_' . Str::snake(strtolower($request->task_name));

        //dd($previewData);


        $html = view('backend.tasks.modals.' . $task_name, [
            'formData' => $previewData,
            'signatureData' => $signatureData,
            'pageNumber' => $pageNumber
        ])->render();
        return response()->json(['html' => $html]);
    }

    public function taskSubmission(Request $request)
    {

        $user = auth()->user();
        $data = $request->all();

        //dd($data);

        $signatureData = $request->input('signature');

        if ($signatureData) {
            $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
            $signatureData = str_replace(' ', '+', $signatureData);
            $signatureData = 'data:image/png;base64,' . $signatureData;
        } else {
            $signatureData = null;
        }

        // Initialize Dompdf with options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Generate PDF
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

        // Add page numbers, user name, and task name to each page
        $canvas = $pdf->getCanvas();
        $font = $pdf->getFontMetrics()->get_font("Roboto", "normal");
        $size = 9; // Smaller font size to ensure clarity

        $pageCount = $pdf->get_canvas()->get_page_count();

        // Positioning variables
        $leftMargin = 50; // User name on the left
        $rightMargin = 50; // Task name on the right
        $bottomMargin = 820; // Increased bottom margin for better clarity
        $centerPosition = $canvas->get_width() / 2; // Center of the page

        for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
            // Page number in the middle
            $pageText = "Page $pageNumber of $pageCount";
            $textWidth = $pdf->getFontMetrics()->getTextWidth($pageText, $font, $size);
            $canvas->page_text($centerPosition - ($textWidth / 2), $bottomMargin, $pageText, $font, $size, array(0, 0, 0));

            // User name on the left corner
            $canvas->page_text($leftMargin, $bottomMargin, $user->name, $font, $size, array(0, 0, 0));

            // Task name on the right corner
            $taskTextWidth = $pdf->getFontMetrics()->getTextWidth($data['task_name'], $font, $size);
            $canvas->page_text($canvas->get_width() - $taskTextWidth - $rightMargin, $bottomMargin, $data['task_name'], $font, $size, array(0, 0, 0));
        }

        $userDirectory = 'learners/' . $user->name;
        $fileName = uniqid() . '.pdf';
        $filePath = $userDirectory . '/' . $fileName;

        // Save the new PDF
        Storage::disk('public')->put($filePath, $pdf->output());

        // Generate the public URL for the new PDF
        $pdfPath = 'storage/' . $filePath;


        $tsk = Task::find($request->task_id);


        // Use updateOrCreate to either update the record or create a new one
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
                // 'response' => '{"data": {}}',
                // 'learner_response' => json_encode($data['data']),
                'response' => json_encode($data),
                'learner_response' => NULL,
                //'trainer_response' => NULL,
                'status' => 'In Progress'
            ]
        );


        // send an email if the course evaluyion form is submitted
        if($request->task_id == 11){
            Mail::to($user->email)->send(new CourseEvaluationThankYou($user));
        }


        // Send notification to the admin
        $admins = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['Super Admin', 'Trainer']);
        })->get();
        $task_url = route('backend.trainer.dashboard');
        $message = $tsk->name . ' has been submitted by ' . $user->name;
        foreach ($admins as $admin) {
            $admin->notify(new CourseWorkNotification($message, $task_url));
        }

        // ✅ Notify Client (owner of the delegate)
        if ($user->client_id) {
            $client = User::find($user->client_id); // Assuming client is also stored in `users` table
            if ($client) {
                $task_url = route('backend.client.dashboard');
                $clientMessage = "Your delegate {$user->name} has submitted {$tsk->name}.";
                $client->notify(new CourseWorkNotification($clientMessage, $task_url));
            }
        }

        // return redirect()->back()->with('success', 'Form submitted successfully');
        return response()->json(['message' => 'Form submitted successfully', 'pdfPath' => asset($pdfPath)]);
    }

    public function display($id)
    {
        $formResponse = FormResponse::findOrFail($id);
        $response = json_decode($formResponse->response, true);

        return view('backend.tasks.display', compact('formResponse', 'response'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $email = null;
        // Iterate through the data to find the email
        foreach ($data as $key => $value) {
            if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $email = $value;
                break;
            }
        }
        $task = Task::where('name', $data['task_name'])->first();
        if ($email && $task) {
            $user = User::where('email', $email)->first();

            if ($user) {
                TaskSubmission::create([
                    'user_id' => $user->id,
                    'task_id' => $task->id,
                    'submission_id' => $data['submission_id'],
                    'form_id' => $data['formID'],
                    'ip' => $data['ip'],
                    'response' => json_encode($data),
                ]);


                // Send notification to the admin
                $admins = User::role('Super Admin')->get();
                $task_url = route('backend.application-forms.index');
                $message = $task->name . ' has been submitted by ' . $user->name;
                foreach ($admins as $admin) {
                    $admin->notify(new ApplicationFormNotification($message, $task_url));
                }



                //return redirect()->route('backend.learner.dashboard')->with('success', 'Form response saved successfully.');
            } else {
                //return redirect()->route('backend.learner.dashboard')->with('success', 'User or Task not found.');
            }
        } else {
            //return redirect()->route('backend.learner.dashboard')->with('success', 'Email not found in the form data.');
        }
    }

    public function saveProgress(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();

        $task = Task::find($request->task_id);

        $formResponse = TaskSubmission::updateOrCreate(
            [
                'user_id' => $user->id,
                'task_id' => $request->task_id,
            ],
            [
                'task_id' => $request->task_id,
                'course_id' => $request->course_id,
                'cohort_id' => $request->cohort_id,
                'trainer_id' => $request->trainer_id,
                'pdf' => '-',
                'response' => '{"data": {}}',
                'learner_response' => json_encode($data['data']),
                'status' => 'Not Submitted',
                'updated_at' => now(),
            ]
        );

        return response()->json(['message' => 'Progress saved successfully']);
    }

}
