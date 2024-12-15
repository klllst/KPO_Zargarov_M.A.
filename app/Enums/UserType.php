<?php

namespace App\Enums;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;

enum UserType: string
{
    case Administrator = 'Администратор';
    case Teacher = 'Преподаватель';
    case Student = 'Студент';

    public function getType(): Model
    {
        return match ($this) {
            self::Administrator => new Admin(),
            self::Teacher => new Teacher(),
            self::Student => new Student(),
        };
    }

    public static function getCreateTypes(): array
    {
        return [self::Teacher, self::Student];
    }
}
