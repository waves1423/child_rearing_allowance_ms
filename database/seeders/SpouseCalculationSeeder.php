<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpouseCalculationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spouse_calculations')->insert([
            [
                'spouse_id' => 1,
                'calculation_id' => 8
            ],
            [
                'spouse_id' => 2,
                'calculation_id' => 9
            ],
        ]);
    }
}
