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
    
    //児童扶養手当受給者情報取得
    public function getRecipients($search)
    {
        return $search ? $this->searchRecipients($search) : $this->getAllRecipients();
    }

    //特別児童扶養手当受給者情報取得
    public function getSpecialRecipients($search)
    {
        return $search ? $this->searchRecipients($search) : $this->getAllSpecialRecipients();
    }

    //受給者検索(児扶・特児共通)
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

    //児扶全受給者取得
    public function getAllRecipients()
    {
        return $this->where('multiple_recipient', 1)
        ->orWhere('multiple_recipient', 3)
        ->select('id', 'number', 'name', 'adress', 'is_submitted', 'additional_document', 'is_public_pentioner', 'multiple_recipient', 'note')
        ->orderBy('id', 'asc')
        ->paginate(25);
    }

    //特児全受給者取得
    public function getAllSpecialRecipients()
    {
        return $this->where('multiple_recipient', 2)
        ->orWhere('multiple_recipient', 3)
        ->select('id', 'number', 'name', 'adress', 'is_submitted', 'additional_document', 'is_public_pentioner', 'multiple_recipient', 'note')
        ->orderBy('id', 'asc')
        ->paginate(25);
    }
}
