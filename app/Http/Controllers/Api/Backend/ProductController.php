<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * @OA\Tag(name="Products",
 * description="Products endpoints"
 * )
 */

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/backend/products",
     *     tags={"Products"},
     *     summary="Get all Products",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of Products"
     *     )
     * )
     */

    public function index()
    {
        try {
            $products = Product::all();
            return response()->json([
                'success' => true,
                'products' => $products
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Server error', 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/backend/products/{slug}",
     *     tags={"Products"},
     *     summary="Get single Products by slug",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         required=true,
     *         description="ID of the Products",
     *         @OA\Schema(type="string", example="badge-holders")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Products detail"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Products not found"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */

    public function show($slug)
    {
        try {
            $product = Product::where('slug', $slug)->first();
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            } else {
                return response()->json([
                    'success' => true,
                    'product' => $product
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Server error', 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/backend/products",
     *     tags={"Products"},
     *     summary="Create a new Products",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"name", "price"},
     *                 @OA\Property(property="name", type="string", example="Product Name"),
     *                 @OA\Property(property="price", type="number", format="float", example=199.99),
     *                 @OA\Property(property="discount_price", type="number", format="float", example=149.99),
     *                 @OA\Property(property="short_description", type="string", example="Short description..."),
     *                 @OA\Property(property="description", type="string", example="Long description..."),
     *                 @OA\Property(property="description_two", type="string", example="Details..."),
     *                 @OA\Property(property="description_three", type="string", example="More details..."),
     *                 @OA\Property(property="description_four", type="string", example="Even more..."),
     *                 @OA\Property(property="excerpt", type="string", example="Excerpt text..."),
     *                 @OA\Property(property="product_image", type="file"),
     *                 @OA\Property(
     *                     property="gallery[]",
     *                     type="array",
     *                     @OA\Items(type="file"),
     *                     description="Multiple gallery images"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Product created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed"
     *     )
     * )
     */

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
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

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ]);
            }

            $validatedData = $validator->validated();

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

            return response()->json([
                'success' => true,
                'message' => 'Product created successfully',
                'product' => $product
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Server error', 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/backend/products/{slug}",
     *     tags={"Products"},
     *     summary="Update Product by slug",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         required=true,
     *         description="Slug of the product",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"name", "price"},
     *                 @OA\Property(property="_method", type="string", default="PUT"),
     *                 @OA\Property(property="name", type="string", example="naveed"),
     *                 @OA\Property(property="price", type="string", example="1000.00"),
     *                 @OA\Property(property="discount_price", type="string", example="50.00"),
     *                 @OA\Property(property="short_description", type="string", example="naveed"),
     *                 @OA\Property(property="excerpt", type="string", example="naveed"),
     *                 @OA\Property(property="description", type="string", example="naveed"),
     *                 @OA\Property(property="description_two", type="string", example="naveed"),
     *                 @OA\Property(property="description_three", type="string", example="naveed"),
     *                 @OA\Property(property="description_four", type="string", example="naveed"),
     *                 @OA\Property(property="product_image", type="file"),
     *                 @OA\Property(
     *                     property="gallery[]",
     *                     type="array",
     *                     @OA\Items(type="file")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed"
     *     )
     * )
     */


    public function update(Request $request, $slug)
    {
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $validatedData = $validator->validated();

        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $product->update([
            'slug' => Str::slug($validatedData['name']),
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'discount_price' => $validatedData['discount_price'] ?? null,
            'short_description' => $validatedData['short_description'] ?? null,
            'excerpt' => $validatedData['excerpt'] ?? null,
            'description' => $validatedData['description'] ?? null,
            'description_two' => $validatedData['description_two'] ?? null,
            'description_three' => $validatedData['description_three'] ?? null,
            'description_four' => $validatedData['description_four'] ?? null,
            'user_id' => auth()->id(),
        ]);

        if ($request->hasFile('product_image') && $request->file('product_image')->isValid()) {
            $oldImagePath = public_path($product->product_image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $uploadedFile = $request->file('product_image');
            $originalName = time() . '_ID_' . $product->id . '_' . $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('product_images', $originalName, 'public');
            $product->update(['product_image' => 'storage/' . $filePath]);
        }

        $oldGalleryImages = json_decode($product->gallery, true) ?? [];

        foreach ($oldGalleryImages as $image) {
            $path = public_path($image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $newGalleryImages = [];

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                if ($file->isValid()) {
                    $originalName = time() . '_ID_' . $product->id . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('gallery', $originalName, 'public');
                    $newGalleryImages[] = 'storage/' . $filePath;
                }
            }
        }

        $product->update([
            'gallery' => json_encode($newGalleryImages)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'product' => $product
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/backend/products/{slug}",
     *     tags={"Products"},
     *     summary="Delete Product by slug",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         required=true,
     *          @OA\Schema(type="string", example="product-name")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Product deleted successfully")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Product not found"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */

    public function destroy($slug)
    {
        try {
            $product = Product::where('slug', $slug)->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            if ($product->product_image) {
                $imagePath = public_path($product->product_image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $galleryImages = json_decode($product->gallery, true) ?? [];
            foreach ($galleryImages as $image) {
                $imagePath = public_path($image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Server error', 'message' => $th->getMessage()], 500);
        }
    }
}
