<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalculationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calculations')->insert([
            [
                'id' => 1,
                'recipient_id' => 1,
                'spouse_id' => null,
                'obligor_id' => null,
                'deducted_income' => 100000
            ],
            [
                'id' => 2,
                'recipient_id' => 2,
                'spouse_id' => null,
                'obligor_id' => null,
                'deducted_income' => 0
            ],
            [
                'id' => 3,
                'recipient_id' => 3,
                'spouse_id' => null,
                'obligor_id' => null,
                'deducted_income' => 1230000
            ],
            [
                'id' => 4,
                'recipient_id' => 4,
                'spouse_id' => null,
                'obligor_id' => null,
                'deducted_income' => 432000
            ],
            [
                'id' => 5,
                'recipient_id' => 5,
                'spouse_id' => null,
                'obligor_id' => null,
                'deducted_income' => 3400000
            ],
            [
                'id' => 6,
                'recipient_id' => 6,
                'spouse_id' => null,
                'obligor_id' => null,
                'deducted_income' => 0
            ],
            [
                'id' => 7,
                'recipient_id' => null,
                'spouse_id' => 1,
                'obligor_id' => null,
                'deducted_income' => 1000000 
            ],
            [
                'id' => 8,
                'recipient_id' => null,
                'spouse_id' => null,
                'obligor_id' => 1,
                'deducted_income' => 1100000 
            ],
            [
                'id' => 9,
                'recipient_id' => null,
                'spouse_id' => null,
                'obligor_id' => 2,
                'deducted_income' => 1200000 
            ],
        ]);
    }
}
