<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewWineRequest extends FormRequest
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
            'name' => ['required', 'max:192'],
            'price' => ['required', 'numeric', 'min:1'],
            'description' => ['required'],
            'who_made_it' => ['required'],
            'when_was_it_made' => ['required'],
            'capacity' => ['required', 'numeric'],
            'unit_id' => ['required', 'exists:capacity_units,id'],
            'photo' => ['image'],
            'varietal' => ['required', 'exists:varietals,id'],
        ]; 
    }
}
