<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obligor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ObligorController extends Controller
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
    public function create()
    {
        return view('admin.obligors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        Obligor::create($request->all());
        $obligor = Obligor::findOrFail($id);

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $obligor->recipient->id])
        ->with(['message' => '扶養義務者を登録しました。',
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
        $obligor = Obligor::findOrFail($id);

        return view('admin.obligors.edit',
        compact('obligor'));
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
        $obligor = Obligor::findOrFail($id);

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

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $obligor->recipient->id])
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

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $obligor->recipient->id])
        ->with(['message' => '扶養義務者を削除しました。',
        'status' => 'alert']);
    }
}
