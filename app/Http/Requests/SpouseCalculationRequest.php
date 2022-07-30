<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpouseCalculationRequest extends FormRequest
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
            'total' => 'required|integer|max:10',
            'elder' => 'required|integer|max:10',
            'special' => 'required|integer|max:10',
            'year_old_16to18' => 'required|integer|max:10',
            'other_child' => 'required|integer|max:10',
            'income' => 'required|integer|max:1000000000',
            'type' => 'required|integer|max:10',
            'disabled' => 'required|integer|max:10',
            'specially_disabled' => 'required|integer|max:10',
            'singleparent_or_workingstudent' => 'required|integer|max:10',
            'special_spouse' => 'required|integer|max:1000000',
            'medical_expense' => 'required|integer|max:1000000',
            'small_enterprise' => 'required|integer|max:1000000',
            'other' => 'required|integer|max:1000000',
        ];
    }
}
