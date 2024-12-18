<?php

namespace App\Services;

use App\Enums\UserType;
use App\Mail\UserPasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserService
{
    public function create(array $data): User
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $morphUser = UserType::tryFrom($data['type'])->getType();

        unset($data['type']);

        $morphUser->fill($data)->save();

        $morphUser->user()->save($user);

        Mail::to($data['email'])->send(new UserPasswordMail($data['password']));

        return $user;
    }

    public function update(User $user, array $data): User
    {
        $updateData = [
            'email' => $data['email'],
        ];

        if ($data['password']) {
            $updateData['password'] = $data['password'];
        }

        $user->update($updateData);

        unset($data['type']);

        $user->userable->update($data);

        return $user;
    }

    public function delete(User $user)
    {
        $user->userable?->delete();
        $user->delete();
    }
}
