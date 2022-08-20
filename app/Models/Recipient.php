<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
    
    public function getRecipients()
    {
        return $this->where('multiple_recipient', 1)
        ->orWhere('multiple_recipient', 3)
        ->select('id', 'number', 'name', 'adress', 'is_submitted', 'additional_document', 'is_public_pentioner', 'multiple_recipient', 'note')
        ->orderBy('id', 'asc')
        ->paginate(25);
    }

    public function getSpecialRecipients()
    {
        return $this->where('multiple_recipient', 2)
        ->orWhere('multiple_recipient', 3)
        ->select('id', 'number', 'name', 'adress', 'is_submitted', 'additional_document', 'is_public_pentioner', 'multiple_recipient', 'note')
        ->orderBy('id', 'asc')
        ->paginate(25);
    }

    public function searchRecipients($search)
    {
        $spaceConversion = mb_convert_kana($search, 's');
        $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
        
        foreach($wordArraySearched as $value) {
            return $this->query()
            ->where('name', 'like', '%'.$value.'%')
            ->orWhere('kana', 'like', '%'.$value.'%')
            ->paginate(25);
        }
    }
}
