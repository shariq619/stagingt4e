<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $venues = Venue::when($search, function($q, $search){
            return $q->where('venue_name', 'like', "%{$search}%");
        })->paginate(10);
        $venues->appends(['search', $search]);
        return view('backend.venue.index', compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $venue = new Venue();
        $regions = getRegions(); // Assuming the helper function is accessible
        $cities = getCities(); // Assuming the helper function is accessible
        return view('backend.venue.create', compact('venue','regions','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'code' => 'required',
            'venue_name' => 'required',
            'address' => 'required',
            'post_code' => ['required', 'regex:/^(GIR ?0AA|(?:[A-Z]{1,2}[0-9R][0-9A-Z]? ?[0-9][A-Z]{2}))$/i'],
            'region' => 'required',
            'city' => 'required',
            'primary_contact_number' => 'required',
            'telephone_number' => 'required',
            'email' => 'required|email',
            'parking' => 'required',
            'access_instructions' => 'nullable',
        ]);
        $validatedData['user_id'] = auth()->id();
        $validatedData['slug'] = Str::slug($validatedData['venue_name']);
        Venue::create($validatedData);

        return redirect()->route('backend.venues.index')->with('success', 'Venues Created Successfully');
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
    public function edit(Request $request ,Venue $venue)
    {
        $regions = getRegions(); // Assuming the helper function is accessible
        $cities = getCities($venue->region);
        return view('backend.venue.edit', compact('venue','regions','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venue $venue)
    {
        $request->validate([
            'code' => 'required',
            'venue_name' => 'required',
            'address' => 'required',
            'post_code' => ['required', 'regex:/^(GIR ?0AA|(?:[A-Z]{1,2}[0-9R][0-9A-Z]? ?[0-9][A-Z]{2}))$/i'],
            'region' => 'required',
            'city' => 'required',
            'primary_contact_number' => 'required',
            'telephone_number' => 'required',
            'email' => 'required|email',
            'parking' => 'required',
            'access_instructions' => 'nullable',
        ]);
        $user_id = auth()->id();
        $request->merge(['user_id' => $user_id]);
        $request->slug = Str::slug($request->venue_name);
        $venue->update($request->all());
        return redirect()->route('backend.venues.index')->with('success', 'Venues Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();
        return redirect()->route('backend.venues.index')->with('success', 'Venue successfully deleted');
    }
}
