<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient_id',
        'spouse_id',
        'obligor_id',
        'deducted_income',
    ];

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }

    public function spouse()
    {
        return $this->belongsTo(Spouse::class);
    }

    public function obligor()
    {
        return $this->belongsTo(Obligor::class);
    }

    public function dependent()
    {
        return $this->hasOne(Dependent::class);
    }

    public function income()
    {
        return $this->hasOne(Income::class);
    }

    public function deduction()
    {
        return $this->hasOne(Deduction::class);
    }
}
