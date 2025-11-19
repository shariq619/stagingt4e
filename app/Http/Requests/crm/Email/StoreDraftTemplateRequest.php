<?php

namespace App\Http\Requests\Crm\Email;

use Illuminate\Foundation\Http\FormRequest;

class StoreDraftTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'min:3', 'max:100'],
            'category' => ['required', 'string', 'max:100'],
            'locale' => ['required', 'string', 'max:10'],
            'subject' => ['required', 'string', 'min:2'],
            'html_body' => ['required', 'string'],
            'text_body' => ['nullable', 'string'],

            'to_recipients' => ['array'],
            'to_recipients.*' => ['string'],
            'cc_recipients' => ['array'],
            'cc_recipients.*' => ['string'],
            'bcc_recipients' => ['array'],
            'bcc_recipients.*' => ['string'],

            'attachments' => ['array'],
        ];
    }

    public function getPayload(): array
    {
        $toRecipients = $this->input('to_recipients', []);
        $ccRecipients = $this->input('cc_recipients', []);
        $bccRecipients = $this->input('bcc_recipients', []);

        return [
            'template' => [
                'code'      => $this->input('code'),
                'category'  => $this->input('category', 'transactional'),
                'active'    => 0,
                'is_draft'  => 1,
            ],

            'version' => [
                'version'       => 1,
                'is_current'    => 1,
                'layout_html'   => $this->input('layout_html', ''),
                'layout_text'   => $this->input('layout_text', ''),
                'attachments'   => $this->input('attachments', []),
                'meta'          => [
                    'to'   => $toRecipients,
                    'cc'   => $ccRecipients,
                    'bcc'  => $bccRecipients,

                    'from_name'         => $this->input('from_name'),
                    'from_email'        => $this->input('from_email'),
                    'created_by_name'   => $this->input('created_by_name'),
                    'created_by_email'  => $this->input('created_by_email'),
                    'data_source'       => $this->input('data_source'),
                    'footer_variant'    => $this->input('footer_variant'),
                    'merge_field'       => $this->input('merge_field'),
                    'newsletter_name'   => $this->input('newsletter_name'),
                ],
            ],

            'translation' => [
                'locale'     => $this->input('locale', 'en'),
                'subject'    => $this->input('subject', ''),
                'html_body'  => $this->input('html_body', ''),
                'text_body'  => $this->input('text_body', ''),
            ],
        ];
    }
}
