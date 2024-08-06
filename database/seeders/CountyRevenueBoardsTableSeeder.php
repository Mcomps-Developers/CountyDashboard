<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountyRevenueBoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('county_revenue_boards')->insert([
            [
                'content' => 'Coming soon!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
