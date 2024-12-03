<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupPostRequest;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
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
    public function store(GroupPostRequest $request)
    {
        return redirect()->route('groups.show');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        return view();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        return view();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupPostRequest $request, Group $group)
    {
        return redirect()->route('groups.show', []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        return redirect()->route('groups.index');
    }
}
