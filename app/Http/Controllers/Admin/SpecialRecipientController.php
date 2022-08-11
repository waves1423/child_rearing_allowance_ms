<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use Illuminate\Http\Request;

class SpecialRecipientController extends Controller
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
        $special_recipients = Recipient::where('multiple_recipient', 2)
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

            $special_recipients = $query->paginate(25);
        }
        
        session()->flash('_back_url', $request->fullUrl());

        return view('admin.special_recipients.index',
        compact('special_recipients', 'search'));
    }
}