<?php

namespace App\Enums;

enum ScoreEnum: string
{
    case WinthoutScore = 'Отсутствует';
    case Absence = 'Неявка';
    case Bad = 'Неудовлетворительно';
    case Satisfactorily = 'Удовлетворительно';
    case Good = 'Хорошо';
    case Great = 'Отлично';
    case Pass = 'Зачтено';
    case Fail = 'Fail';

    public function getTestTypeScores(TestType $testType): array
    {
        return match ($testType) {
            TestType::Exam, TestType::CourseWork, TestType::DifTest => [
                self::WinthoutScore,
                self::Absence,
                self::Bad,
                self::Satisfactorily,
                self::Good,
                self::Great,
            ],

            TestType::Test => [
                self::WinthoutScore,
                self::Absence,
                self::Fail,
                self::Pass,
            ],
        };
    }
}
