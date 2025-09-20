<?php

namespace App\Enums;

enum RoleEnum: int
{
    case NORMAL = 0;
    case STUDENT = 1;
    case TEACHER = 2;

    public static function asArray(){
        return [
            self::NORMAL->value => 'Người dùng vãng lai',
            self::STUDENT->value => 'Học sinh',
            self::TEACHER->value => 'Giáo viên',
        ];
    }

    public static function getLabel(int $value): string
    {
        return self::asArray()[$value] ?? 'Unknown';
    }
}
