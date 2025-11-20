<?php

namespace App\Http\Requests\Crm\Email;

use Illuminate\Foundation\Http\FormRequest;

class StoreMappingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'trigger_id'     => 'required|integer|exists:email_triggers,id',
            'template_id'    => 'required|integer|exists:email_templates,id',
            'scope'          => 'nullable|string|in:global,category,course',
            'course_category'=> 'nullable|string',
            'course_id'      => 'nullable|integer',
            'recipients'     => 'nullable',
            'enabled'        => 'required|boolean',
            'priority'       => 'required|integer|min:1',
            'learner_status' => 'nullable|string',
        ];
    }

    public function getPayload(): array
    {
        $data = $this->validated();
        $recipients = $this->normalizeJson($data, 'recipients');

        return [
            'trigger_id'     => $data['trigger_id'],
            'template_id'    => $data['template_id'],
            'scope'          => $data['scope'],
            'course_category'=> $data['course_category'] ?? null,
            'course_id'      => $data['course_id'] ?? null,
            'recipients'     => $recipients,
            'enabled'        => (bool)$data['enabled'],
            'priority'       => $data['priority'],
            'learner_status' => $data['learner_status'] ?? null,
        ];
    }

    private function normalizeJson(array $data, $key)
    {
        if (!isset($data[$key])){
            return null;
        }

        $val = $data[$key];

        if (is_array($val)){
            return $val;
        }

        $decoded = json_decode($val, true);
        return (json_last_error() === JSON_ERROR_NONE) ? $decoded : $val;
    }
}
