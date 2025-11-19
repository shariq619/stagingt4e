<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $search = $request->input('search');
        // if ($search) {
        //     $post_categories = PostCategory::where('name', 'LIKE', "%$search%")->paginate(10);
        // } else {
        //     $post_categories = PostCategory::paginate(10);
        // }
        // return view('backend.category_post.index', compact('post_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $post_category = new PostCategory();
        // return view('backend.category_post.create', compact('post_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|unique:post_categories,name',
        //     ]);

        //     $slug = Str::slug($request->name);

        //     PostCategory::create([
        //         'name' => $request->name,
        //         'slug' => $slug,
        //     ]);

        // return redirect()->route('backend.post_category.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PostCategory $post_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PostCategory $post_category)
    {
        // return view('backend.category_post.edit', compact('post_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostCategory $post_category)
    {
        // $request->validate([
        //     'name' => 'required|unique:post_categories,name',
        //     ]);

        //     $slug = Str::slug($request->name);

        //     $post_category->update([
        //         'name' => $request->name,
        //         'slug' => $slug,
        //     ]);

        // return redirect()->route('backend.post_category.index')->with('success', 'Post Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $post_category)
    {
        // $post_category->delete();
        // return redirect()->route('backend.post_category.index')->with('success', 'Category deleted successfully.');
    }
}
