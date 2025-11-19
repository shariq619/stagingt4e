<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
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
        $categories = Category::when($search, function ($query, $search) {
            // dd($query);
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(10);

        $categories->appends(['search' => $search]);

        return view('backend.category.index', compact('categories', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        return view('backend.category.create', compact('category'));
    }

    /**
     * Store a  newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
        $validatedData['user_id'] = auth()->id();
        $validatedData['slug'] = Str::slug($validatedData['name']);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $uploadedFile = $request->file('image');
            $originalName = time() . '_ID_' . auth()->id() . '_' . $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('category_images', $originalName, 'public');
            $validatedData['image'] = 'storage/' . $filePath;
        }
        Category::create($validatedData);
        return redirect()->route('backend.categories.index')->with('success', 'Category added successfully');
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
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->user_id = auth()->id();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($category->image) {
                $oldFilePath = str_replace('storage/', '', $category->image);
                Storage::disk('public')->delete($oldFilePath);
            }
            $uploadedFile = $request->file('image');
            $originalName = time() . '_ID_' . auth()->id() . '_' . $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('category_images', $originalName, 'public');
            $category->image = 'storage/' . $filePath;
        }
        $category->save();
        return redirect()->route('backend.categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->image) {
            $oldFilePath = str_replace('storage/', '', $category->image);
            Storage::disk('public')->delete($oldFilePath);
        }
        $category->delete();
        return redirect()->route('backend.categories.index')->with('success', 'Category deleted successfully');
    }
}
