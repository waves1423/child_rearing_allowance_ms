<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FunctionController extends Controller
{
    public function index()
    {
        return view('user.functions.index');
    }

    public function downloadCsv()
    {
        //
    }
}