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
                'recipient_id' => 1,
                'deducted_income' => 100000
            ],
            [
                'recipient_id' => 2,
                'deducted_income' => 0
            ],
            [
                'recipient_id' => 3,
                'deducted_income' => 1230000
            ],
            [
                'recipient_id' => 4,
                'deducted_income' => 432000
            ],
            [
                'recipient_id' => 5,
                'deducted_income' => 3400000
            ],
            [
                'recipient_id' => 6,
                'deducted_income' => 0
            ],
        ]);
    }
}
