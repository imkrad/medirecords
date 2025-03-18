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
            'type_id' => 'required_if:service_id,9',
            'method_id' => 'required_if:service_id,9',
            'lmp_at' => 'required_if:service_id,8',
            'edc_at' => 'required_if:service_id,8',
            'cpab_id' => 'required_if:service_id,7',
            'weight_id' => 'required_if:service_id,7',
            'weight' => 'required_if:service_id,7',
            'length' => 'required_if:service_id,7',
            'was_breastfeed' => 'required_if:service_id,7',
            'registration_at' => 'required'
        ];
    }
}
