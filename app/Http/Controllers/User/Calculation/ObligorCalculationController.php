<?php

namespace App\Http\Controllers\User\Calculation;

use App\Enums\IncomeType;
use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Models\Calculation;
use App\Http\Requests\CalculationRequest;
use App\Services\BackUrlService;

class ObligorCalculationController extends Controller
{
    public function __construct(Recipient $recipient, Calculation $calculation, BackUrlService $backUrlService)
    {
        $this->middleware('auth:users');
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

        return view('user.obligors.calculations.create',
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
        $this->calculation->storeObligorCalculation($request, $id);
        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('user.recipients.show', ['recipient' => $id])
        ->with(['message' => '扶養義務者の所得情報を新規登録しました。', 'status' => 'info']); 
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

        return view('user.obligors.calculations.edit',
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
        $this->calculation->updateObligorCalculation($request, $id);
        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('user.recipients.show', ['recipient' => $id])
        ->with(['message' => '扶養義務者の所得情報を更新しました。', 'status' => 'info']); 
    }
}
