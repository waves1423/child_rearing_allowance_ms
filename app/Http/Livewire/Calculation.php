<?php

namespace App\Http\Livewire;

use App\Models\Recipient;
use Livewire\Component;

class Calculation extends Component
{
    public $recipient;
    public $income_type_categories;

    public function render()
    {
        return view('livewire.calculation');
    }
}
