<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * @OA\Tag(name="Venue",
 * description="Venues endpoints"
 * )
 */

class VenueController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/backend/venues",
     *     tags={"Venue"},
     *     summary="Get all venues",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of venues"
     *     )
     * )
     */

    public function index()
    {
        try {
            $venues = Venue::all();
            return response()->json([
                'success' => true,
                'venues' => $venues,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/backend/venues/{slug}",
     *     tags={"Venue"},
     *     summary="Get single venue by slug",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         required=true,
     *         description="Slug of the venue",
     *         @OA\Schema(type="string", example="london")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Venue detail"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Venue not found"
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
            $venue = Venue::where('slug', $slug)->first();
            if (!$venue) {
                return response()->json([
                    'success' => false,
                    'message' => 'Venue not found',
                ], 404);
            }
            return response()->json([
                'success' => true,
                'venue' => $venue,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/backend/venues/{slug}",
     *     tags={"Venue"},
     *     summary="Update a venue by slug",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         description="Venue slug",
     *         required=true,
     *         @OA\Schema(type="string", example="my-venue-slug")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"venue_name", "address", "city"},
     *             @OA\Property(property="code", type="string", example="V001"),
     *             @OA\Property(property="venue_name", type="string", example="Grand Venue Hall"),
     *             @OA\Property(property="address", type="string", example="123 Main Street"),
     *             @OA\Property(property="post_code", type="string", example="SW1A 1AA"),
     *             @OA\Property(property="region", type="string", example="London"),
     *             @OA\Property(property="city", type="string", example="London"),
     *             @OA\Property(property="primary_contact_number", type="string", example="07123456789"),
     *             @OA\Property(property="telephone_number", type="string", example="02079460000"),
     *             @OA\Property(property="email", type="string", example="venue@example.com"),
     *             @OA\Property(property="parking", type="string", example="Free parking available"),
     *             @OA\Property(property="access_instructions", type="string", example="Use back entrance after 6 PM")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Venue updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Venue updated successfully"),
     *             @OA\Property(property="venue", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Venue not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */

    public function update(Request $request, $slug)
    {
        $venue = Venue::where('slug', $slug)->first();

        if (!$venue) {
            return response()->json([
                'success' => false,
                'message' => 'Venue not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'code' => 'nullable',
            'venue_name' => 'required',
            'address' => 'required',
            'post_code' => ['nullable', 'regex:/^(GIR ?0AA|(?:[A-Z]{1,2}[0-9R][0-9A-Z]? ?[0-9][A-Z]{2}))$/i'],
            'region' => 'nullable',
            'city' => 'required',
            'primary_contact_number' => 'nullable',
            'telephone_number' => 'nullable',
            'email' => 'nullable|email',
            'parking' => 'nullable',
            'access_instructions' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $validatedData = $validator->validated();
        $validatedData['user_id'] = auth()->id();
        $validatedData['slug'] = Str::slug($validatedData['venue_name']);
        $venue->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Venues Update Successfully',
            'venue' => $venue
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/backend/venues",
     *     tags={"Venue"},
     *     summary="Create a new venue",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"venue_name", "address", "city"},
     *             @OA\Property(property="code", type="string", example="VEN123"),
     *             @OA\Property(property="venue_name", type="string", example="Grand Hall"),
     *             @OA\Property(property="address", type="string", example="123 Main Street"),
     *             @OA\Property(property="post_code", type="string", example="SW1A 1AA"),
     *             @OA\Property(property="region", type="string", example="South"),
     *             @OA\Property(property="city", type="string", example="London"),
     *             @OA\Property(property="primary_contact_number", type="string", example="07123456789"),
     *             @OA\Property(property="telephone_number", type="string", example="02079460000"),
     *             @OA\Property(property="email", type="string", format="email", example="info@example.com"),
     *             @OA\Property(property="parking", type="string", example="Available"),
     *             @OA\Property(property="access_instructions", type="string", example="Use rear entrance")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Venue created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */


    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'code' => 'nullable',
                'venue_name' => 'required',
                'address' => 'required',
                'post_code' => ['nullable', 'regex:/^(GIR ?0AA|(?:[A-Z]{1,2}[0-9R][0-9A-Z]? ?[0-9][A-Z]{2}))$/i'],
                'region' => 'nullable',
                'city' => 'required',
                'primary_contact_number' => 'nullable',
                'telephone_number' => 'nullable',
                'email' => 'nullable|email',
                'parking' => 'nullable',
                'access_instructions' => 'nullable',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $validatedData = $validator->validated();
            $validatedData['user_id'] = auth()->id();
            $validatedData['slug'] = Str::slug($validatedData['venue_name']);

            Venue::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Venues Created Successfully',
                'venue' => $validatedData
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/backend/venues/{slug}",
     *     tags={"Venue"},
     *     summary="Delete Venue",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         required=true,
     *          @OA\Schema(type="string", example="technology")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Venue deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Venue deleted successfully")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Venue not found"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */

    public function destroy($slug)
    {
        try {
            $venue = Venue::where('slug', $slug)->first();

            if (!$venue) {
                return response()->json([
                    'success' => false,
                    'message' => 'Venue not found',
                ], 404);
            }
            $venue->delete();
            return response()->json([
                'success' => true,
                'message' => 'Venue deleted successfully',
                'venue' => $venue
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
