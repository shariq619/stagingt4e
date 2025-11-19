<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationFormUpdateResource extends JsonResource
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
            'learner_id' => $this->learner_id,
            'is_valid_form' => $this->is_valid_form,
            'father_name' => $this->father_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'birth_date' => $this->birth_date,
            'address' => $this->address,
            'nationality' => $this->nationality,
            'email' => $this->email,
            'post_code' => $this->post_code,
            'phone_number' => $this->phone_number,
            'telephone' => $this->telephone,
            'name' => $this->name,
            'contact_num' => $this->contact_num,
            'relationship_to_you' => $this->relationship_to_you,
            'company' => $this->company,
            'emp_contact_name' => $this->emp_contact_name,
            'emp_contact_num' => $this->emp_contact_num,
            'emp_copmany_address' => $this->emp_copmany_address,
            'emp_post_code' => $this->emp_post_code,
            'levy_number' => $this->levy_number,
            'hear_about' => $this->hear_about,
            'guideline1' => $this->guideline1,
            'guideline2' => $this->guideline2,
            'guideline3' => $this->guideline3,
            'term' => $this->term,
            'status' => $this->status,
            'comments' => $this->comments,
            'learner_pdf' => $this->learner_pdf ? asset('storage/' . $this->learner_pdf) : null,
            'pdf' => $this->pdf ? asset($this->pdf) : null,
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'success',
            'code' => 200,
            'message' => 'Application form updated successfully',
        ];
    }
}
