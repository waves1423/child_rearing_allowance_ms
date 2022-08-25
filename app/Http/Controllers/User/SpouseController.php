<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Models\Spouse;
use App\Http\Requests\SpouseRequest;
use App\Services\BackUrlService;

class SpouseController extends Controller
{
    public function __construct(Recipient $recipient, Spouse $spouse, BackUrlService $backUrlService)
    {
        $this->middleware('auth:users');
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

        return view('user.spouses.create', ['recipient' => $this->recipient->findOrFail($id)]);
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
        ->route('user.recipients.show', ['recipient' => $id])
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

        return view('user.spouses.edit', ['recipient' => $this->recipient->findOrFail($id)]);
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
        ->route('user.recipients.show', ['recipient' => $id])
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
        $this->spouse->findOrFail($id)->delete();
        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('user.recipients.show', ['recipient' => $this->spouse->recipient->findOrFail($id)])
        ->with(['message' => '配偶者を削除しました。', 'status' => 'alert']);
    }
}
