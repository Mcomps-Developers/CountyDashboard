<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WelcomeNotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('welcome_notes')->insert([
            [
                'title' => 'Word from H.E The Governor',
                'message' => 'Welcome to our county. We are dedicated to making positive changes and serving our community with integrity and commitment.',
                'quoted_text' => 'Leadership is about making others better as a result of your presence and making sure that impact lasts in your absence.',
                'name' => 'H.E Name',
                'designation' => 'Governor',
                'photo' => 'path/to/photo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ]);
    }
}
