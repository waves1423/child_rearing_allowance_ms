<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'calculation_id',
        'income',
        'type',
        'deducted_income',
        'support_payment',
        'deducted_support_payment',
    ];

    public function calculation()
    {
        return $this->belongsTo(Calculation::class);
    }
}
