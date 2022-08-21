<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Models\Obligor;
use App\Http\Requests\ObligorRequest;
use App\Services\BackUrlService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ObligorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
        $this->recipient = new Recipient();
        $this->obligor = new Obligor();
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

        $this->backUrlService->keepBackUrl();

        return view('user.obligors.create',
        compact('recipient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ObligorRequest $request, $id)
    {
        try{
            DB::transaction(function () use($request, $id) {
                $this->obligor->create([
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
        ->with(['message' => '扶養義務者を新規登録しました。',
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

        $this->backUrlService->keepBackUrl();

        return view('user.obligors.edit',
        compact('recipient'));
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
        $recipient = $this->recipient->findOrFail($id);
        $obligor = $this->obligor->findOrFail($recipient->obligor->id);

        try{
            DB::transaction(function () use($request, $obligor) {
                $obligor->name = $request->name;
                $obligor->family_relationship = $request->family_relationship;
                $obligor->save();
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('user.recipients.show', ['recipient' => $id])
        ->with(['message' => '扶養義務者情報を更新しました。',
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
        $obligor = $this->obligor->findOrFail($id);
        $obligor->delete();

        $this->backUrlService->keepBackUrl();

        return redirect()
        ->route('user.recipients.show', ['recipient' => $obligor->recipient->id])
        ->with(['message' => '扶養義務者を削除しました。',
        'status' => 'alert']);
    }
}
