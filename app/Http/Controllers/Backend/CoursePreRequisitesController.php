<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DocumentUpload;
use App\Models\ProfilePhoto;
use App\Models\Task;
use App\Models\User;
use App\Models\UserCertification;
use App\Notifications\CoursePreRequisitesNotification;
use App\Notifications\ProfilePhotoUploaded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CoursePreRequisitesController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user->hasRole('Super Admin') || $user->hasRole('Admin')) {

            $query = UserCertification::with('user', 'certification')->orderBy('created_at', 'desc');

            // Apply learner name filter
            if ($request->filled('learner_name')) {
                $query->whereHas('user', function ($q) use ($request) {
                    $nameInput = $request->learner_name;

                    $q->where('name', 'like', '%' . $nameInput . '%')
                        ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$nameInput}%"]);
                });
            }
            if (isset($request->status)) {
                $query->where('status', $request->status);
            }

            $courseprerequisites = $query->paginate(10);
            return view('backend.course-pre-requisites.index', compact('courseprerequisites'));
        } elseif ($user->hasRole('Learner')) {
            $courseprerequisites = UserCertification::where('user_id', $user->id)->first();
            return view('backend.course-pre-requisites.index', compact('courseprerequisites'));
        }
    }

    public function create()
    {
        $courseprerequisites = new UserCertification();
        return view('backend.course-pre-requisites.create', compact('courseprerequisites'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'qualification_type' => 'required',
            'course_certificate' => $request->input('qualification_type') == 'external'
                ? 'required|mimes:jpg,png,pdf|max:2048'
                : 'nullable', // Only required if qualification_type is external
        ], [
            'qualification_type.required' => 'Please select your qualification from the options below.',
            'course_certificate.required' => 'Please upload a document to verify your completed First Aid qualification.',
            'course_certificate.mimes' => 'The course certificate must be a file of type: jpg, png, or pdf.',
            'course_certificate.max' => 'The course certificate may not be greater than 2MB.',
        ]);


        $user = auth()->user();

        $courseprerequisites = new UserCertification();
        $courseprerequisites->user_id = $user->id;

        $courseprerequisites->course_certificate = "empty";
        if ($request->hasFile('course_certificate')) {
            $uploadedFile = $request->file('course_certificate');
            $fileName = auth()->user()->name . '_' . $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('learners' . '/' . $user->name . '/course_certificate/', $fileName, 'public');
            $courseprerequisites->course_certificate = 'storage/' . $filePath;
        }

        $courseprerequisites->certification_id = $request->certification_id;
        $courseprerequisites->qualification_type = $request->qualification_type;
        $courseprerequisites->status = "In Progress";
        $courseprerequisites->save();

        // Send notification to the admin
        $admins = User::role('Super Admin')->get();
        $task_url = route('backend.course-pre-requisites.index');
        $message = 'Course Pre Requisites has been uploaded by ' . $user->name;
        foreach ($admins as $admin) {
            $admin->notify(new CoursePreRequisitesNotification($message, $task_url));
        }

        return view('backend.course-pre-requisites.index', compact('courseprerequisites'));
    }

    public function edit(UserCertification $preRequisites)
    {
        return view('backend.course-pre-requisites.edit', compact('preRequisites'));
    }

    public function update(Request $request, UserCertification $preRequisites)
    {
        $validatedData = $request->validate([
            'qualification_type' => 'required',
            'course_certificate' => $request->input('qualification_type') == 'external'
                ? 'required|mimes:jpg,png,pdf|max:2048'
                : 'nullable', // Only required if qualification_type is external
        ], [
            'qualification_type.required' => 'Please select your qualification from the options below.',
            'course_certificate.required' => 'Please upload a document to verify your completed First Aid qualification.',
            'course_certificate.mimes' => 'The course certificate must be a file of type: jpg, png, or pdf.',
            'course_certificate.max' => 'The course certificate may not be greater than 2MB.',
        ]);

        $user = auth()->user();
        if ($request->hasFile('course_certificate')) {
            // Remove old profile photo if exists
            if ($preRequisites->course_certificate) {
                Storage::disk('public')->delete(str_replace('storage/', '', $preRequisites->course_certificate));
            }

            $uploadedFile = $request->file('course_certificate');
            $fileName = auth()->user()->name . '_' . $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('learners' . '/' . $user->name . '/course_certificate/', $fileName, 'public');
            $preRequisites->course_certificate = 'storage/' . $filePath;
        }
        $preRequisites->status = "In Progress";
        $preRequisites->certification_id = $request->certification_id;
        $preRequisites->qualification_type = $request->qualification_type;
        $preRequisites->save();

        // Send notification to the admin
        $admins = User::role('Super Admin')->get();
        $task_url = route('backend.course-pre-requisites.index');
        $message = 'Certification has been re-uploaded by ' . $user->name;
        foreach ($admins as $admin) {
            $admin->notify(new CoursePreRequisitesNotification($message, $task_url));
        }

        return view('backend.course-pre-requisites.index', compact('preRequisites'));
    }

    public function approve($id)
    {
        $courseprerequisites = UserCertification::findOrFail($id);
        $user = $courseprerequisites->user;
        $courseprerequisites->status = 'Approved';
        $courseprerequisites->comments = '';
        $courseprerequisites->save();

        // Send notification to the learner
        $task_url = route('backend.course-pre-requisites.index');
        $message = 'Certification has been approved';
        $user->notify(new CoursePreRequisitesNotification($message, $task_url));

        return redirect()->back()->with('success', 'Certification has been approved successfully.');
    }

    public function reject(Request $request, $id)
    {
        $courseprerequisites = UserCertification::findOrFail($id);
        $user = $courseprerequisites->user;
        $courseprerequisites->status = 'Rejected';
        $courseprerequisites->comments = $request->comments;
        $courseprerequisites->save();

        // Send notification to learner
        $task_url = route('backend.course-pre-requisites.index');
        $message = 'Certification has been rejected';
        $user->notify(new CoursePreRequisitesNotification($message, $task_url));
        return redirect()->back()->with('error', 'Certification has been rejected.');
    }
}
