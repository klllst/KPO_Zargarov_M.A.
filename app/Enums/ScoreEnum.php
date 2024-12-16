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
    case Fail = 'Не зачтено';

    public static function getTestTypeScores(string $testType): array
    {
        return match ($testType) {
            TestType::Exam->value, TestType::CourseWork->value, TestType::DifTest->value => [
                self::WinthoutScore,
                self::Absence,
                self::Bad,
                self::Satisfactorily,
                self::Good,
                self::Great,
            ],

            TestType::Test->value => [
                self::WinthoutScore,
                self::Absence,
                self::Fail,
                self::Pass,
            ],
        };
    }

    public static function getRandomScore(string $testType)
    {
        $scores = self::getTestTypeScores($testType);

        return $scores[array_rand($scores)];
    }
}
