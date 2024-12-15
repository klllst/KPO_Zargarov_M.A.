<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupPostRequest;
use App\Models\Faculty;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::paginate(15);

        return view('groups.index', [
            'groups' => $groups,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('groups.create', [
            'faculties' => Faculty::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupPostRequest $request)
    {
        Group::create($request->validated());

        return redirect()->route('groups.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        return view('groups.edit', [
            'group' => $group,
            'faculties' => Faculty::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupPostRequest $request, Group $group)
    {
        $group->update($request->validated());

        return redirect()->route('groups.show', [
            'group' => $group
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('groups.index');
    }
}
