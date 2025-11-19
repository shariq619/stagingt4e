<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        $roleName = $this->getRoleNames()->first();
        return [
            'status'  => 'success',
            'code'    => 200,
            'message' => 'Login successful',
            'data'    => [
                'user' => [
                    'id' => $this->id,
                    'reseller_id' => $this->reseller_id,
                    'client_id' => $this->client_id,
                    'methodology_id' => $this->methodology_id,
                    'name' => $this->name,
                    'middle_name' => $this->middle_name,
                    'last_name' => $this->last_name,
                    'email' => $this->email,
                    'email_verified_at' => $this->email_verified_at,
                    'gender' => $this->gender,
                    'birth_place' => $this->birth_place,
                    'birth_date' => $this->birth_date,
                    'address' => $this->address,
                    'phone_number' => $this->phone_number,
                    'company' => $this->company,
                    'website' => $this->website,
                    'telephone' => $this->telephone,
                    'image' => $this->image,
                    'password_check' => $this->password_check,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at,
                    'role'  => $roleName,
                ],
            ],
        ];
    }
}
