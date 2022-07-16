<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObligorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obligors')->insert([
            [
                'recipient_id' => 1,
                'name' => '紀北　一男',
                'family_relationship' => '父'
            ],
            [
                'recipient_id' => 3,
                'name' => '紀北　三男',
                'family_relationship' => '父'
            ],
            [
                'recipient_id' => 4,
                'name' => '紀北　四男',
                'family_relationship' => '父'
            ],
            [
                'recipient_id' => 5,
                'name' => '紀北　五男',
                'family_relationship' => '父'
            ],

        ]);
    }
}
