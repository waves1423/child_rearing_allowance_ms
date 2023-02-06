<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class Recipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'name',
        'kana',
        'sex',
        'birth_date',
        'adress',
        'allowance_type',
        'is_submitted',
        'additional_document',
        'is_public_pentioner',
        'multiple_recipient',
        'note'
    ];

    public function calculation()
    {
        return $this->hasOne(Calculation::class);
    }

    public function spouse()
    {
        return $this->hasOne(Spouse::class);
    }

    public function obligor()
    {
        return $this->hasOne(Obligor::class);
    }
    
    //児童扶養手当受給者情報取得
    public function getRecipients($search)
    {
        return $search ? $this->searchRecipients($search) : $this->getAllRecipients();
    }

    //特別児童扶養手当受給者情報取得
    public function getSpecialRecipients($search)
    {
        return $search ? $this->searchRecipients($search) : $this->getAllSpecialRecipients();
    }

    //受給者検索(児扶・特児共通)
    public function searchRecipients($search)
    {
        $spaceConversion = mb_convert_kana($search, 's');
        $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
        
        foreach($wordArraySearched as $value) {
            return $this->query()
            ->where('name', 'like', '%'.$value.'%')
            ->orWhere('kana', 'like', '%'.$value.'%')
            ->paginate(25);
        }
    }

    //児扶全受給者取得
    public function getAllRecipients()
    {
        return $this->where('multiple_recipient', 1)
        ->orWhere('multiple_recipient', 3)
        ->select('id', 'number', 'name', 'adress', 'is_submitted', 'additional_document', 'is_public_pentioner', 'multiple_recipient', 'note')
        ->orderBy('id', 'asc')
        ->paginate(25);
    }

    //特児全受給者取得
    public function getAllSpecialRecipients()
    {
        return $this->where('multiple_recipient', 2)
        ->orWhere('multiple_recipient', 3)
        ->select('id', 'number', 'name', 'adress', 'is_submitted', 'additional_document', 'is_public_pentioner', 'multiple_recipient', 'note')
        ->orderBy('id', 'asc')
        ->paginate(25);
    }

    //受給者新規作成
    public function storeRecipient($request)
    {
        try{
            DB::transaction(function() use($request) {
                return $this->create($request->validated());
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }
    }

    //受給者情報更新
    public function updateRecipient($request, $id)
    {
        try{
            DB::transaction(function() use($request, $id) {
                return $this->findOrFail($id)->fill($request->validated())->save();
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }
    }

    //全受給者情報（配偶者・扶養義務者を含む）をCSV形式で取得
    public function downloadCsv()
    {
        $recipients = $this->all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv"
        ];

        $callback = function() use($recipients) {
            $handle = fopen('php://output', 'w');
            
            $columns = [
                'id',
                'number',
                'name',
                'kana',
                'sex',
                'birth_date',
                'adress',
                'allowance_type',
                'is_submitted',
                'additional_document',
                'is_public_pentioner',
                'multiple_recipient',
                'note',
                'calculation_deducted_income',
                'dependents_total',
                'dependents_elder',
                'dependents_special',
                'dependents_year_old_16to18',
                'dependents_other_child',
                'incomes_income',
                'incomes_type',
                'incomes_deducted_income',
                'incomes_support_payment',
                'incomes_deducted_support_payment',
                'deductions_disabled',
                'deductions_specially_disabled',
                'deductions_singleparent_or_workingstudent',
                'deductions_special_spouse',
                'deductions_medical_expense',
                'deductions_small_enterprise',
                'deductions_other',
                'deductions_common',
                'spouse_name',
                'spouse_family_relationship',
                'spouse_calculation_deducted_income',
                'spouse_dependents_total',
                'spouse_dependents_elder',
                'spouse_dependents_special',
                'spouse_dependents_year_old_16to18',
                'spouse_dependents_other_child',
                'spouse_incomes_income',
                'spouse_incomes_type',
                'spouse_incomes_deducted_income',
                'spouse_incomes_support_payment',
                'spouse_incomes_deducted_support_payment',
                'spouse_deductions_disabled',
                'spouse_deductions_specially_disabled',
                'spouse_deductions_singleparent_or_workingstudent',
                'spouse_deductions_special_spouse',
                'spouse_deductions_medical_expense',
                'spouse_deductions_small_enterprise',
                'spouse_deductions_other',
                'spouse_deductions_common',
                'obligor_name',
                'obligor_family_relationship',
                'obligor_calculation_deducted_income',
                'obligor_dependents_total',
                'obligor_dependents_elder',
                'obligor_dependents_special',
                'obligor_dependents_year_old_16to18',
                'obligor_dependents_other_child',
                'obligor_incomes_income',
                'obligor_incomes_type',
                'obligor_incomes_deducted_income',
                'obligor_incomes_support_payment',
                'obligor_incomes_deducted_support_payment',
                'obligor_deductions_disabled',
                'obligor_deductions_specially_disabled',
                'obligor_deductions_singleparent_or_workingstudent',
                'obligor_deductions_special_spouse',
                'obligor_deductions_medical_expense',
                'obligor_deductions_small_enterprise',
                'obligor_deductions_other',
                'obligor_deductions_common',        
            ];
    
            mb_convert_variables('SJIS-win', 'UTF-8', $columns);

            fputcsv($handle, $columns);

            foreach($recipients as $recipient) {
                $csv = array_pad([
                    $recipient->id,
                    $recipient->number,
                    $recipient->name,
                    $recipient->kana,
                    $recipient->sex,
                    $recipient->birth_date,
                    $recipient->adress,
                    $recipient->allowance_type,
                    $recipient->is_submitted,
                    $recipient->additional_document,
                    $recipient->is_public_pentioner,
                    $recipient->multiple_recipient,
                    $recipient->note
                    ], 100, "");
                    
                if (!empty($recipient->calculation)) {
                    $csv[13] = $recipient->calculation->deducted_income;
                    if (!empty($recipient->calculation->dependent)) {
                        $csv[14] = $recipient->calculation->dependent->total;
                        $csv[15] = $recipient->calculation->dependent->elder;
                        $csv[16] = $recipient->calculation->dependent->special;
                        $csv[17] = $recipient->calculation->dependent->year_old_16to18;
                        $csv[18] = $recipient->calculation->dependent->other_child;
                    }
                    if (!empty($recipient->calculation->income)) {
                        $csv[19] = $recipient->calculation->income->income;
                        $csv[20] = $recipient->calculation->income->type;
                        $csv[21] = $recipient->calculation->income->deducted_income;
                        $csv[22] = $recipient->calculation->income->support_payment;
                        $csv[23] = $recipient->calculation->income->deducted_support_payment;
                    }
                    if (!empty($recipient->calculation->deduction)) {
                        $csv[24] = $recipient->calculation->deduction->disabled;
                        $csv[25] = $recipient->calculation->deduction->specially_disabled;
                        $csv[26] = $recipient->calculation->deduction->singleparent_or_workingstudent;
                        $csv[27] = $recipient->calculation->deduction->special_spouse;
                        $csv[28] = $recipient->calculation->deduction->medical_expense;
                        $csv[29] = $recipient->calculation->deduction->small_enterprise;
                        $csv[30] = $recipient->calculation->deduction->other;
                        $csv[31] = $recipient->calculation->deduction->common;
                    }
                }

                if(!empty($recipient->spouse)) {
                    $csv[32] = $recipient->spouse->name;
                    $csv[33] = $recipient->spouse->family_relationship;
                    if(!empty($recipient->spouse->calculation)) {
                        $csv[34] = $recipient->spouse->calculation->deducted_income;
                        $csv[35] = $recipient->spouse->calculation->dependent->total;
                        $csv[36] = $recipient->spouse->calculation->dependent->elder;
                        $csv[37] = $recipient->spouse->calculation->dependent->special;
                        $csv[38] = $recipient->spouse->calculation->dependent->year_old_16to18;
                        $csv[39] = $recipient->spouse->calculation->dependent->other_child;
                    }
                    if (!empty($recipient->spouse->calculation->income)) {
                        $csv[40] = $recipient->spouse->calculation->income->income;
                        $csv[41] = $recipient->spouse->calculation->income->type;
                        $csv[42] = $recipient->spouse->calculation->income->deducted_income;
                        $csv[43] = $recipient->spouse->calculation->income->support_payment;
                        $csv[44] = $recipient->spouse->calculation->income->deducted_support_payment;
                    }
                    if (!empty($recipient->spouse->calculation->deduction)) {
                        $csv[45] = $recipient->spouse->calculation->deduction->disabled;
                        $csv[46] = $recipient->spouse->calculation->deduction->specially_disabled;
                        $csv[47] = $recipient->spouse->calculation->deduction->singleparent_or_workingstudent;
                        $csv[48] = $recipient->spouse->calculation->deduction->special_spouse;
                        $csv[49] = $recipient->spouse->calculation->deduction->medical_expense;
                        $csv[50] = $recipient->spouse->calculation->deduction->small_enterprise;
                        $csv[51] = $recipient->spouse->calculation->deduction->other;
                        $csv[52] = $recipient->spouse->calculation->deduction->common;
                    }
                }

                if(!empty($recipient->obligor)) {
                    $csv[53] = $recipient->obligor->name;
                    $csv[54] = $recipient->obligor->family_relationship;
                    if(!empty($recipient->obligor->calculation)) {
                        $csv[55] = $recipient->obligor->calculation->deducted_income;
                        $csv[56] = $recipient->obligor->calculation->dependent->total;
                        $csv[57] = $recipient->obligor->calculation->dependent->elder;
                        $csv[58] = $recipient->obligor->calculation->dependent->special;
                        $csv[59] = $recipient->obligor->calculation->dependent->year_old_16to18;
                        $csv[60] = $recipient->obligor->calculation->dependent->other_child;
                    }
                    if (!empty($recipient->obligor->calculation->income)) {
                        $csv[61] = $recipient->obligor->calculation->income->income;
                        $csv[62] = $recipient->obligor->calculation->income->type;
                        $csv[63] = $recipient->obligor->calculation->income->deducted_income;
                        $csv[64] = $recipient->obligor->calculation->income->support_payment;
                        $csv[65] = $recipient->obligor->calculation->income->deducted_support_payment;
                    }
                    if (!empty($recipient->obligor->calculation->deduction)) {
                        $csv[66] = $recipient->obligor->calculation->deduction->disabled;
                        $csv[67] = $recipient->obligor->calculation->deduction->specially_disabled;
                        $csv[68] = $recipient->obligor->calculation->deduction->singleparent_or_workingstudent;
                        $csv[69] = $recipient->obligor->calculation->deduction->special_spouse;
                        $csv[70] = $recipient->obligor->calculation->deduction->medical_expense;
                        $csv[71] = $recipient->obligor->calculation->deduction->small_enterprise;
                        $csv[72] = $recipient->obligor->calculation->deduction->other;
                        $csv[73] = $recipient->obligor->calculation->deduction->common;
                    }
                }

                mb_convert_variables('SJIS-win', 'UTF-8', $csv);

                fputcsv($handle, $csv);
            }
        };

        return response()->stream($callback, 200, $headers);
    }
}
