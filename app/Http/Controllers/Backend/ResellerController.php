<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Reseller;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resellers = Reseller::latest()->paginate(10);
        return view('backend.resellers.index', compact('resellers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.resellers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|unique:resellers',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        Reseller::create($validated);

        return redirect()->route('backend.resellers.index')
            ->with('success', 'Reseller created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reseller $reseller)
    {
        return view('backend.resellers.show', compact('reseller'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reseller $reseller)
    {
        return view('backend.resellers.edit', compact('reseller'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reseller $reseller)
    {
        $validated = $request->validate([
            'company_name'    => 'required|string|max:255',
            'contact_person'  => 'required|string|max:255',
            'email'           => ['required', 'email', Rule::unique('resellers')->ignore($reseller->id)],
            'phone'           => 'required|string|max:20',
            'address'         => 'required|string',
            'status'          => 'required|in:active,inactive',
        ]);

        $reseller->update($validated);

        return redirect()->route('backend.resellers.index')
            ->with('success', 'Reseller updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reseller $reseller)
    {
        $reseller->delete();

        return redirect()->route('backend.resellers.index')
            ->with('success', 'Reseller deleted successfully.');
    }
}
