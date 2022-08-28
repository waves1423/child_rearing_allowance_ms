<?php

namespace App\Http\Controllers\Admin\Calculation;

use App\Enums\IncomeType;
use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Models\Calculation;
use App\Http\Requests\CalculationRequest;
use App\Services\BackUrlService;

class RecipientCalculationController extends Controller
{
    public function __construct(Recipient $recipient, Calculation $calculation, BackUrlService $backUrlService)
    {
        $this->middleware('auth:admin');
        $this->recipient = $recipient;
        $this->calculation = $calculation;
        $this->backUrlService = $backUrlService;
        $this->incomeTypeCategories = IncomeType::cases();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {    
        $this->backUrlService->keepBackUrl();

        return view('admin.recipients.calculations.create',
        [
            'recipient' => $this->recipient->findOrFail($id),
            'income_type_categories' => $this->incomeTypeCategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CalculationRequest $request, $id)
    {
        $this->calculation->storeRecipientCalculation($request, $id);
        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $id])
        ->with(['message' => '受給者の所得情報を新規登録しました。', 'status' => 'info']); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->backUrlService->keepBackUrl();

        return view('admin.recipients.calculations.edit',
        [
            'recipient' => $this->recipient->findOrFail($id),
            'income_type_categories' => $this->incomeTypeCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CalculationRequest $request, $id)
    {
        $this->calculation->updateRecipientCalculation($request, $id);
        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $id])
        ->with(['message' => '受給者の所得情報を更新しました。', 'status' => 'info']); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->calculation->findOrFail($id)->delete();
        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $this->calculation->recipient->id])
        ->with(['message' => '受給者の所得情報を削除しました。', 'status' => 'alert']);
    }
}
