<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('governors')->insert([
            [
                'name' => 'John Doe',
                'main_manifesto' => 'To improve education and healthcare.',
                'date_of_birth' => '1975-05-15',
                'office_phone' => '555-123-4567',
                'office_email' => 'john.doe@example.com',
                'facebook' => 'https://facebook.com/johndoe',
                'linkedin' => 'https://linkedin.com/in/johndoe',
                'twitter' => 'https://twitter.com/johndoe',
                'instagram' => 'https://instagram.com/johndoe',
                'welcome_message' => 'Welcome! I am dedicated to making positive changes in our community.',
                'about' => 'John Doe has been working in public service for over 20 years, focusing on community development and public welfare.',
                'photo' => 'path/to/photo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
