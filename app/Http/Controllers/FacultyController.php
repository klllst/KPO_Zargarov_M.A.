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
    public function store(FacultyPostRequest $request)
    {
        return redirect()->route('faculties.show');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty)
    {
        return view();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faculty $faculty)
    {
        return view();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FacultyPostRequest $request, Faculty $faculty)
    {
        return redirect()->route('faculties.show', []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty)
    {
        return redirect()->route('faculties.index');
    }
}
