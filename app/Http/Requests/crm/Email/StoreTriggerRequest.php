<?php

namespace App\Http\Requests\Crm\Email;

use Illuminate\Foundation\Http\FormRequest;

class StoreTriggerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'key'        => 'required|string|unique:email_triggers,key',
            'entity'     => 'required|string',
            'type'       => 'required|string|in:status,time,event',
            'definition' => 'nullable',
            'active'     => 'required|boolean',
        ];
    }

    public function getPayload(): array
    {
        $data = $this->validated();
        $data['definition'] = $this->normalizeJson($data, 'definition');

        return [
            'key'        => $data['key'],
            'entity'     => $data['entity'],
            'type'       => $data['type'],
            'definition' => $data['definition'],
            'active'     => (bool)$data['active'],
        ];
    }

    private function normalizeJson(array $data, $key)
    {
        if (!isset($data[$key])) return null;
        $val = $data[$key];
        if (is_array($val)) return $val;
        $decoded = json_decode($val, true);
        return (json_last_error() === JSON_ERROR_NONE) ? $decoded : $val;
    }
}
