<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;
use Goodby\CSV\Import\Standard\LexerConfig;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use GuzzleHttp\Psr7\Request;

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

    //受給者新規作成
    public function storeRecipient($request)
    {
        try{
            DB::transaction(function() use($request) {
                return $this->create($request->validated());
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }
    }

    //受給者情報更新
    public function updateRecipient($request, $id)
    {
        try{
            DB::transaction(function() use($request, $id) {
                return $this->findOrFail($id)->fill($request->validated())->save();
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }
    }

    //全受給者情報をCSV形式で取得
    public function downloadCsv()
    {
        $recipients = $this->all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv"
        ];

        $callback = function() use($recipients) {
            $handle = fopen('php://output', 'w');
            
            $columns = [
                'id',
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

            mb_convert_variables('SJIS-win', 'UTF-8', $columns);

            fputcsv($handle, $columns);

            foreach($recipients as $recipient) {
                $csv = [
                    $recipient->id,
                    $recipient->number,
                    $recipient->name,
                    $recipient->kana,
                    $recipient->sex,
                    $recipient->birth_date,
                    $recipient->adress,
                    $recipient->allowance_type,
                    $recipient->is_submitted,
                    $recipient->additional_document,
                    $recipient->is_public_pentioner,
                    $recipient->multiple_recipient,
                    $recipient->note
                ];

                mb_convert_variables('SJIS-win', 'UTF-8', $csv);

                fputcsv($handle, $csv);
            }
        };

        return response()->stream($callback, 200, $headers);
    }

    //受給者情報をCSV形式でアップロード
    public function uploadCsv(Request $request)
    {
        //
    }
}
