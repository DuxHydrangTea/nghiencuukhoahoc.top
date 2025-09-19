<?php

namespace App;

enum RoleEnum: int
{
    case NORMAL = 0;
    case STUDENT = 1;
    case TEACHER = 2;

    public function getLabel(){
        return match ($this){
            self::NORMAL => 'Người dùng vãng lai',
            self::STUDENT => 'Học sinh',
            self::TEACHER => 'Giáo viên',
            default => 'Người dùng vãng lai',
        };
    }
}
