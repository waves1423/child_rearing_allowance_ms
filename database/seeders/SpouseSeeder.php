<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spouses')->insert([
            [
                'recipient_id' => 1,
                'name' => '紀北　一夫',
                'family_relationship' => '夫',
            ],
            [
                'recipient_id' => 5,
                'name' => '紀北　五夫',
                'family_relationship' => '夫',
            ],
        ]);
    }
}
