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
                'name' => '島原　一子',
                'kana' => 'しまばら　かずこ',
                'sex' => 2,
                'birth_date' => '1990/09/01',
                'adress' => '児童市4001番地1',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '養育費申告書、一部適用除外届',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543002,
                'name' => '相賀　二子',
                'kana' => 'あいが　にこ',
                'sex' => 2,
                'birth_date' => '1982/09/01',
                'adress' => '児童市002番地',
                'allowance_type' => 2,
                'is_submitted' => true,
                'additional_document' => '養育費申告書、一部適用除外届',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543003,
                'name' => '三野瀬　三子',
                'kana' => 'みのせ　みつこ',
                'sex' => 2,
                'birth_date' => '1987/03/03',
                'adress' => '児童市4001番地2',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '養育費申告書',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543004,
                'name' => '長島　四郎',
                'kana' => 'ながしま　しろう',
                'sex' => 1,
                'birth_date' => '1989/04/14',
                'adress' => '児童市4004番地',
                'allowance_type' => 2,
                'is_submitted' => true,
                'additional_document' => '養育費申告書、一部適用除外届',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543005,
                'name' => '船津　五子',
                'kana' => 'ふなつ　いつこ',
                'sex' => 2,
                'birth_date' => '1995/05/25',
                'adress' => '児童市4005番地5',
                'allowance_type' => 3,
                'is_submitted' => false,
                'additional_document' => '養育費申告書',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543006,
                'name' => '長島　六子',
                'kana' => 'ながしま　ろこ',
                'sex' => 2,
                'birth_date' => '1990/06/01',
                'adress' => '児童市4006番地',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '養育費申告書、父に関する申立書',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => '24543007/34545001',
                'name' => '三戸　七子',
                'kana' => 'さんど　ななこ',
                'sex' => 2,
                'birth_date' => '1987/07/07',
                'adress' => '児童市4007番地7',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '養育費申告書、身体障害者手帳',
                'is_public_pentioner' => false,
                'multiple_recipient' => 3,
                'note' => ''
            ],
            [
                'number' => 24543008,
                'name' => '上里　八子',
                'kana' => 'かみさと　やこ',
                'sex' => 2,
                'birth_date' => '1988/09/08',
                'adress' => '児童市4001番地88',
                'allowance_type' => 1,
                'is_submitted' => false,
                'additional_document' => '養育費申告書、一部適用除外届、年金証書',
                'is_public_pentioner' => true,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543009,
                'name' => '中里　九子',
                'kana' => 'なかざと　ここ',
                'sex' => 2,
                'birth_date' => '1993/09/09',
                'adress' => '児童市4109番地9',
                'allowance_type' => 2,
                'is_submitted' => false,
                'additional_document' => '養育費申告書、年金証書',
                'is_public_pentioner' => true,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 34545002,
                'name' => '十須　十郎',
                'kana' => 'じゅうす　じゅうろう',
                'sex' => 1,
                'birth_date' => '1982/10/19',
                'adress' => '児童市4110番地',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '療育手帳',
                'is_public_pentioner' => false,
                'multiple_recipient' => 2,
                'note' => ''
            ],
            [
                'number' => 24543009,
                'name' => '三浦　十一子',
                'kana' => 'みうら　といこ',
                'sex' => 2,
                'birth_date' => '1981/11/09',
                'adress' => '児童市4109番地9',
                'allowance_type' => 2,
                'is_submitted' => false,
                'additional_document' => '養育費申告書、一部適用除外届',
                'is_public_pentioner' => true,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543001,
                'name' => '大原　十二子',
                'kana' => 'おおはら　とにこ',
                'sex' => 2,
                'birth_date' => '1990/09/01',
                'adress' => '児童市4001番地',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '養育費申告書、一部適用除外届',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 34545003,
                'name' => '小山　十三',
                'kana' => 'おやま　じゅうぞう',
                'sex' => 1,
                'birth_date' => '1990/09/01',
                'adress' => '児童市4001番地',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '養育費申告書、一部適用除外届',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 34545004,
                'name' => '矢口　十四郎',
                'kana' => 'やぐち　じゅうしろう',
                'sex' => 1,
                'birth_date' => '1990/09/01',
                'adress' => '児童市4014番地6',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '養育費申告書、一部適用除外届',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543001,
                'name' => '海野　十五代',
                'kana' => 'かいの　とこよ',
                'sex' => 2,
                'birth_date' => '1967/05/15',
                'adress' => '児童市4001番地15',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '一部適用除外届、監護養育申立書',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 34545005,
                'name' => '引本　十六',
                'kana' => 'ひきもと　じゅうむ',
                'sex' => 1,
                'birth_date' => '1988/09/06',
                'adress' => '児童市1600番地',
                'allowance_type' => 1,
                'is_submitted' => true,
                'additional_document' => '養育費申立書',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543009,
                'name' => '東長島　十七子',
                'kana' => 'ひがしながしま　じゅうななこ',
                'sex' => 2,
                'birth_date' => '1977/07/09',
                'adress' => '児童市4107番地7',
                'allowance_type' => 2,
                'is_submitted' => false,
                'additional_document' => '養育費申告書、一部適用除外届',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 34545006,
                'name' => '便ノ山　十八',
                'kana' => 'びんのやま　とおや',
                'sex' => 1,
                'birth_date' => '1988/08/08',
                'adress' => '児童市4108番地18',
                'allowance_type' => 1,
                'is_submitted' => false,
                'additional_document' => '療育手帳',
                'is_public_pentioner' => false,
                'multiple_recipient' => 2,
                'note' => ''
            ],
            [
                'number' => 24543019,
                'name' => '中桐　十九',
                'kana' => 'なかぎり　じゅうく',
                'sex' => 1,
                'birth_date' => '1989/09/19',
                'adress' => '児童市4119番地19',
                'allowance_type' => 3,
                'is_submitted' => true,
                'additional_document' => '一部適用除外届',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543020,
                'name' => '古里　二十子',
                'kana' => 'ふるさと　はたこ',
                'sex' => 2,
                'birth_date' => '1980/07/20',
                'adress' => '児童市2107番地20',
                'allowance_type' => 2,
                'is_submitted' => false,
                'additional_document' => '養育費申告書、一部適用除外届、別居監護申立書、児童の住民票',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],
            [
                'number' => 24543021,
                'name' => '船津　二一子',
                'kana' => 'ふなつ　にいこ',
                'sex' => 2,
                'birth_date' => '1980/07/20',
                'adress' => '児童市2107番地20',
                'allowance_type' => 2,
                'is_submitted' => false,
                'additional_document' => '養育費申告書、一部適用除外',
                'is_public_pentioner' => false,
                'multiple_recipient' => 1,
                'note' => ''
            ],

        ]);
    }
}
