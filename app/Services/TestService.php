<?php

namespace App\Services;

use App\Enums\ScoreEnum;
use App\Models\Score;
use App\Models\Test;

class TestService
{
    public function create(array $data): Test
    {
        $test = Test::create($data);

        $students = $test->group->students;

        foreach ($students as $student) {
            $createData = [
                'student_id' => $student->id,
                'test_id' => $test->id,
                'mark' => ScoreEnum::WinthoutScore,
            ];

            $createData['teacher_id'] = $data['teacher_id'];

            Score::create($createData);
        }

        return $test;
    }
}
