<?php

namespace App\Models;

use App\Models\Deduction;
use App\Models\Dependent;
use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class Calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient_id',
        'spouse_id',
        'obligor_id',
        'deducted_income',
    ];

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }

    public function spouse()
    {
        return $this->belongsTo(Spouse::class);
    }

    public function obligor()
    {
        return $this->belongsTo(Obligor::class);
    }

    public function dependent()
    {
        return $this->hasOne(Dependent::class);
    }

    public function income()
    {
        return $this->hasOne(Income::class);
    }

    public function deduction()
    {
        return $this->hasOne(Deduction::class);
    }

    public function storeRecipientCalculation($request, $id)
    {
        try{
            DB::transaction(function () use($request, $id) {
                $calculation = $this->create([
                    'recipient_id' => $id,
                    'deducted_income' => $this->getTotalIncome($request)
                ]);
                $this->storeCalculationInfomation($calculation, $request);
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }
    }

    public function storeSpouseCalculation($request, $id)
    {
        try{
            DB::transaction(function () use($request, $id) {
                $calculation = $this->create([
                    'spouse_id' => Recipient::findOrFail($id)->spouse->id,
                    'deducted_income' => $this->getTotalIncome($request)
                ]);
                $this->storeCalculationInfomation($calculation, $request);
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }
    }

    public function storeObligorCalculation($request, $id)
    {
        try{
            DB::transaction(function () use($request, $id) {
                $calculation = $this->create([
                    'obligor_id' => Recipient::findOrFail($id)->obligor->id,
                    'deducted_income' => $this->getTotalIncome($request)
                ]);
                $this->storeCalculationInfomation($calculation, $request);
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }
    }

    public function storeCalculationInfomation($calculation, $request)
    {
        Dependent::create([
            'calculation_id' => $calculation->id,
            'total' => $request->total,
            'elder' => $request->elder,
            'special' => $request->special,
            'year_old_16to18' => $request->year_old_16to18,
            'other_child' => $request->other_child
        ]);
        Income::create([
            'calculation_id' => $calculation->id,
            'income' => $request->income,
            'type' => $request->type,
            'deducted_income' => $request->deducted_income,
            'support_payment' => $request->support_payment,
            'deducted_support_payment' => $request->deducted_support_payment
        ]);
        Deduction::create([
            'calculation_id' => $calculation->id,
            'disabled' => $request->disabled,
            'specially_disabled' => $request->specially_disabled,
            'singleparent_or_workingstudent' => $request->singleparent_or_workingstudent,
            'special_spouse' => $request->special_spouse,
            'medical_expense' => $request->medical_expense,
            'small_enterprise' => $request->small_enterprise,
            'other' => $request->other,
            'common' => 80000
        ]);
    }

    public function getTotalIncome($request)
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
        +80000;
        
        $total_deducted_income = $total_income - $total_deduction;
        $total_deducted_income < 0 ? $total_deducted_income = 0 : '';

        return $total_deducted_income;
    }

    public function updateRecipientCalculation($request, $id)
    {
        try{
            DB::transaction(function () use($request, $id) {
                $calculation = Recipient::findOrFail($id)->calculation;
                $this->updateCalculationInfomation($request, $calculation);
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }
    }

    public function updateSpouseCalculation($request, $id)
    {
        try{
            DB::transaction(function () use($request, $id) {
                $calculation = Recipient::findOrFail($id)->spouse->calculation;
                $this->updateCalculationInfomation($request, $calculation);
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }
    }

    public function updateObligorCalculation($request, $id)
    {
        try{
            DB::transaction(function () use($request, $id) {
                $calculation = Recipient::findOrFail($id)->obligor->calculation;
                $this->updateCalculationInfomation($request, $calculation);
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }
    }

    public function updateCalculationInfomation($request, $calculation)
    {
        $this->findOrFail($calculation->id)
        ->fill(['deducted_income' => $this->getTotalIncome($request)])->save();
        Dependent::findOrFail($calculation->dependent->id)
        ->fill($request->validated())->save();
        Income::findOrFail($calculation->income->id)
        ->fill($request->validated())->save();
        Deduction::findOrFail($calculation->deduction->id)
        ->fill($request->validated())->save();
    }
}
