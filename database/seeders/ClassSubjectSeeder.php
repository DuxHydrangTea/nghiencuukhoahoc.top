<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Subject;
class ClassSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $icons = [
            '🌟',
            '🚀',
            '🎨',
            '🏆',
            '🎯',
            '🔬',
            '📐',
            '🌍',
        ];
        $colors = [
            'blue',
            'green',
            'purple',
            'orange',
            'red',
            'cyan',
            'pink',
            'indigo',
        ];

        foreach(ClassModel::all() as $class){
            foreach(Subject::limit(8)->get() as $sIndex => $subject){
                ClassSubject::create([
                    'class_id' => $class->id,
                    'subject_id' => $subject->id,
                    'description' => $subject->title . ' ' . $class->title,
                    'thumbnail' => asset('assets/imgs/no-image.gif'),
                    'icon' => $icons[$sIndex],
                    'color' => $colors[$sIndex],
                    'tags' => [],
                ]);
            }
        }
    }
}
