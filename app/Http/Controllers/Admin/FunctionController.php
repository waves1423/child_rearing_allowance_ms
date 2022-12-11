<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use Illuminate\Http\Request;

class FunctionController extends Controller
{
    public function __construct(Recipient $recipient)
    {
        $this->recipient = $recipient;
    }

    public function index()
    {
        return view('admin.functions.index');
    }

    public function downloadCsv()
    {
        return $this->recipient->downloadCsv();
    }

    public function uploadCsv(Request $request)
    {
        return $this->uploadCsv($request);
    }
}
