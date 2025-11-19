<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $search = $request->input('search');
        // $posts = Post::with('category')
        //     ->where('title', 'LIKE', "%$search%")
        //     ->orWhereHas('category', function ($query) use ($search) {
        //         $query->where('name', 'LIKE', "%$search%");
        //     })
        //     ->paginate(15);
        // return view('backend.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $post = new Post();
        // $categories = PostCategory::all();
        // return view('backend.posts.create', compact('post', 'categories'));
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
        //     'title' => 'required',
        //     'slug' => [
        //         'required',
        //         'unique:posts,slug',
        //         'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'
        //     ],
        //     'category_id' => 'required',
        //     'content' => 'nullable',
        //     'excerpt' => 'nullable',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ],[
        //     'slug.regex' => 'The slug must be in lowercase and use hyphens only (e.g. my-blog-title).'
        // ]);

        // $data = $request->all();

        // if ($request->hasFile('image') && $request->file('image')->isValid()) {
        //     $uploadedFile = $request->file('image');
        //     $fileName = time() . '_' . $request->course_name . '_' .$uploadedFile->getClientOriginalName();
        //     $filePath = $uploadedFile->storeAs('post_image', $fileName, 'public');
        //     $data['image'] = 'storage/' . $filePath;
        // }

        // Post::create($data);

        // return redirect()->route('backend.post.index')->with('success', 'Post created successfully.');
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
    public function edit(Post $post)
    {
        // $categories = PostCategory::all();
        // return view('backend.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'slug' => [
        //         'required',
        //         'unique:posts,slug,' . $post->id,
        //         'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'
        //     ],
        //     'category_id' => 'required',
        //     'content' => 'nullable',
        //     'excerpt' => 'nullable',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ],[
        //     'slug.regex' => 'The slug must be in lowercase and use hyphens only (e.g. my-blog-title).'
        // ]);

        // $data = $request->all();

        // if ($request->hasFile('image') && $request->file('image')->isValid()) {
        //     if ($post->image) {
        //         unlink(public_path($post->image));
        //     }
        //     $uploadedFile = $request->file('image');
        //     $fileName = time() . '_' . $request->course_name . '_' .$uploadedFile->getClientOriginalName();
        //     $filePath = $uploadedFile->storeAs('post_image', $fileName, 'public');
        //     $data['image'] = 'storage/' . $filePath;
        // }

        // $post->update($data);

        // return redirect()->route('backend.post.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // if ($post->image) {
        //     unlink(public_path($post->image));
        // }
        // $post->delete();
        // return redirect()->route('backend.post.index')->with('success', 'Post deleted successfully.');
    }
}
