<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        return view();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        return redirect()->route('users.show', []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return redirect()->route('users.index');
    }
}
