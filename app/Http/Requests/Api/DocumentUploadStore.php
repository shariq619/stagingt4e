<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DocumentUploadStore extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->has('second_option') && is_string($this->second_option)) {
            $decoded = json_decode($this->second_option, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $this->merge(['second_option' => $decoded]);
            } else {
                $this->merge(['second_option' => explode(',', $this->second_option)]);
            }
        }
    }

    public function rules()
    {
        $path = $this->path();

        if (str_contains($path, 'group-a')) {
            return [
                'first_option'       => 'required|in:passport,dvlaLicence,dvaLicence,birthCertificate,residencePermit',
                'first_front_upload' => 'required|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
                'first_back_upload'  => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
            ];
        }

        if (str_contains($path, 'group-b')) {
            return [
                'second_option'        => 'required|array|min:2',
                'second_option.*'      => 'in:bankStatement,utilityBill,creditCardStatement,councilTaxStatement,mortgageStatement,officialLetter,taxStatement,paperDrivingLicence,dvaLicencePhotocard,pensionStatement,UKfirearmslicence',
                'second_front_upload'  => 'required|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
                'second_back_upload'   => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
                'third_front_upload'   => 'required|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
                'third_back_upload'    => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,pdf|max:10240',
            ];
        }

        return [];
    }

    public function messages()
    {
        return [
            'first_option.required'       => 'Please select at least one option from Group A Documents',
            'first_option.in'             => 'Invalid option selected for Group A Documents',
            'first_front_upload.required' => 'Please upload Group A Front Side Document',
            'second_option.required'      => 'Please select at least two options from Group B Documents',
            'second_option.min'           => 'Please select at least two options from Group B Documents',
            'second_option.*.in'          => 'Invalid option selected for Group B Documents',
            'second_front_upload.required' => 'Please upload Group B 1st Document Front Side',
            'third_front_upload.required' => 'Please upload Group B 2nd Document Front Side',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status'  => false,
            'code'    => 422,
            'message' => 'Validation error',
            'errors'  => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);
    }
}
