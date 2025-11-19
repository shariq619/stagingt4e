<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AwardingBody;
use App\Models\License;
use Illuminate\Http\Request;

class LicenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $licences = License::when($search, function($q, $search){
            return $q->where('name', 'like', "%{$search}%");
        })->paginate(20);

        $licences->appends(['search', $request]);
        return view('backend.elearning_licences.index', compact('licences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $elearningLicence = new License();
        return view('backend.elearning_licences.create', compact('elearningLicence'));
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

      //  $validatedData['registration_id'] = $request->registration_id ?? "";
        $validatedData['course_id'] = $request->course_id ?? "";
     //   $validatedData['course_link'] = $request->course_link ?? "";

        $validatedData['user_id'] = auth()->id();
        License::create($validatedData);
        return redirect()->route('backend.elearning_licences.index')->with('success', 'Elearning License Created Successfully');
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
    public function edit(License $elearningLicence)
    {
        return view('backend.elearning_licences.edit', compact('elearningLicence'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, License $elearningLicence)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

   //     $validatedData['registration_id'] = $request->registration_id ?? "";
        $validatedData['course_id'] = $request->course_id ?? "";
   //     $validatedData['course_link'] = $request->course_link ?? "";

        $validatedData['user_id'] = auth()->id();

        //dd($validatedData);
        $elearningLicence->update($validatedData);
        return redirect()->route('backend.elearning_licences.index')->with('success', 'Elearning License successfully update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $elearningLicence)
    {
        $elearningLicence->delete();
        return redirect()->route('backend.elearning_licences.index')->with('success', 'Elearning License successfully deleted');
    }
}
