<?php

namespace App\Http\Controllers\User;

use App\Enums\IncomeType;
use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Models\Spouse;
use App\Models\Calculation;
use App\Models\Deduction;
use App\Models\Dependent;
use App\Models\Income;
use App\Http\Requests\SpouseCalculationRequest;
use App\Services\BackUrlService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class SpouseCalculationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
        $this->recipient = new Recipient();
        $this->spouse = new Spouse();
        $this->calculation = new Calculation();
        $this->deduction = new Deduction();
        $this->dependent = new Dependent();
        $this->income = new Income();
        $this->backUrlService = new BackUrlService();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {    
        $recipient = $this->recipient->findOrFail($id);
        $income_type_categories = IncomeType::cases();

        $this->backUrlService->keepBackUrl();

        return view('user.spouses.calculations.create',
        compact('recipient', 'income_type_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpouseCalculationRequest $request, $id)
    {
        $recipient = $this->recipient->findOrFail($id);

        try{
            DB::transaction(function () use($request, $recipient) {
                $calculation = Calculation::create([
                    'spouse_id' => $recipient->spouse->id,
                    'deducted_income' => ''
                ]);
                $this->dependent->create([
                    'calculation_id' => $calculation->id,
                    'total' => $request->total,
                    'elder' => $request->elder,
                    'special' => $request->special,
                    'year_old_16to18' => $request->year_old_16to18,
                    'other_child' => $request->other_child
                ]);
                $income = $this->income->create([
                    'calculation_id' => $calculation->id,
                    'income' => $request->income,
                    'type' => $request->type,
                    'deducted_income' => $request->income,
                ]);
                if($income->type == IncomeType::Salary->value || $income->type == IncomeType::Pention->value){
                    $income->deducted_income = $income->deducted_income - 100000;
                        if($income->deducted_income < 0){
                            $income->deducted_income = 0;
                        }
                    $income->save();
                }
                $deduction = $this->deduction->create([
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

                $total_income =
                $income->deducted_income;

                $total_deduction =
                $deduction->disabled * 270000
                +$deduction->specially_disabled * 400000
                +$deduction->singleparent_or_workingstudent * 270000
                +$deduction->special_spouse
                +$deduction->medical_expense
                +$deduction->small_enterprise
                +$deduction->other
                +$deduction->common;
                
                $calculation->deducted_income = 
                $total_income - $total_deduction;
                if($calculation->deducted_income < 0){
                    $calculation->deducted_income = 0;
                }
                $calculation->save();
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('user.recipients.show', ['recipient' => $id])
        ->with(['message' => '配偶者の所得情報を新規登録しました。',
        'status' => 'info']); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipient = $this->recipient->findOrFail($id);
        $income_type_categories = IncomeType::cases();

        $this->backUrlService->keepBackUrl();

        return view('user.spouses.calculations.edit',
        compact('recipient', 'income_type_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpouseCalculationRequest $request, $id)
    {
        $recipient = $this->recipient->findOrFail($id);
        $spouse = $this->spouse->findOrFail($recipient->spouse->id);
        $calculation = $this->spouse->findOrFail($spouse->calculation->id);
        $dependent = $this->spouse->findOrFail($calculation->dependent->id);
        $income = $this->spouse->findOrFail($calculation->income->id);
        $deduction = $this->spouse->findOrFail($calculation->deduction->id);

        try{
            DB::transaction(function () use($request, $calculation, $dependent, $income, $deduction) {
                $dependent->total = $request->total;
                $dependent->elder = $request->elder;
                $dependent->special = $request->special;
                $dependent->year_old_16to18 = $request->year_old_16to18;
                $dependent->other_child = $request->other_child;
                $dependent->save();

                $income->income = $request->income;
                $income->type = $request->type;
                if($income->type == IncomeType::Salary->value || $income->type == IncomeType::Pention->value){
                    $income->deducted_income = $request->income - 100000;
                        if($income->deducted_income < 0){
                            $income->deducted_income = 0;
                        }    
                } else {
                    $income->deducted_income = $request->income;
                }
                $income->save();
            
                $deduction->disabled = $request->disabled;
                $deduction->specially_disabled = $request->specially_disabled;
                $deduction->singleparent_or_workingstudent = $request->singleparent_or_workingstudent;
                $deduction->special_spouse = $request->special_spouse;
                $deduction->medical_expense = $request->medical_expense;
                $deduction->small_enterprise = $request->small_enterprise;
                $deduction->other = $request->other;
                $deduction->common = 80000;
                $deduction->save();

                $total_income =
                $income->deducted_income;

                $total_deduction =
                $deduction->disabled * 270000
                +$deduction->specially_disabled * 400000
                +$deduction->singleparent_or_workingstudent * 270000
                +$deduction->special_spouse
                +$deduction->medical_expense
                +$deduction->small_enterprise
                +$deduction->other
                +$deduction->common;
                
                $calculation->deducted_income = 
                $total_income - $total_deduction;
                if($calculation->deducted_income < 0){
                    $calculation->deducted_income = 0;
                }
                $calculation->save();
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('user.recipients.show', ['recipient' => $id])
        ->with(['message' => '配偶者の所得情報を更新しました。',
        'status' => 'info']); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $calculation = $this->calculation->findOrFail($id);
        $calculation->delete();

        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('user.recipients.show', ['recipient' => $calculation->recipient->id])
        ->with(['message' => '配偶者の所得情報を削除しました。',
        'status' => 'alert']);
    }
}
