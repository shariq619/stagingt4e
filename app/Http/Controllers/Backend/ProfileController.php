<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpdatePasswordRequest;
use App\Http\Requests\Backend\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = User::findOrFail(auth()->user()->id);
        return view('backend.profile.index', compact('profile'));
    }

    public function updateGeneralInformation(UpdateProfileRequest $request, $id)
    {
        if ($id != auth()->user()->id) {
            return back();
        } else {
            $profile = User::findOrFail($id);
            $profile->update($request->all());
            return back()->with('success', 'Profile berhasil diperbarui');
        }
    }

    public function updatePassword(UpdatePasswordRequest $request, $id)
    {
        if ($id != auth()->user()->id) {
            return back();
        } else {
            $profile = User::findOrFail($id);
            $profile->update([
                'password' => Hash::make($request->password)
            ]);
            return back()->with('success', 'Password berhasil diperbarui');
        }
    }

    public function updateImage(Request $request)
    {
        $profile = User::findOrFail(auth()->user()->id);

        $imageName = $profile->image; // Set the default to the current image in the database
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Correct reference to 'image' field
            $uploadedFile = $request->file('image');

            // Create a unique file name
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();

            // Store the file in the 'public' disk under 'profile_images' directory
            $filePath = $uploadedFile->storeAs('profile_images', $fileName, 'public');

            // Save the full path to store in the database
            $imageName = 'storage/' . $filePath;

            $profile->update([
                'image' => $imageName
            ]);
            return back()->with('success', 'Updated successfully');
        } else {
            return back()->with('error', 'Failed to change image');
        }

    }
}
