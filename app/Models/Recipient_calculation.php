<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient_calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient_id',
        'calculation_id',
    ];

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }

    public function calculation()
    {
        return $this->belongsTo(Calculation::class);
    }
}
