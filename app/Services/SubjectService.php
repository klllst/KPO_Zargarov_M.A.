<?php

namespace App\Services;

use App\Models\Subject;
use Pest\Subscribers\EnsureKernelDumpIsFlushed;

class SubjectService
{
    public function create(array $data)
    {
        return Subject::create($data);
    }

    public function update(Subject $subject, array $data)
    {
        $subject->update($data);

        return $subject;
    }

    public function delete(Subject $subject)
    {
        $subject->delete();
    }
}
