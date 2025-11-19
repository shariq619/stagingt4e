<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateDocumentUploadRequest extends FormRequest
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
        'first_option' => 'sometimes|string',
        'second_option' => 'sometimes|array',
        'first_front_upload' => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'first_back_upload' => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'second_front_upload' => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'second_back_upload' => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'third_front_upload' => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'third_back_upload' => 'sometimes|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'first_front_upload.mimes' => 'The first front upload must be a file of type: webp, jpeg, png, jpg, gif, pdf.',
            'first_front_upload.max' => 'The first front upload may not be greater than 10MB.',
            'first_back_upload.mimes' => 'The first back upload must be a file of type: webp, jpeg, png, jpg, gif, pdf.',
            'first_back_upload.max' => 'The first back upload may not be greater than 10MB.',
            'second_front_upload.mimes' => 'The second front upload must be a file of type: webp, jpeg, png, jpg, gif, pdf.',
            'second_front_upload.max' => 'The second front upload may not be greater than 10MB.',
            'second_back_upload.mimes' => 'The second back upload must be a file of type: webp, jpeg, png, jpg, gif, pdf.',
            'second_back_upload.max' => 'The second back upload may not be greater than 10MB.',
            'third_front_upload.mimes' => 'The third front upload must be a file of type: webp, jpeg, png, jpg, gif, pdf.',
            'third_front_upload.max' => 'The third front upload may not be greater than 10MB.',
            'third_back_upload.mimes' => 'The third back upload must be a file of type: webp, jpeg, png, jpg, gif, pdf.',
            'third_back_upload.max' => 'The third back upload may not be greater than 10MB.',
        ];
    }

}
