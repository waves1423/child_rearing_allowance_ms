<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obligor_calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'obligor_id',
        'calculation_id',
    ];

    public function obligor()
    {
        return $this->belongsTo(Obligor::class);
    }

    public function calculation()
    {
        return $this->belongsTo(Calculation::class);
    }
}