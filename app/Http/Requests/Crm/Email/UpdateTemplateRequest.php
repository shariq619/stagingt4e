<?php

namespace App\Http\Requests\Crm\Email;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category'   => ['nullable', 'string', 'max:100'],
            'active'     => ['nullable'],
            'is_draft'   => ['nullable'],

            'locale'     => ['nullable', 'string', 'max:10'],
            'subject'    => ['nullable', 'string'],
            'html_body'  => ['nullable', 'string'],
            'text_body'  => ['nullable', 'string'],

            'layout_html' => ['nullable', 'string'],
            'layout_text' => ['nullable', 'string'],

            'attachments' => ['sometimes', 'array'],
            'attachments.*' => ['nullable', 'array'],
            'attachments.*.name' => ['required_with:attachments', 'string'],
            'attachments.*.url'  => ['required_with:attachments', 'string'],
            'attachments.*.size' => ['nullable', 'string'],

            'from_name'         => ['nullable', 'string'],
            'from_email'        => ['nullable', 'string'],
            'created_by_name'   => ['nullable', 'string'],
            'created_by_email'  => ['nullable', 'string'],
            'data_source'       => ['nullable', 'string'],
            'merge_field'       => ['nullable', 'string'],
            'newsletter_name'   => ['nullable', 'string'],

            'to_recipients'   => ['nullable', 'array'],
            'to_recipients.*' => ['nullable', 'string'],
            'cc_recipients'   => ['nullable', 'array'],
            'cc_recipients.*' => ['nullable', 'string'],
            'bcc_recipients'   => ['nullable', 'array'],
            'bcc_recipients.*' => ['nullable', 'string'],
        ];
    }
}
