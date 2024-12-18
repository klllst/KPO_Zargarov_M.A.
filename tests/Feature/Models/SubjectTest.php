<?php

use App\Models\Subject;
use App\Services\SubjectService;

it('creates a user', function () {
    $service = app(SubjectService::class);

    $data = [
        'name' => 'TestSubject',
    ];

    $service->create($data);

    $this->assertDatabaseHas('subjects', [
        'name' => $data['name'],
    ]);
});


it('updates a subject', function () {
    $service = app(SubjectService::class);

    $subject = Subject::factory()->create();

    $name = 'TestUpdateSubject' . ++$subject->id;

    $data = [
        'name' =>  $name,
    ];

    $service->update($subject, $data);

    $this->assertDatabaseHas('subjects', [
        'name' => $name,
    ]);
});

it('deletes a subject', function () {
    $service = app(SubjectService::class);

    $subject = Subject::factory()->create();

    $service->delete($subject);

    $this->assertDatabaseMissing('subjects', [
        'id' => $subject->id,
    ]);
});
