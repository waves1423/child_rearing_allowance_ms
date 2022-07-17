<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipientCalculationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipient_calculations')->insert([
            [
                'recipient_id' => 1,
                'calculation_id' => 1
            ],
            [
                'recipient_id' => 2,
                'calculation_id' => 2
            ],
            [
                'recipient_id' => 3,
                'calculation_id' => 3
            ],
            [
                'recipient_id' => 4,
                'calculation_id' => 4
            ],
            [
                'recipient_id' => 5,
                'calculation_id' => 5
            ],
            [
                'recipient_id' => 6,
                'calculation_id' => 6
            ],
        ]);
    }
}
