<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublicServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('public_services')->insert([
            [
                'content' => 'Coming Soon!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
