<?php

namespace App\Http\Controllers\User;

use App\Enums\AllowanceType;
use App\Enums\MultipleRecipient;
use App\Enums\Sex;
use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Services\BackUrlService;
use Illuminate\Http\Request;
use App\Http\Requests\RecipientRequest;

class RecipientController extends Controller
{
    public function __construct(Recipient $recipient, Request $request, BackUrlService $backUrlService)
    {
        $this->middleware('auth:users');
        $this->recipient = $recipient;
        $this->request = $request;
        $this->backUrlService = $backUrlService;
        $this->allowanceCategories = AllowanceType::cases();
        $this->multipleRecipientCategories = MultipleRecipient::cases();
        $this->sexCategories = Sex::cases();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->backUrlService->setBackUrl($request);

        return view('user.recipients.index',
        [
            'recipients' => $this->recipient->getRecipients($this->request->search),
            'search' => $this->request->search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->backUrlService->keepBackUrl();

        return view('user.recipients.create',
        [
            'allowance_categories' => $this->allowanceCategories,
            'multiple_recipient_categories' => $this->multipleRecipientCategories,
            'sex_categories' => $this->sexCategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecipientRequest $request)
    {
        $this->recipient->storeRecipient($request);
        $redirect = session()->has('_back_url') ? redirect(session('_back_url')) : redirect()->route('user.recipients.index');

        return $redirect->with(['message' => '受給者を新規登録しました。', 'status' => 'info']);     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->backUrlService->keepBackUrl();
        
        return view('user.recipients.show', ['recipient' => $this->recipient->findOrFail($id)]);
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

        return view('user.recipients.edit',
        [
            'recipient' => $this->recipient->findOrFail($id),
            'allowance_categories' => $this->allowanceCategories,
            'multiple_recipient_categories' => $this->multipleRecipientCategories,
            'sex_categories' => $this->sexCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RecipientRequest $request, $id)
    {
        $this->recipient->updateRecipient($request, $id);
        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('user.recipients.show', ['recipient' => $this->recipient->findOrFail($id)])
        ->with(['message' => '受給者情報を更新しました。', 'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->recipient->findOrFail($id)->delete();

        return redirect()
        ->route('user.recipients.index')
        ->with(['message' => '受給者を削除しました。', 'status' => 'alert']);
    }
}
