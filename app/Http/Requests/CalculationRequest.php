<?php

namespace App\Http\Requests;

use App\Enums\IncomeType;
use Illuminate\Foundation\Http\FormRequest;

class CalculationRequest extends FormRequest
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
            'support_payment' => 'min:0|max:1000000',
            'deducted_support_payment' => 'integer|min:0|max:1000000',
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
        //給与所得または年金所得の場合10万円、両方であれば20万円を控除する
        if($this->type == IncomeType::Salary->value || $this->type == IncomeType::Pention->value){
            $deducted_income = $this->income - 100000;
        } elseif($this->type == IncomeType::SalaryAndPention->value) {
            $deducted_income = $this->income - 200000;
        } else {
            $deducted_income = $this->income;
        }

        //所得がマイナスになる場合は0とした上、リクエストに追加
        $this->income < 0 ? $this->income = 0 : '';
        $deducted_income < 0 ? $deducted_income = 0 : '';
        $this->merge(['deducted_income' => $deducted_income]);

        // 養育費の入力がある場合、8割掛けした額をリクエストに追加
        $this->support_payment ? $this->merge(['deducted_support_payment' => $this->support_payment * 0.8]) : "";
    }

    protected function getTotalIncome($request)
    {
        $total_income =
        $request->deducted_income
        +$request->deducted_support_payment;

        $total_deduction =
        $request->disabled * 270000
        +$request->specially_disabled * 400000
        +$request->singleparent_or_workingstudent * 270000
        +$request->special_spouse
        +$request->medical_expense
        +$request->small_enterprise
        +$request->other
        +$request->common;
        
        $total_deducted_income = $total_income - $total_deduction;
        $total_deducted_income < 0 ? $total_deducted_income = 0 : '';

        return $total_deducted_income;
    }
}
