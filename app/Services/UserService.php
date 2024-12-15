<?php

namespace App\Services;

use App\Enums\UserType;
use App\Models\User;

class UserService
{
    public function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $morphUser = UserType::tryFrom($data['type'])->getType();

        unset($data['type']);

        info('data', [$data]);

        $morphUser->fill($data)->save();

        $morphUser->user()->save($user);
    }

    public function update(User $user, array $data)
    {

        $user->update([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $morphUser = UserType::tryFrom($data['type'])->getType();

        unset($data['type']);

        info('data', [$data]);

        $morphUser->fill($data)->save();
    }
}
