<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Recipient;

class FunctionController extends Controller
{
    public function __construct(Recipient $recipient)
    {
        $this->recipient = $recipient;
    }
    public function index()
    {
        return view('user.functions.index');
    }

    public function downloadCsv()
    {
        //
    }
}
