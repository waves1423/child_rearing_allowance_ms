<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'name',
        'kana',
        'sex',
        'birth_date',
        'adress',
        'allowance_type',
        'is_submitted',
        'additional_document',
        'is_public_pentioner',
        'multiple_recipient',
        'note'
    ];

    public function calculation()
    {
        return $this->hasOne(Calculation::class);
    }

    public function spouse()
    {
        return $this->hasOne(Spouse::class);
    }

    public function obligor()
    {
        return $this->hasOne(Obligor::class);
    }

    public function getRecipient()
    {
        return $this->where('multiple_recipient', 1)
        ->orWhere('multiple_recipient', 3)
        ->select('id', 'number', 'name', 'adress', 'is_submitted', 'additional_document', 'is_public_pentioner', 'multiple_recipient', 'note')
        ->orderBy('id', 'asc')
        ->paginate(25);

    }
}
