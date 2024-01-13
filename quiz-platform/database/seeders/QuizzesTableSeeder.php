<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizzesTableSeeder extends Seeder
{
    public function run()
    {
        Quiz::create([
            'title' => 'Sample Quiz',
            'description' => 'This is a sample quiz.',
            'author_id' => 1, // Replace with the correct user ID
        ]);
    }
}
