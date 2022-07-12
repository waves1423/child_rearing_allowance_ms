<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{
    use HasFactory;

    protected $fillable = [
        'calculation_id',
        'elder',
        'special',
        '16-18_year_old',
        'other_child',
    ];

    public function calculation()
    {
        return $this->belongsTo(Calculation::class);
    }
}
