<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipients')->insert([
            [
                'number' => 100,
                'name' => '紀北　一子',
                'kana' => 'きほく　かずこ',
                'sex' => 2,
                'birth_date' => '1990/09/01',
                'adress' => '紀北町東長島4001番地',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '一部適用除外申請書',
                'is_public_pentioner' => false,
                'note' => '特記事項を記入します。'
            ],
            [
                'number' => 101,
                'name' => '紀北　二子',
                'kana' => 'きほく　にこ',
                'sex' => 2,
                'birth_date' => '1990/09/02',
                'adress' => '紀北町東長島4001番地12',
                'allowance_type' => 2,
                'is_submitted' => false,
                'additional_document' => '',
                'is_public_pentioner' => false,
                'note' => '特記事項を記入します。'
            ],
            [
                'number' => 102,
                'name' => '紀北　三子',
                'kana' => 'きほく　みつこ',
                'sex' => 2,
                'birth_date' => '1990/09/07',
                'adress' => '紀北町東長島4004番地',
                'allowance_type' => 2,
                'is_submitted' => false,
                'additional_document' => '',
                'is_public_pentioner' => false,
                'note' => '特記事項を記入します。'
            ],
            [
                'number' => 103,
                'name' => '紀北　四子',
                'kana' => 'きほく　しこ',
                'sex' => 2,
                'birth_date' => '1980/09/01',
                'adress' => '紀北町東長島4009番地',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '',
                'is_public_pentioner' => true,
                'note' => '特記事項を記入します。'
            ],
            [
                'number' => 104,
                'name' => '紀北　五子',
                'kana' => 'きほく　いつこ',
                'sex' => 2,
                'birth_date' => '1991/09/01',
                'adress' => '紀北町東長島4012番地',
                'allowance_type' => 3,
                'is_submitted' => true,
                'additional_document' => '',
                'is_public_pentioner' => false,
                'note' => '特記事項を記入します。'
            ],
            [
                'number' => 105,
                'name' => '紀北　六郎',
                'kana' => 'きほく　ろくろう',
                'sex' => 1,
                'birth_date' => '1990/09/01',
                'adress' => '紀北町東長島5001番地',
                'allowance_type' => 2,
                'is_submitted' => false,
                'additional_document' => '一部適用除外申請書',
                'is_public_pentioner' => false,
                'note' => '特記事項を記入します。'
            ],

        ]);
    }
}
