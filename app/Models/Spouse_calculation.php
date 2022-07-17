<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spouse_calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'spouse_id',
        'calculation_id',
    ];

    public function spouse()
    {
        return $this->belongsTo(Spouse::class);
    }

    public function calculation()
    {
        return $this->belongsTo(Calculation::class);
    }
}