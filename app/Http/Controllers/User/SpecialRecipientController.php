<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use Illuminate\Http\Request;

class SpecialRecipientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
        $this->recipient = new Recipient();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        if($search){
            $special_recipients = $this->recipient->searchRecipients($search);
        } else {
            $special_recipients = $this->recipient->getSpecialRecipients();
        }
        
        session()->flash('_back_url', $request->fullUrl());

        return view('user.special_recipients.index',
        compact('special_recipients', 'search'));
    }
}