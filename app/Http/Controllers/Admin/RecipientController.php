<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Sex;
use App\Enums\AllowanceType;
use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Models\Calculation;
use App\Http\Requests\RecipientRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class RecipientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipients = Recipient::select('id', 'number', 'name', 'adress', 'is_submitted', 'additional_document', 'is_public_pentioner')
        ->get();

        return view('admin.recipients.index',
        compact('recipients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sex_categories = Sex::cases();
        $allowance_categories = AllowanceType::cases();

        return view('admin.recipients.create',
        compact('sex_categories', 'allowance_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecipientRequest $request)
    {
        try{
            DB::transaction(function () use($request) {
                Recipient::create([
                    'number' => $request->number,
                    'name' => $request->name,
                    'kana' => $request->kana,
                    'sex' => $request->sex,
                    'birth_date' => $request->birth_date,
                    'adress' => $request->adress,
                    'allowance_type' => $request->allowance_type,
                    'is_submitted' => $request->is_submitted,
                    'additional_document' => $request->additional_document,
                    'is_public_pentioner' => $request->is_public_pentioner,
                    'note' => $request->note  
                ]);
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        return redirect()
        ->route('admin.recipients.index')
        ->with(['message' => '受給者を新規登録しました。',
        'status' => 'info']); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipient = Recipient::findOrFail($id);

        return view('admin.recipients.show',
        compact('recipient'));
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
        $sex_categories = Sex::cases();
        $allowance_categories = AllowanceType::cases();

        return view('admin.recipients.edit',
        compact('recipient', 'allowance_categories', 'sex_categories'));
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
        $recipient = Recipient::findOrFail($id);

        try{
            DB::transaction(function () use($request, $recipient) {
                $recipient->number = $request->number;
                $recipient->name = $request->name;
                $recipient->kana = $request->kana;
                $recipient->sex = $request->sex;
                $recipient->birth_date = $request->birth_date;
                $recipient->adress = $request->adress;
                $recipient->allowance_type = $request->allowance_type;
                $recipient->is_submitted = $request->is_submitted;
                $recipient->additional_document = $request->additional_document;
                $recipient->is_public_pentioner = $request->is_public_pentioner;
                $recipient->note = $request->note;
                $recipient->save();
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        return redirect()
        ->route('admin.recipients.show', ['recipient' => $recipient->id])
        ->with(['message' => '受給者情報を更新しました。',
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
        Recipient::findOrFail($id)->delete();

        return redirect()
        ->route('admin.recipients.index')
        ->with(['message' => '受給者を削除しました。',
            'status' => 'alert']);
    }
}
