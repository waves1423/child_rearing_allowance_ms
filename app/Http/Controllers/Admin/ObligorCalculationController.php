<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Models\Obligor;
use App\Models\Calculation;
use App\Models\Deduction;
use App\Models\Dependent;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ObligorCalculationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {    
        $recipient = Recipient::findOrFail($id);

        return view('admin.calculations.create',
        compact('recipient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $recipient = Recipient::findOrFail($id);

        try{
            DB::transaction(function () use($request, $recipient) {
                $calculation = Calculation::create([
                    'obligor_id' => $recipient->obligor->id,
                    'deducted_income' => $request->deducted_income
                ]);
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
                    'common' => $request->common
                ]);
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $id])
        ->with(['message' => '扶養義務者の所得情報を新規登録しました。',
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
        $recipient = Recipient::findOrFail($id);

        return view('admin.calculations.edit',
        compact('recipient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $recipient = Recipient::findOrFail($id);
        $obligor = Obligor::findOrFail($recipient->obligor->id);
        $calculation = Calculation::findOrFail($obligor->calculation->id);
        $dependent = Dependent::findOrFail($calculation->dependent->id);
        $income = Income::findOrFail($calculation->income->id);
        $deduction = Deduction::findOrFail($calculation->deduction->id);

        try{
            DB::transaction(function () use($request, $calculation, $dependent, $income, $deduction) {
                $calculation->deducted_income = $request->deducted_income;
                $calculation->save();

                $dependent->total = $request->total;
                $dependent->elder = $request->elder;
                $dependent->special = $request->special;
                $dependent->year_old_16to18 = $request->year_old_16to18;
                $dependent->other_child = $request->other_child;
                $dependent->save();

                $income->income = $request->income;
                $income->type = $request->type;
                $income->deducted_income = $request->deducted_income;
                $income->support_payment = $request->support_payment;
                $income->deducted_support_payment = $request->deducted_support_payment;
                $income->save();
            
                $deduction->disabled = $request->disabled;
                $deduction->specially_disabled = $request->specially_disabled;
                $deduction->singleparent_or_workingstudent = $request->singleparent_or_workingstudent;
                $deduction->special_spouse = $request->special_spouse;
                $deduction->medical_expense = $request->medical_expense;
                $deduction->small_enterprise = $request->small_enterprise;
                $deduction->other = $request->other;
                $deduction->common = $request->common;
                $deduction->save();
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $id])
        ->with(['message' => '扶養義務者の所得情報を更新しました。',
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
        $calculation = Calculation::findOrFail($id);
        $calculation->delete();

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $calculation->recipient->id])
        ->with(['message' => '扶養義務者の所得情報を削除しました。',
        'status' => 'alert']);
    }
}
