<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Models\Group;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('userable')->paginate(15);

        return view('users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = Group::all();

        return view('users.create', [
            'groups' => $groups,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserPostRequest $request, UserService $service)
    {
        $service->create($request->validated());

        return redirect()->route('users.show');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $groups = Group::all();

        return view('users.edit', [
            'user' => $user,
            'groups' => $groups,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserPostRequest $request, User $user)
    {
        return redirect()->route('users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->userable->delete();
        $user->delete();

        return redirect()->route('users.index');
    }
}
