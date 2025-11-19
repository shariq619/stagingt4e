<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseBundle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseBundleController extends Controller
{
    public function index(Request $request)
    {
        // $slug = CourseBundle::paginate(5);
        // $search = $request->input('search');
        $search = $request->input('search');

        if (!empty($search)) {
            $slug = CourseBundle::where('name', 'like', "%$search%")->paginate(10);
        }else{
            $slug = CourseBundle::paginate(10);
        }

        return view('backend.courses_bundles.index', compact('slug'));
    }

    public function create()
    {
        $courses = Course::get(['id', 'name']);
        return view('backend.courses_bundles.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'products' => 'required|array',
            'short_description' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'long_description' => 'nullable|string',
            'regular_price' => 'required|numeric',
            'vat' => 'nullable|numeric',
            'courses_included' => 'nullable|string',
            'bundle_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $validateData['slug'] = Str::slug($request->input('name'));

        if ($request->hasFile('bundle_image') && $request->file('bundle_image')->isValid()) {
            $uploadedFile = $request->file('bundle_image');
            $originalName = time(). '_' . $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('bundle_images', $originalName, 'public');
            $validateData['bundle_image'] = 'storage/' . $filePath;
        }

        if (isset($validateData['products']) && is_array($validateData['products'])) {
            $validateData['products'] = json_encode($validateData['products']);
        }

        CourseBundle::create($validateData);

        return redirect()->route('backend.courses-bundle.index')->with('success', 'Course Bundle added successfully');
    }


    public function show()
    {
        //
    }

    public function edit(CourseBundle $slug)
    {
        $courses = Course::select('id', 'name')->get()->toArray();
        $productIds = json_decode($slug->products, true);
        return view('backend.courses_bundles.edit', compact('slug', 'courses', 'productIds'));
    }

    public function update(Request $request, CourseBundle $slug)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => Str::slug($request->slug),
            'products' => 'required|array',
            'short_description' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'long_description' => 'nullable|string',
            'regular_price' => 'required|numeric',
            'vat' => 'nullable|numeric',
            'courses_included' => 'nullable|string',
            'bundle_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('bundle_image') && $request->file('bundle_image')->isValid()) {
            if ($slug->bundle_image && file_exists(public_path($slug->bundle_image))) {
                unlink(public_path($slug->bundle_image));
            }

            $uploadedFile = $request->file('bundle_image');
            $originalName = time() . '_' . $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('bundle_images', $originalName, 'public');
            $validateData['bundle_image'] = 'storage/' . $filePath;
        } else {
            $validateData['bundle_image'] = $slug->bundle_image;
        }

        if (isset($validateData['products']) && is_array($validateData['products'])) {
            $validateData['products'] = json_encode($validateData['products']);
        }

        $validateData['slug'] = Str::slug($request->input('name'));

        $slug->update($validateData);

        return redirect()->route('backend.courses-bundle.index')->with('success', 'Course Bundle updated successfully');
    }

    public function destroy(CourseBundle $slug)
    {
        if ($slug->bundle_image && File::exists(public_path($slug->bundle_image))) {
            File::delete(public_path($slug->bundle_image));
        }
        $slug->delete();
        return redirect()->route('backend.courses-bundle.index')->with('success', 'Course Bundle deleted successfully');
    }
}
