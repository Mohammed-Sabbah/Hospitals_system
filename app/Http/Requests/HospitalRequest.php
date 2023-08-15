<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=> 'required|string|min:3',
            'location'=> 'required|string|min:3',
            'info'=> 'nullable|string|max:200',
            'is_active'=> 'in:on|string',
            'cover'=> 'nullable|image|mimes:png,jpg',
        ];
    }
}
