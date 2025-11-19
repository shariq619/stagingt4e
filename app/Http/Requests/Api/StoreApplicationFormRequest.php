<?php

namespace App\Http\Requests\Api;

use App\Models\ApplicationForm;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreApplicationFormRequest extends FormRequest
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
            'is_valid_form' => 'required|in:1',
            'learner_id' => 'required|integer|exists:users,id',
            'father_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'nationality' => 'required|string|max:255',
            'post_code' => 'required|string|max:20',
            'phone_number' => 'required|string|max:20',
            'telephone' => 'nullable|string|max:20',
            'name' => 'required|string|max:255',
            'contact_num' => 'required|string|max:20',
            'relationship_to_you' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'emp_contact_name' => 'nullable|string|max:255',
            'emp_contact_num' => 'nullable|string|max:20',
            'emp_company_address' => 'nullable|string',
            'emp_post_code' => 'nullable|string|max:20',
            'levy_number' => 'nullable|string|max:255',
            'hear_about' => 'required|string|in:1,2,3,4,5,6,7,8,9,10',
            'guideline1' => 'required|in:1',
            'guideline2' => 'required|in:1',
            'guideline3' => 'required|in:1',
            'term' => 'required|in:1',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $user = Auth::user();

            if ($user) {
                $existingForm = ApplicationForm::where('learner_id', $user->id)
                    ->where('status', 'In Progress')
                    ->first();

                if ($existingForm) {
                    $validator->errors()->add('application', 'You already have an application form in progress.');
                }
            }
        });
    }
}
