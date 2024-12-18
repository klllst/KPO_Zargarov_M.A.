<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectPostRequest;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::paginate(15);

        return view('subjects.index', [
            'subjects' => $subjects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectPostRequest $request)
    {
        Subject::create($request->validated());

        return redirect()->route('subjects.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        return view('subjects.edit', [
            'subject' => $subject,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectPostRequest $request, Subject $subject)
    {
        $subject->update($request->validated());

        return redirect()->route('subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index');
    }
}
