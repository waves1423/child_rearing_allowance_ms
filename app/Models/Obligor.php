<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obligor extends Model
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
    
    public function obligor_calculation()
    {
        return $this->hasOne(Obligor_calculation::class);
    }
}
