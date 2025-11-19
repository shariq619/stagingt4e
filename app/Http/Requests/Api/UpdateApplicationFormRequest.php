<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationFormRequest extends FormRequest
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

    public function messages()
    {
        return [
            'is_valid_form.required' => 'Form validity is required.',
            'is_valid_form.in' => 'Form must be valid (value: 1).',
            'learner_id.required' => 'Learner ID is required.',
            'learner_id.integer' => 'Learner ID must be an integer.',
            'learner_id.exists' => 'Learner ID must exist in users.',
            'father_name.required' => 'Father name is required.',
            'father_name.string' => 'Father name must be a string.',
            'father_name.max' => 'Father name must not exceed 255 characters.',
            'middle_name.string' => 'Middle name must be a string.',
            'middle_name.max' => 'Middle name must not exceed 255 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.string' => 'Last name must be a string.',
            'last_name.max' => 'Last name must not exceed 255 characters.',
            'birth_date.required' => 'Birth date is required.',
            'birth_date.date' => 'Birth date must be a valid date.',
            'address.required' => 'Address is required.',
            'address.string' => 'Address must be a string.',
            'nationality.required' => 'Nationality is required.',
            'nationality.string' => 'Nationality must be a string.',
            'nationality.max' => 'Nationality must not exceed 255 characters.',
            'post_code.required' => 'Post code is required.',
            'post_code.string' => 'Post code must be a string.',
            'post_code.max' => 'Post code must not exceed 20 characters.',
            'phone_number.required' => 'Phone number is required.',
            'phone_number.string' => 'Phone number must be a string.',
            'phone_number.max' => 'Phone number must not exceed 20 characters.',
            'telephone.string' => 'Telephone must be a string.',
            'telephone.max' => 'Telephone must not exceed 20 characters.',
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name must not exceed 255 characters.',
            'contact_num.required' => 'Contact number is required.',
            'contact_num.string' => 'Contact number must be a string.',
            'contact_num.max' => 'Contact number must not exceed 20 characters.',
            'relationship_to_you.string' => 'Relationship to you must be a string.',
            'relationship_to_you.max' => 'Relationship to you must not exceed 255 characters.',
            'company.string' => 'Company must be a string.',
            'company.max' => 'Company must not exceed 255 characters.',
            'emp_contact_name.string' => 'Employer contact name must be a string.',
            'emp_contact_name.max' => 'Employer contact name must not exceed 255 characters.',
            'emp_contact_num.string' => 'Employer contact number must be a string.',
            'emp_contact_num.max' => 'Employer contact number must not exceed 20 characters.',
            'emp_company_address.string' => 'Employer company address must be a string.',
            'emp_post_code.string' => 'Employer post code must be a string.',
            'emp_post_code.max' => 'Employer post code must not exceed 20 characters.',
            'levy_number.string' => 'Levy number must be a string.',
            'levy_number.max' => 'Levy number must not exceed 255 characters.',
            'hear_about.required' => 'Hear about is required.',
            'hear_about.string' => 'Hear about must be a string.',
            'hear_about.in' => 'Hear about must be between 1 and 10.',
            'guideline1.required' => 'Guideline 1 is required.',
            'guideline1.in' => 'Guideline 1 must be accepted.',
            'guideline2.required' => 'Guideline 2 is required.',
            'guideline2.in' => 'Guideline 2 must be accepted.',
            'guideline3.required' => 'Guideline 3 is required.',
            'guideline3.in' => 'Guideline 3 must be accepted.',
            'term.required' => 'Terms and conditions must be accepted.',
            'term.in' => 'Terms and conditions must be accepted.',
        ];
    }
}
