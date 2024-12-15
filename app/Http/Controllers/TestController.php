<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestPostRequest;
use App\Models\Test;
use App\Services\TestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tests = Test::with(['group', 'subject'])->paginate(15);

        return view('tests.index', [
            'tests' => $tests,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestPostRequest $request, TestService $service)
    {
        $test = $service->create($request->validated());

        return redirect()->route('tests.scores.index', [
            'test' => $test,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        return view('tests-scores.index', [
            'test' => $test,
        ]);
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
    public function update(TestPostRequest $request, Test $test)
    {
        $test->update($request->validated());

        return redirect()->route('tests.show', []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        $test->delete();

        return redirect()->route('tests.index');
    }

    public function selfTests()
    {
        $student = Auth::user()->userable->load('group.tests');

        $tests = $student->group->tests->groupBy('semester');

        return view('tests.self-tests', [
            'test' => $tests,
        ]);
    }
}
