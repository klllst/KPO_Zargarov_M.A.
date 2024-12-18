<?php

use App\Models\Faculty;
use App\Services\FacultyService;

it('creates a faculty', function () {
    $service = app(FacultyService::class);

    $facultyId = Faculty::latest()->first()->id;

    $data = [
        'name' => 'TestFaculty' . ($facultyId ?? 1),
    ];

    $service->create($data);

    $this->assertDatabaseHas('faculties', [
        'name' => $data['name'],
    ]);
});


it('updates a faculty', function () {
    $service = app(FacultyService::class);

    $faculty = Faculty::factory()->create();

    $name = 'TestUpdateFaculty' . ++$faculty->id;

    $data = [
        'name' =>  $name,
    ];

    $service->update($faculty, $data);

    $this->assertDatabaseHas('faculties', [
        'name' => $name,
    ]);
});

it('deletes a faculty', function () {
    $service = app(FacultyService::class);

    $faculty = Faculty::factory()->create();

    $service->delete($faculty);

    $this->assertDatabaseMissing('faculties', [
        'id' => $faculty->id,
    ]);
});
