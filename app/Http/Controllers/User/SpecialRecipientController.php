<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Services\BackUrlService;
use Illuminate\Http\Request;

class SpecialRecipientController extends Controller
{
    public function __construct(Recipient $recipient, Request $request, BackUrlService $backUrlService)
    {
        $this->recipient = $recipient;
        $this->request = $request;
        $this->backUrlService = $backUrlService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->backUrlService->setBackUrl($request);

        return view('user.special_recipients.index',
        [
            'special_recipients' => $this->recipient->getSpecialRecipients($this->request->search),
            'search' => $this->request->search
        ]);
    }
}