<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

        $icons = [
            '🔢',
            '📝',
            '🌍',
            '🔬',
            '🏛️',
            '🗺️',
            '🎵',
            '🎨',
        ];

        $names = [
            'Toán học',
            'Tiếng Việt',
            'Tiếng Anh',
            'Khoa học',
            'Lịch sử',
            'Địa lý',
            'Âm nhạc',
            'Mỹ thuật',
        ];

        $des = [
            'Học toán vui vẻ với phép tính cơ bản',
            'Rèn luyện kỹ năng đọc viết tiếng Việt',
            'Học tiếng Anh qua trò chơi và bài hát',
            'Khám phá thế giới xung quanh',
            'Tìm hiểu lịch sử dân tộc',
            'Khám phá bản đồ Việt Nam',
            'Học hát và chơi nhạc cụ',
            'Vẽ tranh và làm đồ thủ công',
        ];

        for($i = 0; $i <8; $i ++){
            for($cl = 1; $cl <= 8; $cl ++){
                Subject::create([
                    'class_id' => $cl,
                    'title' => $names[$i],
                    'description' => $des[$i],
                    'thumbnail' => asset('assets/imgs/no-image.gif'),
                    'icon' => $icons[$i],
                    'color' => $colors[$i],
                    'tags' => [],
                ]);
            }
        }
    }
}
