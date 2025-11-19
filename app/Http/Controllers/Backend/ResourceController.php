<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Methodology;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $resources = Resource::when($search, function($query, $search) {
            // dd($query);
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(10);

        $resources->appends(['search' => $search]);

        return view('backend.resources.index', compact('resources', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $resource = new Resource();
        $courses = Course::where('delivery_mode','!=','Elearning')->get();
        return view('backend.resources.create', compact('resource','courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'string|max:255',
            'file' => 'required|mimes:pdf,jpg,jpeg,png,gif', // Allow PDFs and images up to 2MB
        ]);

        // Store file directly in public/resources directory
        $file = $request->file('file');
        $fileName = time().'_'.$file->getClientOriginalName();
        $filePath = $file->move(public_path('resources'), $fileName);

        $resource = Resource::create([
            'name' => $request->name,
            'file' => 'resources/'.$fileName, // Store the relative path
            'user_id' => auth()->id(),
        ]);

        $resource->courses()->attach($request->input('courses', []));
        return redirect()->route('backend.resources.index')->with('success', 'Resource added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Resource $resource
     * @return Response
     */
    public function edit(Resource $resource)
    {
        $courses = Course::where('delivery_mode','!=','Elearning')->get();
        $selectedCourses = $resource->courses()->pluck('courses.id')->toArray();
        return view('backend.resources.edit', compact('resource','courses','selectedCourses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Resource $resource
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Resource $resource)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'file' => 'nullable|mimes:pdf,jpg,jpeg,png,gif', // Optional file validation
        ]);

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($resource->file && file_exists(public_path($resource->file))) {
                unlink(public_path($resource->file));
            }

            // Store new file in public/resources
            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('resources'), $fileName);
            $resource->file = 'resources/'.$fileName;
        }

        $user_id = auth()->id();
        $resource->user_id = $user_id;
        $resource->name = $request->name;
        $resource->save();

        $resource->courses()->sync($request->input('courses', []));

        return redirect()->route('backend.resources.index')->with('success', 'Resource updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Resource $resource
     * @return Response
     */
    public function destroy(Resource $resource)
    {
        $resource->courses()->detach();
        $resource->delete();
        return redirect()->route('backend.resources.index')->with('success', 'Resource deleted successfully');
    }
}
