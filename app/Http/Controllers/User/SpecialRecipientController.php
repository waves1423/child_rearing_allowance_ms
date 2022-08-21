<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Services\BackUrlService;
use App\Services\RecipientService;
use Illuminate\Http\Request;

class SpecialRecipientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
        $this->recipient = new Recipient();
        $this->recipientService = new RecipientService();
        $this->backUrlService = new BackUrlService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $special_recipients = $this->recipientService->getSpecialRecipients($search);

        $this->backUrlService->setBackUrl($request);

        return view('user.special_recipients.index',
        compact('special_recipients', 'search'));
    }
}