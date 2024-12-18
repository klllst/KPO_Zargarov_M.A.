<?php

use App\Models\Faculty;
use App\Models\Group;
use App\Services\GroupService;

it('creates a group', function () {
    $service = app(GroupService::class);

    $faculty = Faculty::factory()->create();

    $data = [
        'name' => 'TestGroup',
        'course' => 1,
        'number' => 1,
        'faculty_id' => $faculty->id,
    ];

    $service->create($data);

    $this->assertDatabaseHas('groups', [
        'name' => $data['name'],
    ]);
});


it('updates a group', function () {
    $service = app(GroupService::class);

    $group = Group::factory()->create();

    $data = [
        'name' =>  'TestUpdateGroup' . ++$group->id,
    ];

    $service->update($group, $data);

    $this->assertDatabaseHas('groups', [
        'name' => $data['name'],
    ]);
});

it('deletes a group', function () {
    $service = app(GroupService::class);

    $group = Group::factory()->create();

    $service->delete($group);

    $this->assertDatabaseMissing('groups', [
        'id' => $group->id,
    ]);
});
