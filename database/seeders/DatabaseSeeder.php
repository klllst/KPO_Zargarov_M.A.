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
            for ($i = 1; $i <= 8; ++$i) {
                $students = Student::factory(15)->create([
                    'group_id' => $group->id,
                ]);
                foreach ($students as $student) {
                    $user = User::factory()->create();
                    $student->user()->save($user);
                }

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
    }
}
