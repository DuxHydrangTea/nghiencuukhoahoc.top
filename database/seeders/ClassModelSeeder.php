<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class ClassModelSeeder extends Seeder
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

        for($i = 1; $i<=8; $i++){
            ClassModel::create([
                'title' => 'Lớp ' . $i,
                'description' => 'Chào mừng các em học sinh lớp ' . $i .'! Hãy cùng khám phá những môn học thú vị và bổ ích nhé!',
                'thumbnail' => asset('assets/imgs/no-image.gif'),
                'icon' => $icons[$i - 1],
                'slogan' => 'Lớp '. $i .' - Khám phá thế giới!',
                'tags' => [],
                'color' => $colors[$i - 1],
            ]);
        }
    }
}
