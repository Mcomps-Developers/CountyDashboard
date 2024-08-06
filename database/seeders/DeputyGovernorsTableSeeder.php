<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeputyGovernorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deputy_governors')->insert([
            [
                'name' => 'Jane Doe',
                'date_of_birth' => '1980-01-01',
                'office_phone' => '123-456-7890',
                'office_email' => 'jane.doe@example.com',
                'facebook' => 'https://facebook.com/janedoe',
                'linkedin' => 'https://linkedin.com/in/janedoe',
                'twitter' => 'https://twitter.com/janedoe',
                'instagram' => 'https://instagram.com/janedoe',
                'welcome_message' => 'Welcome to our county. I am here to serve you!',
                'about' => 'Jane Doe is dedicated to improving the community and working towards sustainable development.',
                'photo' => 'path/to/photo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
