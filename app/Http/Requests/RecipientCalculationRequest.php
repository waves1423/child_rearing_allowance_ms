<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipientCalculationRequest extends FormRequest
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
            'total' => 'required|integer|min:0|max:10',
            'elder' => 'required|integer|min:0|max:10',
            'special' => 'required|integer|min:0|max:10',
            'year_old_16to18' => 'required|integer|min:0|max:10',
            'other_child' => 'required|integer|min:0|max:10',
            'income' => 'required|integer|max:1000000000',
            'type' => 'required|integer|max:10',
            'deducted_income' => 'required|integer|max:1000000000',
            'support_payment' => 'required|integer|min:0|max:1000000',
            'deducted_support_payment' => 'required|integer|min:0|max:1000000',
            'disabled' => 'required|integer|min:0|max:10',
            'specially_disabled' => 'required|integer|min:0|max:10',
            'singleparent_or_workingstudent' => 'required|integer|min:0|max:10',
            'special_spouse' => 'required|integer|min:0|max:1000000',
            'medical_expense' => 'required|integer|min:0|max:1000000',
            'small_enterprise' => 'required|integer|min:0|max:1000000',
            'other' => 'required|integer|min:0|',
        ];
    }

    protected function prepareForValidation()
    {
        $deducted_income = $this->income;
        $deducted_support_payment = $this->support_payment * 0.8;
        $this->merge([
            'deducted_income' => $deducted_income,
            'deducted_support_payment' => $deducted_support_payment,
        ]);
    }
}
