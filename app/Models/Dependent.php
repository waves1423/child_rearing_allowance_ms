<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{
    use HasFactory;

    protected $fillable = [
        'calculation_id',
        'total',
        'elder',
        'special',
        'year_old_16to18',
        'other_child',
    ];

    public function calculation()
    {
        return $this->belongsTo(Calculation::class);
    }
}
