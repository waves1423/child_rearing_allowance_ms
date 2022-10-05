<?php

namespace App\Services;

use Illuminate\Http\Request;

class BackUrlService
{
    public function setBackUrl(Request $request)
    {
        return session()->flash('_back_url', $request->fullUrl());
    }

    public function keepBackUrl()
    {
        if(session()->has('_back_url')){
            return session()->keep('_back_url');
        }    
    }
}