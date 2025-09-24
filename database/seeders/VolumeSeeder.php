<?php

namespace Database\Seeders;

use App\Models\ClassSubject;
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
        ClassSubject::all()->each(function ($sb){
            Volume::create([
                'class_subject_id' => $sb->id,
                'title' => 'Chương 1',
                'description' => $sb->subject->title . ' ' . $sb->class->title . ' cơ bản',
                'thumbnail' => asset('assets/imgs/no-image.gif'),
                'icon' => "",
                'color' => 'blue',
                'tags' => [],
            ]);

            Volume::create([
                'class_subject_id' => $sb->id,
                'title' => 'Chương 2',
                'description' => $sb->subject->title . ' ' . $sb->class->title . ' nâng cao',
                'thumbnail' => asset('assets/imgs/no-image.gif'),
                'icon' => "",
                'color' => 'green',
                'tags' => [],
            ]);
        });
    }
}
