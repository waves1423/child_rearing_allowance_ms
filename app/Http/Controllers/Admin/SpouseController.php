<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class SpouseController extends Controller
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
        return view('admin.spouses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        Spouse::create($request->all());
        $spouse = Spouse::findOrFail($id);

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $spouse->recipient->id])
        ->with(['message' => '配偶者を登録しました。',
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
        $spouse = Spouse::findOrFail($id);

        return view('admin.spouses.edit',
        compact('spouse'));
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
        $spouse = Spouse::findOrFail($id);

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

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $spouse->recipient->id])
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

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $spouse->recipient->id])
        ->with(['message' => '配偶者を削除しました。',
        'status' => 'alert']);
    }
}
