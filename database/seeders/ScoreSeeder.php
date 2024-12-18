<?php

namespace Database\Seeders;

use App\Enums\ScoreEnum;
use App\Models\Teacher;
use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
