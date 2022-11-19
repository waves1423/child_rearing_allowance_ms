<?php

namespace App\Services;

use Illuminate\Http\Request;

class BackUrlService
{
    //遷移元URLとして登録する
    public function setBackUrl(Request $request)
    {
        return session()->flash('_back_url', $request->fullUrl());
    }

    //登録した遷移元URLを保持する
    public function keepBackUrl()
    {
        if(session()->has('_back_url')){
            return session()->keep('_back_url');
        }    
    }
}