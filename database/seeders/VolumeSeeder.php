<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Volume;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VolumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subject::all()->each(function ($sb){
            Volume::create([
                'subject_id' => $sb->id,
                'title' => 'Chương 1',
                'description' => $sb->title . ' cơ bản',
                'thumbnail' => asset('assets/imgs/no-image.gif'),
                'icon' => "",
                'color' => 'blue',
                'tags' => [],
            ]);

            Volume::create([
                'subject_id' => $sb->id,
                'title' => 'Chương 2',
                'description' => $sb->title . ' nâng cao',
                'thumbnail' => asset('assets/imgs/no-image.gif'),
                'icon' => "",
                'color' => 'green',
                'tags' => [],
            ]);
        });
    }
}
