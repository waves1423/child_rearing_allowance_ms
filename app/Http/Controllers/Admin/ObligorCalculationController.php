<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Models\Calculation;
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
                Calculation::create([
                    'obligor_id' => $recipient->obligor->id,
                    //'deducted_income' => $request->deducted_income
                    'deducted_income' => 9870
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

        try{
            DB::transaction(function () use($request, $recipient) {
                //$recipient->obligor->calculation->deducted_income = $request->deducted_incom
                $recipient->obligor->calculation->deducted_income = 9870;
                $recipient->obligor->calculation->save();
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
