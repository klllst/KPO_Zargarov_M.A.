<?php

use App\Models\Teacher;
use App\Models\User;
use App\Services\UserService;

it('creates a user', function () {
    $service = app(UserService::class);

    $userId = User::latest()->first()->id ?? 0;

    $data = [
        'first_name' => "TestName",
        'last_name' => "TestLastName",
        'middle_name' => "TestMiddleName",
        'email' => 'test' . ++$userId . '@example.com',
        'password' => 'password',
        'birthday' => "2004-11-18",
        'type' => 'Преподаватель',
    ];

    $user = $service->create($data);

    $this->assertDatabaseHas('users', [
        'email' => $data['email'],
    ]);

    $this->assertDatabaseHas($user->userable->getTable(), [
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
    ]);
});


it('updates a user', function () {
    $service = app(UserService::class);

    $userId = User::latest()->first()->id ?? 0;

    $data = [
        'first_name' => "TestName",
        'last_name' => "TestLastName",
        'middle_name' => "TestMiddleName",
        'email' => 'test' . ++$userId . '@example.com',
        'password' => 'password',
        'birthday' => "2004-11-18",
        'type' => 'Преподаватель',
    ];

    $user = $service->create($data);

    $updateEmail = 'update-test' . $user->id . '@example.com';

    $updateFirstName = 'TestNameUpdate';

    $updateData = [
        'first_name' => $updateFirstName,
        'last_name' => "TestLastName",
        'middle_name' => "TestMiddleName",
        'email' => $updateEmail,
        'password' => 'password',
        'birthday' => "2004-11-18",
        'type' => 'Преподаватель',
    ];

    $service->update($user, $updateData);

    $this->assertDatabaseHas('users', [
        'email' => $updateEmail,
    ]);
});

it('deletes a user', function () {
    $service = app(UserService::class);

    $user = User::factory()->create();
    $teacher = Teacher::factory()->create();

    $teacher->user()->save($user);

    $service->delete($user);

    $this->assertDatabaseMissing('users', [
        'id' => $user->id,
    ]);

    $this->assertDatabaseMissing('teachers', [
        'id' => $teacher->id,
    ]);
});

