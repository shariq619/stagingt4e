<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentUploadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'first_option' => $this->first_option,
            'second_option' => $this->second_option ? explode(',', $this->second_option) : [],
            'first_front_upload' => $this->first_front_upload ? asset($this->first_front_upload) : null,
            'first_back_upload' => $this->first_back_upload ? asset($this->first_back_upload) : null,
            'second_front_upload' => $this->second_front_upload ? asset($this->second_front_upload) : null,
            'second_back_upload' => $this->second_back_upload ? asset($this->second_back_upload) : null,
            'third_front_upload' => $this->third_front_upload ? asset($this->third_front_upload) : null,
            'third_back_upload' => $this->third_back_upload ? asset($this->third_back_upload) : null,
            'status' => $this->status,
            'comments' => $this->comments,
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
        ];
    }

    public function with($request)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Document retrieved successfully',
            'code' => 200,
        ], 200);
    }
}
