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
                'number' => 24543001,
                'name' => '児扶　一子',
                'kana' => 'じふ　かずこ',
                'sex' => 2,
                'birth_date' => '1990/09/01',
                'adress' => '児童市扶養町4001番地',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '養育費申告書、一部適用除外届',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543002,
                'name' => '児扶　二子',
                'kana' => 'じふ　にこ',
                'sex' => 2,
                'birth_date' => '1982/09/01',
                'adress' => '児童市扶養町4002番地',
                'allowance_type' => 2,
                'is_submitted' => true,
                'additional_document' => '養育費申告書、一部適用除外届',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543003,
                'name' => '児扶　三子',
                'kana' => 'じふ　みつこ',
                'sex' => 2,
                'birth_date' => '1987/03/03',
                'adress' => '児童市扶養町4001番地2',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '養育費申告書',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543004,
                'name' => '児扶　四郎',
                'kana' => 'じふ　しろう',
                'sex' => 1,
                'birth_date' => '1989/04/14',
                'adress' => '児童市扶養町4004番地',
                'allowance_type' => 2,
                'is_submitted' => true,
                'additional_document' => '養育費申告書、一部適用除外届',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543005,
                'name' => '児扶　五子',
                'kana' => 'じふ　いつこ',
                'sex' => 2,
                'birth_date' => '1995/05/25',
                'adress' => '児童市扶養町4005番地5',
                'allowance_type' => 3,
                'is_submitted' => false,
                'additional_document' => '養育費申告書',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543006,
                'name' => '児扶　六子',
                'kana' => 'じふ　ろこ',
                'sex' => 2,
                'birth_date' => '1990/06/01',
                'adress' => '児童市扶養町4006番地',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '養育費申告書、父に関する申立書',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => '24543007/34545001',
                'name' => '児扶　七子',
                'kana' => 'じふ　ななこ',
                'sex' => 2,
                'birth_date' => '1987/07/07',
                'adress' => '児童市扶養町4007番地7',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '養育費申告書、身体障害者手帳',
                'is_public_pentioner' => false,
                'multiple_recipient' => 3,
                'note' => ''
            ],
            [
                'number' => 24543008,
                'name' => '児扶　八子',
                'kana' => 'じふ　やこ',
                'sex' => 2,
                'birth_date' => '1988/09/08',
                'adress' => '児童市扶養町4001番地88',
                'allowance_type' => 1,
                'is_submitted' => false,
                'additional_document' => '養育費申告書、一部適用除外届、年金証書',
                'is_public_pentioner' => true,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543009,
                'name' => '児扶　九子',
                'kana' => 'じふ　ここ',
                'sex' => 2,
                'birth_date' => '1993/09/09',
                'adress' => '児童市扶養町4109番地9',
                'allowance_type' => 2,
                'is_submitted' => false,
                'additional_document' => '養育費申告書、年金証書',
                'is_public_pentioner' => true,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 34545002,
                'name' => '児扶　十郎',
                'kana' => 'じふ　じゅうろう',
                'sex' => 1,
                'birth_date' => '1982/10/19',
                'adress' => '児童市扶養町4110番地',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '療育手帳',
                'is_public_pentioner' => false,
                'multiple_recipient' => 2,
                'note' => ''
            ],
            [
                'number' => 24543009,
                'name' => '児扶　十一子',
                'kana' => 'じふ　といこ',
                'sex' => 2,
                'birth_date' => '1981/11/09',
                'adress' => '児童市扶養町4109番地9',
                'allowance_type' => 2,
                'is_submitted' => false,
                'additional_document' => '養育費申告書、一部適用除外届',
                'is_public_pentioner' => true,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543001,
                'name' => '児扶　十二子',
                'kana' => 'じふ　とにこ',
                'sex' => 2,
                'birth_date' => '1990/09/01',
                'adress' => '児童市扶養町4001番地',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '養育費申告書、一部適用除外届',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543001,
                'name' => '児扶　十三',
                'kana' => 'じふ　じゅうぞう',
                'sex' => 1,
                'birth_date' => '1990/09/01',
                'adress' => '児童市扶養町4001番地',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '養育費申告書、一部適用除外届',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543001,
                'name' => '児扶　十四郎',
                'kana' => 'じふ　じゅうしろう',
                'sex' => 1,
                'birth_date' => '1990/09/01',
                'adress' => '児童市扶養町4001番地',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '養育費申告書、一部適用除外届',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543001,
                'name' => '児扶　十五代',
                'kana' => 'じふ　とこよ',
                'sex' => 2,
                'birth_date' => '1990/09/01',
                'adress' => '児童市扶養町4001番地',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '一部適用除外届、監護養育申立書',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],

        ]);
    }
}
