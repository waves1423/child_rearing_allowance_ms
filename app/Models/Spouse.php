<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient_id',
        'name',
        'family_relationship',
    ];

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }

    public function calculation()
    {
        return $this->hasOne(Calculation::class);
    }

    // public function spouse_calculation()
    // {
    //     return $this->hasOne(Spouse_calculation::class);
    // }
}
