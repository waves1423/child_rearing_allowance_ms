<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialRecipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient_id',
        'allowance_type',
        'is_submitted',
        'additional_document',
        'is_public_pentioner',
        'note'
    ];

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }
}
