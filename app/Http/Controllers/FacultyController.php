<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacultyPostRequest;
use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = Faculty::paginate(15);

        return view('faculties.index', [
            'faculties' => $faculties,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('faculties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FacultyPostRequest $request)
    {
        Faculty::create($request->validated());

        return redirect()->route('faculties.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faculty $faculty)
    {
        return view('faculties.edit', [
            'faculty' => $faculty,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FacultyPostRequest $request, Faculty $faculty)
    {
        $faculty->update($request->validated());

        return redirect()->route('faculties.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty)
    {
        $faculty->delete();

        return redirect()->route('faculties.index');
    }
}
