<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Methodology;
use Illuminate\Http\Request;

class MethodologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $methodologies = Methodology::when($search, function ($query, $search) {
            // dd($query);
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(10);

        $methodologies->appends(['search' => $search]);

        return view('backend.methodologies.index', compact('methodologies', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $methodology = new Methodology();
        return view('backend.methodologies.create', compact('methodology'));
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
            'name' => 'required|string|max:255|unique:categories,name',
            'documents.*' => 'file|mimes:png,jpg,jpeg,doc,docx,pdf|max:10240'
        ]);

        $validatedData['user_id'] = auth()->id();

        $methodology = Methodology::create([
            'name' => $validatedData['name'],
            'user_id' => $validatedData['user_id'],
            'documents' => json_encode([])
        ]);

        $documentPaths = [];

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                if ($file->isValid()) {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();

                    $fileName = time() . '_ID_' . $methodology->id . '_' . $originalName . '.' . $extension;

                    $filePath = $file->storeAs('methodology', $fileName, 'public');

                    if ($filePath) {
                        $documentPaths[] = 'storage/' . $filePath;
                    }
                }
            }
        }

        $methodology->update([
            'documents' => json_encode($documentPaths)
        ]);

        return redirect()->route('backend.methodologies.index')->with('success', 'Methodology added successfully');
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
    public function edit(Methodology $methodology)
    {
        return view('backend.methodologies.edit', compact('methodology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Methodology $methodology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Methodology $methodology)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $methodology->id,
            'documents.*' => 'file|mimes:png,jpg,jpeg,doc,docx,pdf|max:10240'
        ]);

        $validatedData['user_id'] = auth()->id();

        // Upload new documents
        $uploadedDocuments = [];

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                if ($file->isValid()) {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . '_ID_' . $methodology->id .  '_' . $originalName . '.' . $extension;

                    $filePath = $file->storeAs('methodology', $fileName, 'public');

                    if ($filePath) {
                        $uploadedDocuments[] = 'storage/' . $filePath;
                    }
                }
            }
        }

        // Merge with old documents
        $existingDocuments = $methodology->documents ? json_decode($methodology->documents, true) : [];
        $updatedDocuments = array_merge($existingDocuments, $uploadedDocuments);

        $validatedData['documents'] = json_encode($updatedDocuments);

        $methodology->update($validatedData);

        return redirect()->route('backend.methodologies.index')->with('success', 'Methodology updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Methodology $methodology)
    {
        $documents = json_decode($methodology->documents, true) ?? [];

        foreach ($documents as $doc) {
            $storagePath = str_replace('storage/', '', $doc);
            $fullPath = storage_path('app/public/' . $storagePath);

            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }

        $methodology->delete();

        return redirect()->route('backend.methodologies.index')->with('success', 'Methodology and its documents deleted successfully');
    }


    public function deleteDocument(Request $request, Methodology $methodology)
    {
        $request->validate([
            'document' => 'required|string'
        ]);

        $documents = json_decode($methodology->documents, true);
        $updatedDocuments = array_filter($documents, function ($doc) use ($request) {
            return $doc !== $request->document;
        });

        $methodology->documents = json_encode(array_values($updatedDocuments));
        $methodology->save();

        $filePath = public_path($request->document);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        return redirect()->route('backend.methodologies.index')->with('success', 'Document removed successfully.');
    }
}
