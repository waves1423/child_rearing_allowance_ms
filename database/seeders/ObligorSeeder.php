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
                'name' => '島原　和男',
                'family_relationship' => '父'
            ],
            [
                'recipient_id' => 3,
                'name' => '三野瀬　光雄',
                'family_relationship' => '父'
            ],
            [
                'recipient_id' => 4,
                'name' => '長島　四江',
                'family_relationship' => '母'
            ],
            [
                'recipient_id' => 6,
                'name' => '長島　六郎',
                'family_relationship' => '父'
            ],

        ]);
    }
}
