<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatterUpdateRequest extends FormRequest
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
            'name' => ['nullable', 'max:255', 'string'],
            'credits' => ['required', 'numeric'],
            'level_id' => ['required', 'exists:levels,id'],
        ];
    }
}
