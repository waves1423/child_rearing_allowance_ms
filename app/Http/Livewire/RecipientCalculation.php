<?php

namespace App\Http\Livewire;

use App\Models\Calculation;
use Livewire\Component;

class RecipientCalculation extends Component
{
    // public $recipient;
    public $income = 0;
    // public $income_type_categories;
    // public $income_type_category;
    public $deducted_income = 0;
    public $support_payment = 0;
    public $deducted_support_payment = 0;
    // public $total_deducted_income = 0;

    // protected $listeners = [
    //     'income' => 'income'
    // ];

    // protected $rules = [
    //     'income' => ['required'],
    //     'deducted_income' => ['required']
    // ];

    // public function mount(Calculation $deducted_income)
    // {
    //     $this->deducted_income = $deducted_income;
    //     $deducted_income = $this->income - 40;
    // }

    // public function calculate()
    // {
    //     $recipient_income = (float)$this->recipient_income;
    //     $deducted_income = (float)$this->deducted_income;
    //     $this->deducted_income = $this->recipient_income - 1000;
    // }

    public function render()
    {
        $this->deducted_income = $this->income - 100000;
        $this->deducted_support_payment = $this->support_payment * 0.8;
        // $this->total_deducted_income = $this->deducted_income + $this->deducted_support_payment;

        return view('livewire.recipient-calculation');
    }
}
