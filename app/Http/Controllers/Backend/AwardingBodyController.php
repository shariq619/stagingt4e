<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AwardingBody;
use App\Models\Qualification;
use Illuminate\Http\Request;

class AwardingBodyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $awardingBodies = AwardingBody::when($search, function($q, $search){
            return $q->where('name', 'like', "%{$search}%");
        })->paginate(10);

        $awardingBodies->appends(['search' => $search]);

        return view('backend.awarding_bodies.index', compact('awardingBodies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $awardingBody = new AwardingBody();
        return view('backend.awarding_bodies.create', compact('awardingBody'));
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
        $validatedData['user_id'] = auth()->id();
        AwardingBody::create($validatedData);
        return redirect()->route('backend.awarding_bodies.index')->with('success', 'AwardingBody Created Successfully');
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
    public function edit(AwardingBody $awardingBody)
    {
        return view('backend.awarding_bodies.edit', compact('awardingBody'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AwardingBody $awardingBody)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $validatedData['user_id'] = auth()->id();
        $awardingBody->update($validatedData);
        return redirect()->route('backend.awarding_bodies.index')->with('success', 'AwardingBody successfully update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AwardingBody $awardingBody)
    {
        $awardingBody->delete();
        return redirect()->route('backend.awarding_bodies.index')->with('success', 'AwardingBody successfully deleted');
    }
}
