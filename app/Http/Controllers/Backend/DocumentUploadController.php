<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DocumentUpload;
use App\Models\ProfilePhoto;
use App\Models\Task;
use App\Models\User;
use App\Notifications\DocumentUploaded;
use App\Notifications\ProfilePhotoUploaded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentUploadController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user->hasRole('Super Admin') || $user->hasRole('Admin')) {

            $query = DocumentUpload::with('user')->orderBy('created_at', 'desc');

            // Apply learner name filter
            if ($request->filled('learner_name')) {
                $query->whereHas('user', function ($q) use ($request) {
                    $nameInput = $request->learner_name;

                    $q->where('name', 'like', '%' . $nameInput . '%')
                        ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$nameInput}%"]);
                });
            }

            // Apply status filter
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $users_documents = $query->paginate(10);
            $userTask = $documents = [];

            return view('backend.document-uploads.admin_view', compact('documents', 'users_documents', 'userTask'));

        } elseif ($user->hasRole('Learner')) {
            $documents = DocumentUpload::where('user_id', $user->id)->first();
            $users_documents = [];
            return view('backend.document-uploads.index', compact('documents', 'users_documents'));
        }
    }

    public function create()
    {
        $documents = new DocumentUpload();
        return view('backend.document-uploads.create', compact('documents'));
    }

    public function store(Request $request)
    {
        // dd($request->toArray());
        $user = auth()->user();

        // Validate the request data
        $validatedData = $request->validate([
            'first_option' => 'required',
            'second_option' => 'required|array|min:2',
            'first_front_upload' => 'required|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
            'second_front_upload' => 'required|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
            'third_front_upload' => 'required|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
        ], [
            'first_option.required' => 'Please select at least one option from Group A Documents',
            'second_option.required' => 'Please select at least two options from Group B Documents',
            'second_option.min' => 'Please select at least two options from Group B Documents',
            'first_front_upload.required' => 'Please upload Group A Front Side Document',
            'second_front_upload.required' => 'Please upload Group B 1st Document Front Side',
            'third_front_upload.required' => 'Please upload Group B 2nd Document Front Side',
        ]);

        $document = new DocumentUpload();
        $document->user_id = auth()->id();
        $document->first_option = $request->first_option;
        $document->second_option = implode(',', $request->second_option); // Assuming second_option is an array

        $fileFields = [
            'first_front_upload',
            'first_back_upload',
            'second_front_upload',
            'second_back_upload',
            'third_front_upload',
            'third_back_upload'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $uploadedFile = $request->file($field);
                $fileName = auth()->user()->name . time() . '_' . $uploadedFile->getClientOriginalName();
                $filePath = $uploadedFile->storeAs('learners' . '/' . auth()->user()->name . '_' . auth()->user()->last_name . '/proof_of_id/', $fileName, 'public');
                $document->{$field} = 'storage/' . $filePath;
            }
        }
        $document->status = 'In Progress';
        $document->save();

        // Send notification to the admin
        $admins = User::role('Super Admin')->get();
        $task_url = route('backend.document-uploads.index');
        $message = 'Proof ID has been uploaded by ' . $user->name;
        foreach ($admins as $admin) {
            $admin->notify(new DocumentUploaded($message, $task_url));
        }

        // return response()->json([
        //     'message' => 'Proof of ID added successfully.',
        //     'url' => route('backend.document-uploads.index')
        // ], 200);
        return redirect()->route('backend.document-uploads.index')->with('success', 'Proof of ID added successfully.');
    }

    public function edit(DocumentUpload $documentUpload)
    {
        return view('backend.document-uploads.edit', compact('documentUpload'));
    }

    public function update(Request $request, DocumentUpload $documentUpload)
    {
        $user = auth()->user();

        // Validate the request data, make file fields nullable
        $validatedData = $request->validate([
            'first_option' => 'required',
            'second_option' => 'required|array|min:2',
            'first_front_upload' => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
            'first_back_upload' => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
            'second_front_upload' => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
            'second_back_upload' => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
            'third_front_upload' => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
            'third_back_upload' => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
        ]);

        // Update basic fields
        $documentUpload->user_id = auth()->id();
        $documentUpload->first_option = $request->first_option;
        $documentUpload->second_option = implode(',', $request->second_option);

        // Handle file upload and deletion
        $fileFields = [
            'first_front_upload',
            'first_back_upload',
            'second_front_upload',
            'second_back_upload',
            'third_front_upload',
            'third_back_upload'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if ($documentUpload->{$field}) {
                    $oldFile = public_path($documentUpload->{$field});
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                // Store new file
                $uploadedFile = $request->file($field);
                $fileName = auth()->user()->name . time() . '_' . $uploadedFile->getClientOriginalName();
                $filePath = $uploadedFile->storeAs('learners' . '/' . auth()->user()->name . '_' . auth()->user()->last_name . '/proof_of_id/', $fileName, 'public');

                // Save the new file path
                $documentUpload->{$field} = 'storage/' . $filePath;
            }
        }

        // Update status and comments
        $documentUpload->status = 'In Progress';
        $documentUpload->comments = '';

        // Save the document upload record
        $documentUpload->save();

        // Notify admins
        $admins = User::role('Super Admin')->get();
        $task_url = route('backend.document-uploads.index');
        $message = 'Proof ID has been uploaded by ' . $user->name;
        foreach ($admins as $admin) {
            $admin->notify(new DocumentUploaded($message, $task_url));
        }

        return redirect()->route('backend.document-uploads.index')->with('success', 'Proof of ID updated successfully.');
    }

    public function approve($id)
    {
        $proofID = DocumentUpload::findOrFail($id);
        $user = $proofID->user;
        $proofID->status = 'Approved';
        $proofID->comments = "";
        $proofID->save();


        // Send notification to the learner
        $task_url = route('backend.document-uploads.index');
        $message = 'Proof of ID has been approved';
        $user->notify(new DocumentUploaded($message, $task_url));

        return redirect()->back()->with('success', 'Proof of ID approved successfully.');
    }

    public function reject(Request $request, $id)
    {
        $proofID = DocumentUpload::findOrFail($id);
        $user = $proofID->user;
        $proofID->status = 'Rejected';

        $proofID->rejected_documents = $request->input('rejected_documents', []);
        $proofID->comments = $request->comments;
        $proofID->save();

        // Send notification to learner
        $task_url = route('backend.document-uploads.index');
        $message = 'Proof of ID has been rejected';
        $user->notify(new DocumentUploaded($message, $task_url));

        return redirect()->back()->with('error', 'Proof of ID has been rejected.');
    }
}
