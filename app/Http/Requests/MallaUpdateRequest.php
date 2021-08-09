<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MallaUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'year' => ['required', 'numeric'],
            'career_id' => ['required', 'exists:careers,id'],
        ];
    }
}