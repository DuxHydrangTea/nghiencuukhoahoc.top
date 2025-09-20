<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        User::create([
            'email' => 'admin@gmail.com',
            'name' => 'admin',
            'password' => 'password',
        ]);
        // $this->call([
        //     ClassModelSeeder::class,
        //     SubjectSeeder::class,
        //     VolumeSeeder::class,
        //     ChapterSeeder::class,
        // ]);
    }
}
