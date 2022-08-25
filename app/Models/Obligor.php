<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Models\Recipient;

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
    
    public function calculation()
    {
        return $this->hasOne(Calculation::class);
    }

    //扶養義務者新規登録
    public function storeObligor($request)
    {
        try{
            DB::transaction(function () use($request) {
                return $this->create($request->validated());
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }
    }

    //扶養義務者情報更新
    public function updateObligor($request, $id)
    {
        try{
            DB::transaction(function () use($request, $id) {
                $recipient = Recipient::findOrFail($id);
                return $this->findOrFail($recipient->obligor->id)->fill($request->validated())->save();
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }
    }
}
