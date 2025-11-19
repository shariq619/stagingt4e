<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProfilePhoto;
use App\Models\User;
use App\Notifications\ProfilePhotoUploaded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePhotoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $user = auth()->user();
        if ($user->hasRole('Super Admin') || $user->hasRole('Admin')) {

            $query = ProfilePhoto::with('user');

            if (!empty($search)) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$search}%"]);
                });
            }
            if (isset($request->status)) {
                $query->where('status', $request->status);
            }

            $users_profile_photos = $query->orderBy('created_at', 'desc')->paginate(10);

            //$users_profile_photos = ProfilePhoto::with('user')->orderBy('created_at', 'desc')->paginate(10);
            return view('backend.profile_photo.index', compact('users_profile_photos'));
        } elseif ($user->hasRole('Learner')) {
            $profile_photo = ProfilePhoto::where('user_id', $user->id)->first();
            return view('backend.profile_photo.index', compact('profile_photo'));
        }
    }
    public function create()
    {
        $profilePhoto = new ProfilePhoto();
        return view('backend.profile_photo.create', compact('profilePhoto'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,webp,jpg,gif,svg|max:2048',
        ]);

        $user = auth()->user();

        $profilePhoto = new ProfilePhoto();
        $profilePhoto->user_id = $user->id;

        if ($request->hasFile('profile_photo')) {
            $uploadedFile = $request->file('profile_photo');
            $fileName = auth()->user()->name . '_' . $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('learners' . '/' . auth()->user()->name . '_' . auth()->user()->last_name . '/profile_photo/', $fileName, 'public');
            $profilePhoto->profile_photo = 'storage/' . $filePath;
        }

        $profilePhoto->status = "In Progress";
        $profilePhoto->save();

        // Send notification to the admin
        $admins = User::role('Super Admin')->get();
        $task_url = route('backend.profile-photo.index');
        $message = 'Profile photo has been uploaded by ' . $user->name;
        foreach ($admins as $admin) {
            $admin->notify(new ProfilePhotoUploaded($message, $task_url));
        }

        return response()->json([
            'message' => 'Profile photo updated successfully.',
            'url' => route('backend.profile-photo.index')
        ], 200);
    }

    public function edit(ProfilePhoto $profile_photo)
    {
        return view('backend.profile_photo.edit', compact('profile_photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfilePhoto $profile_photo)
    {
        $validatedData = $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',
        ]);
        $user = auth()->user();
        if ($request->hasFile('profile_photo')) {
            // Remove old profile photo if exists
            if ($profile_photo->profile_photo) {
                Storage::disk('public')->delete(str_replace('storage/', '', $profile_photo->profile_photo));
            }

            $uploadedFile = $request->file('profile_photo');
            $fileName = auth()->user()->name . '_' . $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('learners' . '/' . auth()->user()->name . '_' . auth()->user()->last_name . '/profile_photo/', $fileName, 'public');
            $profile_photo->profile_photo = 'storage/' . $filePath;
        }
        $profile_photo->status = "In Progress";
        $profile_photo->save();

        // Send notification to the admin
        $admins = User::role('Super Admin')->get();
        $task_url = route('backend.profile-photo.index');
        $message = 'Profile photo has been re-uploaded by ' . $user->name;
        foreach ($admins as $admin) {
            $admin->notify(new ProfilePhotoUploaded($message, $task_url));
        }

        return response()->json([
            'message' => 'Profile photo updated successfully.',
            'url' => route('backend.profile-photo.index')
        ], 200);
    }

    public function approve($id)
    {
        $profilePhoto = ProfilePhoto::findOrFail($id);
        $user = $profilePhoto->user;
        $profilePhoto->status = 'Approved';
        $profilePhoto->comments = '';
        $profilePhoto->save();

        // Send notification to the learner
        $task_url = route('backend.profile-photo.index');
        $message = 'Profile photo has been approved';
        $user->notify(new ProfilePhotoUploaded($message, $task_url));

        return redirect()->back()->with('success', 'Profile photo approved successfully.');
    }

    public function reject(Request $request, $id)
    {
        $profilePhoto = ProfilePhoto::findOrFail($id);
        $user = $profilePhoto->user;
        $profilePhoto->status = 'Rejected';
        $profilePhoto->comments = $request->comments;
        $profilePhoto->save();

        // Send notification to learner
        $task_url = route('backend.profile-photo.index');
        $message = 'Profile photo has been rejected';
        $user->notify(new ProfilePhotoUploaded($message, $task_url));
        return redirect()->back()->with('error', 'Profile photo rejected.');
    }
}
