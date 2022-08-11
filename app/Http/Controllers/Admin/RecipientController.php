<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AllowanceType;
use App\Enums\MultipleRecipient;
use App\Enums\Sex;
use App\Http\Controllers\Controller;
use App\Models\Recipient;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        $recipients = Recipient::where('multiple_recipient', 1)
        ->orWhere('multiple_recipient', 3)
        ->select('id', 'number', 'name', 'adress', 'is_submitted', 'additional_document', 'is_public_pentioner', 'multiple_recipient', 'note')
        ->orderBy('id', 'asc')
        ->paginate(25);

        $search = $request->input('search');
        $query = Recipient::query();
        if ($search) {
            $spaceConversion = mb_convert_kana($search, 's');
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            foreach($wordArraySearched as $value) {
                $query->where('name', 'like', '%'.$value.'%')
                ->orWhere('kana', 'like', '%'.$value.'%');
            }

            $recipients = $query->paginate(25);
        }

        session()->flash('_back_url', $request->fullUrl());

        return view('admin.recipients.index',
        compact('recipients', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allowance_categories = AllowanceType::cases();
        $multiple_recipient_categories = MultipleRecipient::cases();
        $sex_categories = Sex::cases();

        if(session()->has('_back_url')){
            session()->keep('_back_url');
        }

        return view('admin.recipients.create',
        compact('allowance_categories', 'multiple_recipient_categories', 'sex_categories'));
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
                    'multiple_recipient' => $request->multiple_recipient,
                    'note' => $request->note  
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

        if(session()->has('_back_url')){
            session()->keep('_back_url');
        }

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
        $allowance_categories = AllowanceType::cases();
        $multiple_recipient_categories = MultipleRecipient::cases();
        $sex_categories = Sex::cases();

        if(session()->has('_back_url')){
            session()->keep('_back_url');
        }

        return view('admin.recipients.edit',
        compact('recipient', 'allowance_categories', 'multiple_recipient_categories', 'sex_categories'));
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
                $recipient->multiple_recipient = $request->multiple_recipient;
                $recipient->note = $request->note;
                $recipient->save();
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        if(session()->has('_back_url')){
            session()->keep('_back_url');
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
