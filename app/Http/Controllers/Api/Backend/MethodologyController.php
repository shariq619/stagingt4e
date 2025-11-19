<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use App\Models\Methodology;
use Illuminate\Http\Request;

/**
 * @OA\Tag(name="Methodology",
 * description="Methodologies endpoints"
 * )
 */

class MethodologyController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/backend/methodologies",
     *     tags={"Methodology"},
     *     summary="Get all methodologies",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of methodologies"
     *     )
     * )
     */
    public function index()
    {
        try {
            $methodologies = Methodology::all();
            if ($methodologies->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'Methodologies not found'], 404);
            } else {
                return response()->json(['success' => true, 'data' => $methodologies], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => true, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/backend/methodologies/{id}",
     *     tags={"Methodology"},
     *     summary="Get single methodologies by id",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the methodologies",
     *         @OA\Schema(type="string", example="test-id")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="methodologies detail"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="methodologies not found"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */

    public function show($id)
    {
        try {
            $methodology = Methodology::find($id);
            if (!$methodology) {
                return response()->json(['success' => false, 'message' => 'Methodology not found'], 404);
            } else {
                return response()->json(['success' => true, 'data' => $methodology], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/backend/methodologies",
     *     tags={"Methodology"},
     *     summary="Create Methodology",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"name"},
     *                 @OA\Property(property="name", type="string", example="Full Stack Bundle"),
     *                 @OA\Property(
     *                     property="documents[]",
     *                     type="array",
     *                     @OA\Items(type="string", format="binary")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Methodology created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Methodology created successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Validation error"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\AdditionalProperties(
     *                     type="array",
     *                     @OA\Items(type="string")
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function store(Request $request)
    {
        try {
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

            return response()->json(['success' => true, 'data' => $methodology, 'message' => 'Methodology created successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/backend/methodologies/{id}",
     *     tags={"Methodology"},
     *     summary="Update a Methodology by ID",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"name"},
     *                  @OA\Property(property="_method", type="string", default="PUT"),
     *                 @OA\Property(property="name", type="string", example="Full Stack Bundle"),
     *                 @OA\Property(
     *                     property="documents[]",
     *                     type="array",
     *                     @OA\Items(type="string", format="binary")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Methodology updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Methodology updated successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Methodology not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Methodology not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Validation error"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\AdditionalProperties(
     *                     type="array",
     *                     @OA\Items(type="string")
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function update(Request $request, $id)
    {
        try {
            $methodology = Methodology::find($id);
            if (!$methodology) {
                return response()->json(['success' => false, 'message' => 'Methodology not found'], 404);
            }

            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:methodologies,name,' . $id,
                'documents.*' => 'file|mimes:png,jpg,jpeg,doc,docx,pdf|max:10240'
            ]);

            $validatedData['user_id'] = auth()->id();

            $existingDocuments = [];
            if ($methodology->documents) {
                $existingDocuments = is_array($methodology->documents)
                    ? $methodology->documents
                    : json_decode($methodology->documents, true);
                $existingDocuments = $existingDocuments ?? [];
            }

            $methodology->update($validatedData);

            $newDocumentPaths = [];
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $file) {
                    if ($file->isValid()) {
                        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $file->getClientOriginalExtension();
                        $fileName = time() . '_ID_' . $methodology->id . '_' . $originalName . '.' . $extension;

                        $filePath = $file->storeAs('methodology', $fileName, 'public');
                        if ($filePath) {
                            $newDocumentPaths[] = 'storage/' . $filePath;
                        }
                    }
                }
            }

            $updatedDocuments = array_merge($existingDocuments, $newDocumentPaths);
            $updatedDocuments = array_filter($updatedDocuments);
            $methodology->update([
                'documents' => !empty($updatedDocuments) ? json_encode(array_values($updatedDocuments)) : null
            ]);

            return response()->json([
                'success' => true,
                'data' => $methodology,
                'message' => 'Methodology updated successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/backend/methodologies/{id}",
     *     tags={"Methodology"},
     *     summary="Delete Methodology by id",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *          @OA\Schema(type="integer", example="id")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Methodology deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Methodology deleted successfully")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Methodology not found"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */

    public function destroy($id)
    {
        try {
            $methodology = Methodology::find($id);

            if (!$methodology) {
                return response()->json([
                    'success' => false,
                    'message' => 'Methodology not found.'
                ], 404);
            }

            $documentPaths = json_decode($methodology->documents, true) ?? [];

            foreach ($documentPaths as $docPath) {
                $storagePath = str_replace('storage/', '', $docPath);
                $fullPath = storage_path('app/public/' . $storagePath);

                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
            }

            $methodology->delete();

            return response()->json([
                'success' => true,
                'message' => 'Methodology and all associated documents deleted successfully.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/backend/methodologies/{id}/documents",
     *     tags={"Methodology"},
     *     summary="Delete a specific document from a methodology",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Methodology ID",
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"document"},
     *                 @OA\Property(
     *                     property="document",
     *                     type="string",
     *                     example="storage/methodology/1747652696_ID_2_bundleTest.jpg"
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Document removed successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Document removed successfully."),
     *             @OA\Property(
     *                 property="documents",
     *                 type="array",
     *                 @OA\Items(type="string")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Methodology not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Methodology not found")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 additionalProperties=@OA\Property(type="array", @OA\Items(type="string"))
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Some error message")
     *         )
     *     )
     * )
     */


    public function deleteDocument(Request $request, $id)
    {
        try {
            $methodology = Methodology::find($id);
            if (!$methodology) {
                return response()->json(['success' => false, 'message' => 'Methodology not found'], 404);
            }

            $request->validate([
                'document' => ['required', 'string']
            ]);

            $documents = is_array($methodology->documents)
                ? $methodology->documents
                : (json_decode($methodology->documents, true) ?? []);

            $updatedDocuments = array_filter($documents, function ($doc) use ($request) {
                return $doc !== $request->document;
            });

            $methodology->documents = array_values($updatedDocuments);
            $methodology->save();

            $filePath = public_path($request->document);
            if (is_file($filePath)) {
                unlink($filePath);
            }

            return response()->json([
                'success' => true,
                'message' => 'Document removed successfully.',
                'documents' => $updatedDocuments
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
