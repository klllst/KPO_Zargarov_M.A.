<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
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
        return redirect()->route('tests.show');
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        return view();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        return view();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        return redirect()->route('tests.show', []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        return redirect()->route('tests.index');
    }
}
