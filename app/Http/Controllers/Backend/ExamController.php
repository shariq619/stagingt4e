<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $exams = Exam::when($search, function($q, $search){
            return $q->where('name', 'like', "%{$search}%");
        })->paginate(100);

        $exams->appends(['search' => $search]);

        return view('backend.exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exam = new Exam();
        return view('backend.exams.create', compact('exam'));
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
            'name' => 'required|string|max:255|unique:exams,name',
            'max_score' => 'required',
            'min_score' => 'required',
            'pass_rate' => 'required',
        ]);
        $validatedData['industry'] = $request->industry;
        $validatedData['type'] = $request->type;
        $validatedData['max_score'] = $request->max_score;
        $validatedData['min_score'] = $request->min_score;
        $validatedData['pass_rate'] = $request->pass_rate;
        $validatedData['user_id'] = auth()->id();
        Exam::create($validatedData);
        return redirect()->route('backend.exams.index')->with('success', 'Exam Created Successfully');
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
    public function edit(Exam $exam)
    {
        return view('backend.exams.edit', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'pass_rate' => 'required|'
        ]);
        $validatedData['user_id'] = auth()->id();
        $validatedData['industry'] = $request->industry;
        $validatedData['type'] = $request->type;
        $validatedData['max_score'] = $request->max_score;
        $validatedData['min_score'] = $request->min_score;
        $validatedData['pass_rate'] = $request->pass_rate;
        $exam->update($validatedData);
        return redirect()->route('backend.exams.index')->with('success', 'Exam successfully update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('backend.exams.index')->with('success', 'Exam successfully deleted');
    }
}
