<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Models\Obligor;
use App\Http\Requests\ObligorRequest;
use App\Services\BackUrlService;

class ObligorController extends Controller
{
    public function __construct(Recipient $recipient, Obligor $obligor, BackUrlService $backUrlService)
    {
        $this->middleware('auth:admin');
        $this->recipient = $recipient;
        $this->obligor = $obligor;
        $this->backUrlService = $backUrlService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $this->backUrlService->keepBackUrl();

        return view('admin.obligors.create', ['recipient' => $this->recipient->findOrFail($id)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObligorRequest $request, $id)
    {
        $this->obligor->storeObligor($request);
        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $id])
        ->with(['message' => '扶養義務者を新規登録しました。', 'status' => 'info']); 
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

        return view('admin.obligors.edit', ['recipient' => $this->recipient->findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ObligorRequest $request, $id)
    {
        $this->obligor->updateObligor($request, $id);
        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $id])
        ->with(['message' => '扶養義務者情報を更新しました。', 'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->recipient->findOrFail($id)->obligor->delete();
        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $id])
        ->with(['message' => '扶養義務者を削除しました。', 'status' => 'alert']);
    }
}
