<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => 'required|string|min:2|max:255',
            'lastName' => 'required|string|min:2|max:255',
            'wineryName' => 'required_if:type,==,SELLER|string|min:4|max:255',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|min:6',
            'type' => 'required|string',
            'city' => 'required_if:type,==,SELLER|exists:cities,id',
            'location' => 'required_if:type,==,SELLER|exists:locations,id',
            'acceptTerms' => 'required|accepted',
            'acceptAge' => 'required|accepted'
        ];
    }
}
