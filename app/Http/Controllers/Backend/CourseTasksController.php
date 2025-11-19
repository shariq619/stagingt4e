<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $tasks = Task::when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(25);

        $tasks->appends(['search' => $search]);

        return view('backend.course_tasks.index', compact('tasks', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course_tasks = new Task();
        return view('backend.course_tasks.create', compact('course_tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:tasks,name'
        ]);

        $validatedData['user_id']   = auth()->id();
        $validatedData['type']      = "CourseWork";

        // Handle the document upload if it exists
        if ($request->hasFile('document') && $request->file('document')->isValid()) {
            $file = $request->file('document');

            // Get the original file name with extension
            $originalName = $file->getClientOriginalName();


            $filePath = public_path("resources/$originalName");

            // Move the uploaded file
            $file->move(dirname($filePath), basename($filePath));

            // Store the relative path to the file in the database
            $validatedData['task_code'] = "resources/$originalName";
        }

        // Create the task
        Task::create($validatedData);

        return redirect()->route('backend.course_tasks.index')->with('success', 'Task added successfully');
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
     * @param Task $course_tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $course_tasks)
    {
        return view('backend.course_tasks.edit', compact('course_tasks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Task $course_tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $course_tasks)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:tasks,name,' . $course_tasks->id,
            'document' => 'nullable|file|mimes:pdf|max:10240', // Max 10MB PDF
        ]);

        // Merge additional data
        $user_id = auth()->id();
        $validatedData['user_id'] = $user_id;
        $validatedData['type'] = "CourseWork";

        // Handle the document upload if it exists
        if ($request->hasFile('document') && $request->file('document')->isValid()) {
            $file = $request->file('document');

            // Generate a unique file name
            $uniqueFileName = $file->getClientOriginalName();

            // Define the file path
            $filePath = public_path("resources/$uniqueFileName");

            // Move the uploaded file
            $file->move(dirname($filePath), basename($filePath));

            // Delete the old file if it exists
            if ($course_tasks->task_code) {
                $oldFilePath = public_path($course_tasks->task_code);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Update the task_code with the new file path
            $validatedData['task_code'] = "resources/$uniqueFileName";
        }

        // Remove 'document' from the validated data
        unset($validatedData['document']);

        // Update the task with validated data
        $course_tasks->update($validatedData);

        return redirect()->route('backend.course_tasks.index')->with('success', 'Task updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Task $course_tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $course_tasks)
    {
        // Check if the task has a document
        if ($course_tasks->task_code) {
            $filePath = public_path($course_tasks->task_code);

            // Check if the file exists and delete it
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Delete the task record from the database
        $course_tasks->delete();
        return redirect()->route('backend.course_tasks.index')->with('success', 'Task deleted successfully');
    }
}
