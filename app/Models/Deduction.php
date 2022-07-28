<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'calculation_id',
        'disabled',
        'specially_disabled',
        'singleparent_or_workingstudent',
        'special_spouse',
        'medical_expense',
        'small_enterprise',
        'other',
        'common',
    ];

    public function calculation()
    {
        return $this->belongsTo(Calculation::class);
    }
}
