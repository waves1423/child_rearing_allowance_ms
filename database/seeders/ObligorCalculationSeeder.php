<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObligorCalculationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obligor_calculations')->insert([
            [
                'obligor_id' => 1,
                'calculation_id' => 7
            ],
            [
                'obligor_id' => 2,
                'calculation_id' => 10
            ],
            [
                'obligor_id' => 3,
                'calculation_id' => 11
            ],
            [
                'obligor_id' => 4,
                'calculation_id' => 12
            ],
        ]);
    }
}
