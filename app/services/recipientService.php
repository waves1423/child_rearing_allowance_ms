<?php

namespace App\Services;

use App\Models\Recipient;

class RecipientService
{
    public function __construct()
    {
        $this->recipient = new Recipient();
    }

    public function getRecipients($search)
    {        
        if($search){
            return $this->recipient->searchRecipients($search);
        } else {
            return $this->recipient->getAllRecipients();
        }
    }

    public function getSpecialRecipients($search)
    {        
        if($search){
            return $this->recipient->searchRecipients($search);
        } else {
            return $this->recipient->getAllSpecialRecipients();
        }
    }
}