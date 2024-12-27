<?php

namespace App\Http\Requests\Admin\Masters;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyDetailsRequest extends FormRequest
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
            'propertytypename' => 'required', 
            'propertyname' => 'required', 
            'slot' => 'required|nullable', 
            'gamount' => 'required|numeric|min:0',
            'sdamount' => 'required|numeric|min:0', 
            'citizenamount' => 'required|numeric|min:0', 
            'citizensdamount' => 'required|numeric|min:0', 
        ];
    }
}
