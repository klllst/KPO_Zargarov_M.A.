<?php

namespace Database\Seeders;

use App\Enums\ScoreEnum;
use App\Enums\TestType;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faculties = Faculty::factory(5)->create();

        $groups = [];

        foreach ($faculties as $faculty) {
            for ($i = 1; $i <= 4; ++$i) {
                $group = $faculty->groups()->create([
                    'name' => 'Группа',
                    'course' => $i,
                    'number' => 1,
                ]);
                $groups[] = $group;
            }
        }

        foreach ($groups as $group) {
            $students = Student::factory(20)->create([
                'group_id' => $group->id,
            ]);
            foreach ($students as $student) {
                $user = User::factory()->create();
                $student->user()->save($user);
            }
            for ($i = 1; $i <= 8; ++$i) {
                $subjects = Subject::factory(5)->create();
                foreach ($subjects as $subject) {
                    $subject->tests()->create([
                        'group_id' => $group->id,
                        'semester' => $i,
                        'type' => TestType::getRandomType()->value,
                    ]);
                }
            }
        }

        $tests = Test::where('semester', 1)->with('group.students')->get();

        foreach ($tests as $test) {
            $teacher = Teacher::factory()->create();

            $user = User::factory()->create();
            $teacher->user()->save($user);

            $students = $test->group->students;

            foreach ($students as $student) {
                $student->scores()->create([
                    'teacher_id' => $teacher->id,
                    'test_id' => $test->id,
                    'mark' => ScoreEnum::getRandomScore($test->type),
                ]);
            }
        }
    }
}
