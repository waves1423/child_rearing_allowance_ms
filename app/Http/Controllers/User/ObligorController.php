<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Models\Obligor;
use App\Http\Requests\ObligorRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ObligorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $recipient = Recipient::findOrFail($id);

        if(session()->has('_back_url')){
            session()->keep('_back_url');
        }

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
                Obligor::create([
                    'recipient_id' => $id,
                    'name' => $request->name,
                    'family_relationship' => $request->family_relationship,
                ]);
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        if(session()->has('_back_url')){
            session()->keep('_back_url');
        }

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
        $recipient = Recipient::findOrFail($id);

        if(session()->has('_back_url')){
            session()->keep('_back_url');
        }

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
        $recipient = Recipient::findOrFail($id);
        $obligor = Obligor::findOrFail($recipient->obligor->id);

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

        if(session()->has('_back_url')){
            session()->keep('_back_url');
        }

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
        $obligor = Obligor::findOrFail($id);
        $obligor->delete();

        if(session()->has('_back_url')){
            session()->keep('_back_url');
        }

        return redirect()
        ->route('user.recipients.show', ['recipient' => $obligor->recipient->id])
        ->with(['message' => '扶養義務者を削除しました。',
        'status' => 'alert']);
    }
}
