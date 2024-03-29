<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Models\Spouse;
use App\Http\Requests\SpouseRequest;
use App\Services\BackUrlService;

class SpouseController extends Controller
{
    public function __construct(Recipient $recipient, Spouse $spouse, BackUrlService $backUrlService)
    {
        $this->middleware('auth:admin');
        $this->recipient = $recipient;
        $this->spouse = $spouse;
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

        return view('admin.spouses.create', ['recipient' => $this->recipient->findOrFail($id)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpouseRequest $request, $id)
    {
        $this->spouse->storeSpouse($request, $id);
        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $id])
        ->with(['message' => '配偶者を新規登録しました。', 'status' => 'info']); 
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

        return view('admin.spouses.edit', ['recipient' => $this->recipient->findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpouseRequest $request, $id)
    {
        $this->spouse->updateSpouse($request, $id);
        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $id])
        ->with(['message' => '配偶者情報を更新しました。', 'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->recipient->findOrFail($id)->spouse->delete();
        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $id])
        ->with(['message' => '配偶者を削除しました。', 'status' => 'alert']);
    }
}
