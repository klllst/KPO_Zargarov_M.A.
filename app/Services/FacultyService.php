<?php

namespace App\Services;

use App\Models\Faculty;

class FacultyService
{
    public function create(array $data)
    {
        return Faculty::create($data);
    }

    public function update(Faculty $faculty, array $data)
    {
        $faculty->update($data);

        return $faculty;
    }

    public function delete(Faculty $faculty)
    {
        $faculty->delete();
    }
}
