<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{

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
            'patient_id' => 'required',
            'service_id' => 'required|integer',
            'is_nhts' => 'required',
            'type_id' => 'required_if:service_id,9|integer',
            'method_id' => 'required_if:service_id,9|integer',
            'source' => 'nullable',
            'registration_at' => 'required'
        ];
    }
}
