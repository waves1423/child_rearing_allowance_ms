<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipientRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'number' => 'required|regex:/^[a-zA-Z0-9\-]+$/u|max:20',
            'name' => 'required|string|max:50',
            'kana' => 'required|string|max:50',
            'sex' => 'required',
            'birth_date' => 'required|date',
            'adress' => 'required|string|max:100',
            'allowance_type' => 'required',
            'is_submitted' => 'required|boolean',
            'additional_document' => 'nullable|string|max:100',
            'is_public_pentioner' => 'required|boolean',
            'note' => 'nullable|string|max:1000',
        ];
    }
}
