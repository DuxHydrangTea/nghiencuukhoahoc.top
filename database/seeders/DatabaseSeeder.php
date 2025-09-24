<?php

namespace Database\Seeders;

use App\Models\ClassSubject;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        // User::create([
        //     'email' => 'admin@gmail.com',
        //     'name' => 'admin',
        //     'password' => 'password',
        // ]);
        $this->call([
            // ClassModelSeeder::class,
            // SubjectSeeder::class,
            ClassSubjectSeeder::class,
            VolumeSeeder::class,
            // ChapterSeeder::class,
        ]);
    }
}
