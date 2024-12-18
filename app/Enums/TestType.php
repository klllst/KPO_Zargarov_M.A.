<?php

namespace App\Enums;

enum TestType: string
{
    case Exam = 'Экзамен';
    case Test = 'Зачёт';
    case CourseWork = 'Курсовая работа';
    case DifTest = 'Дифференцированный зачет';

    public static function getRandomType()
    {
        return self::cases()[array_rand(self::cases())];
    }
}
