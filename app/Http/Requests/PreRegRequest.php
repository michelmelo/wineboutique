<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreRegRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => 'required|string|min:1|max:255',
            'lastName' => 'required|string|min:1|max:255',
            'companyName' => 'required|string|min:1|max:255',
            'email' => 'email|required|unique:users,email',
            'phone' => 'required|string|min:6',
            'brands' => 'required|integer|min:1',
            'licences' => 'required|file',
            'acceptTerms' => 'required|accepted',
        ];
    }
}
