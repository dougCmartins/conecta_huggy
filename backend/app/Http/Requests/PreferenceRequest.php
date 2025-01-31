<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreferenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'                        => ['required', 'string'],
            'email'                       => ['required', 'string', 'email'],
            'preference'                  => ['nullable','array'],
            'preference.is_subscribed'    => ['boolean'],
            'preference.segment_ids'      => ['nullable', 'array'],
            'preference.segment_ids.*'    => ['exists:segments,id'],
        ];
    }
}
