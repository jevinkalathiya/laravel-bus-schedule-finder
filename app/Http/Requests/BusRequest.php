<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusRequest extends FormRequest
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
            'busName' => 'required|string|max:255',
            'stopName.*' => 'required|string|max:255', // To validate each stop name
            'stopTerminal.*' => 'required|string|max:255',
            'stopTime.*' => 'required|date_format:H:i',
        ];
    }

    public function messages(): array
    {
        return [
            'busName.required' => 'The bus name is required.',
            'stopName.*.required' => 'The stop name is required.',
            'stopTerminal.*.required' => 'The stop name is required.',
            'stopTime.*.required' => 'The stop time is required.',
            'stopTime.*.date_format' => 'The stop time must be in the format HH:MM.',
        ];
    }

    protected $stopOnFirstFailure = true;
}
