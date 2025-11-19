<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
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
        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(10);

        $products->appends(['search' => $search]);

        return view('backend.products.index', compact('products', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        return view('backend.products.create', compact('product'));
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
            'name' => 'required|string|max:255',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'short_description' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'description_two' => 'nullable|string',
            'description_three' => 'nullable|string',
            'description_four' => 'nullable|string',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $product = Product::create([
            'slug' => Str::slug($validatedData['name']),
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'discount_price' => $validatedData['discount_price'],
            'short_description' => $validatedData['short_description'],
            'excerpt' => $validatedData['excerpt'],
            'description' => $validatedData['description'],
            'description_two' => $validatedData['description_two'],
            'description_three' => $validatedData['description_three'],
            'description_four' => $validatedData['description_four'],
            'user_id' => auth()->id(),
        ]);

        if ($request->hasFile('product_image') && $request->file('product_image')->isValid()) {
            $uploadedFile = $request->file('product_image');
            $originalName = time() . '_ID_' . $product->id . '_' . $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('product_images', $originalName, 'public');
            $product->update(['product_image' => 'storage/' . $filePath]);
        }

        // Handle gallery images upload
        $galleryImages = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                if ($file->isValid()) {
                    $originalName = time() . '_ID_' . $product->id . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('gallery', $originalName, 'public');
                    $galleryImages[] = 'storage/' . $filePath;
                }
            }
            $product->update(['gallery' => json_encode($galleryImages)]);
        }

        return redirect()->route('backend.products.index')->with('success', 'Product added successfully');
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
    public function edit(Product $slug)
    {
        $galleryImages = $slug->gallery ? json_decode($slug->gallery, true) : [];
        return view('backend.products.edit', compact('slug', 'galleryImages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $slug)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'description_two' => 'nullable|string',
            'description_three' => 'nullable|string',
            'description_four' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $product = Product::find($slug->id);
        $product->update([
            'slug' => Str::slug($validatedData['name']),
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'discount_price' => $validatedData['discount_price'],
            'short_description' => $validatedData['short_description'],
            'excerpt' => $validatedData['excerpt'],
            'description' => $validatedData['description'],
            'description_two' => $validatedData['description_two'],
            'description_three' => $validatedData['description_three'],
            'description_four' => $validatedData['description_four'],
            'user_id' => auth()->id(),
        ]);

        if ($request->hasFile('product_image') && $request->file('product_image')->isValid()) {

            // Delete the existing image
            $existingImage = public_path($product->product_image);
            if (file_exists($existingImage)) {
                unlink($existingImage);
            }
            $uploadedFile = $request->file('product_image');
            $originalName = time() . '_ID_' . $product->id . '_' . $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('product_images', $originalName, 'public');
            $product->update(['product_image' => 'storage/' . $filePath]);
        }

        $galleryImages = json_decode($product->gallery, true) ?? [];
        $deletedImages = json_decode($request->deleted_images, true);
        if ($deletedImages) {
            foreach ($deletedImages as $image) {
                if (($key = array_search($image, $galleryImages)) !== false) {
                    if (file_exists(public_path($image))) {
                        unlink(public_path($image));
                    }
                    unset($galleryImages[$key]);
                }
            }
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                if ($file->isValid()) {
                    $originalName = time() . '_ID_' . $product->id . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('gallery', $originalName, 'public');
                    $galleryImages[] = 'storage/' . $filePath;
                }
            }
        }

        // Update the gallery in the database
        $product->update(['gallery' => json_encode(array_values($galleryImages))]);

        return redirect()->route('backend.products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $slug)
    {
        $product = Product::find($slug->id);

        if (!$product) {
            return redirect()->route('backend.products.index')->with('error', 'Product not found');
        }

        $productImage = public_path($product->product_image);
        if (!empty($product->product_image) && file_exists($productImage) && is_writable($productImage)) {
            if (@unlink($productImage) === false) {
                return redirect()->route('backend.products.index')->with('error', 'Could not delete product image');
            }
        }

        $galleryImages = json_decode($product->gallery, true) ?? [];
        foreach ($galleryImages as $galleryImage) {
            $galleryImagePath = public_path($galleryImage);
            if (!empty($galleryImage) && file_exists($galleryImagePath) && is_writable($galleryImagePath)) {
                @unlink($galleryImagePath);
            }
        }

        $product->delete();

        return redirect()->route('backend.products.index')->with('success', 'Product deleted successfully');
    }

}
