<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeleteObligor extends Component
{
    public $recipient;

    public function __construct($recipient)
    {
        $this->recipient = $recipient;
    }

    public function render()
    {
        return view('components.delete-obligor');
    }
}
