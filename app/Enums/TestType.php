<?php

namespace App\Enums;

enum TestType: string
{
    case Exam = 'Экзамен';
    case Test = 'Зачёт';
    case CourseWork = 'Курсовая работа';
    case DifTest = 'Дифференцированный зачет';
}
