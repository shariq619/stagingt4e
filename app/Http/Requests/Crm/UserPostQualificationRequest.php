<?php

namespace App\Http\Requests\Crm;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UserPostQualificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'qualification_status' => 'required|in:Passed,Failed',
            'date_of_last_expiry' => 'nullable|date',
            'registration_date' => 'nullable|date',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $registration = $this->input('date_of_last_expiry');
            $expiry = $this->input('registration_date');

            if ($expiry && $registration) {
                $expiryDate = Carbon::parse($expiry);
                $registrationDate = Carbon::parse($registration);
                $minRegistrationDate = $expiryDate->addYears(3);

                if ($registrationDate->lt($minRegistrationDate)) {
                    $validator->errors()->add(
                        'date_of_last_expiry',
                        'The Date of Last Expiry must be at least 3 years after the date of last expiry.'
                    );
                }
            }
        });
    }
}
