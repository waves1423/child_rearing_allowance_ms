<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Models\Spouse;
use App\Http\Requests\SpouseRequest;
use App\Services\BackUrlService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class SpouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
        $this->backUrlService = new BackUrlService();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $recipient = Recipient::findOrFail($id);

        $this->backUrlService->keepBackUrl();

        return view('user.spouses.create',
        compact('recipient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpouseRequest $request, $id)
    {
        try{
            DB::transaction(function () use($request, $id) {
                Spouse::create([
                    'recipient_id' => $id,
                    'name' => $request->name,
                    'family_relationship' => $request->family_relationship,
                ]);
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('user.recipients.show', ['recipient' => $id])
        ->with(['message' => '配偶者を新規登録しました。',
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

        $this->backUrlService->keepBackUrl();

        return view('user.spouses.edit',
        compact('recipient'));
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
        $recipient = Recipient::findOrFail($id);
        $spouse = Spouse::findOrFail($recipient->spouse->id);

        try{
            DB::transaction(function () use($request, $spouse) {
                $spouse->name = $request->name;
                $spouse->family_relationship = $request->family_relationship;
                $spouse->save();
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('user.recipients.show', ['recipient' => $id])
        ->with(['message' => '配偶者情報を更新しました。',
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
        $spouse = Spouse::findOrFail($id);
        $spouse->delete();

        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('user.recipients.show', ['recipient' => $spouse->recipient->id])
        ->with(['message' => '配偶者を削除しました。',
        'status' => 'alert']);
    }
}
