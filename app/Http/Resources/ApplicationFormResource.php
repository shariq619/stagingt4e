<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationFormResource extends JsonResource
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
            'is_valid_form' => (bool)$this->is_valid_form,
            'name' => $this->name,
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
            'emergency_contact' => [
                'name' => $this->name,
                'contact_num' => $this->contact_num,
                'relationship' => $this->relationship_to_you
            ],
            'employment_details' => [
                'company' => $this->company,
                'contact_name' => $this->emp_contact_name,
                'contact_number' => $this->emp_contact_num,
                'company_address' => $this->emp_copmany_address,
                'post_code' => $this->emp_post_code,
                'levy_number' => $this->levy_number
            ],
            'hear_about' => $this->hear_about,
            'guidelines' => [
                'guideline1' => (bool)$this->guideline1,
                'guideline2' => (bool)$this->guideline2,
                'guideline3' => (bool)$this->guideline3
            ],
            'term_accepted' => (bool)$this->term,
            'status' => $this->status,
            'comments' => $this->comments,
            'learner_pdf' => $this->learner_pdf ? asset('storage/' . $this->learner_pdf) : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
