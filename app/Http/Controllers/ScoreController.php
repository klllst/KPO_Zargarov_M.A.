<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScorePostRequest;
use App\Models\Score;
use App\Models\Test;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Test $test)
    {
        return view('test-scores.index', [
            'test' => $test,
            'scores' => $test->scores()->with(['students', 'teacher'])->get(),
        ]);
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
    public function store(ScorePostRequest $request)
    {
        return redirect()->route('scores.show');
    }

    /**
     * Display the specified resource.
     */
    public function show(Score $score)
    {
        return view();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Score $score)
    {
        return view();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScorePostRequest $request, Score $score)
    {
        return redirect()->route('scores.show', []);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Score $score)
    {
        return redirect()->route('scores.index');
    }

    public function selfScores()
    {
        $student = Auth::user()->userable->load(['scores', 'group.tests']);

        $scores = $student->scores->map(function ($score) {
            return collect(['score' => $score, 'test' => $score->test]);
        })->groupBy('test.semester');

        return view('scores.self-scores', [
            'scores' => $scores,
        ]);
    }
}
