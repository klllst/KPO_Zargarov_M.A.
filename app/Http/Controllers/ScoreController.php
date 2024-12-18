<?php

namespace App\Http\Controllers;

use App\Enums\ScoreEnum;
use App\Http\Requests\ScorePostRequest;
use App\Models\Score;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Test $test)
    {
        return view('tests-scores.index', [
            'test' => $test,
            'scores' => $test->scores()->with(['student', 'teacher'])->get(),
            'marks' => ScoreEnum::getTestTypeScores($test->type)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test, Score $score)
    {
        $score->update([
            'mark' => $request->mark,
        ]);

        return redirect()->route('tests.scores.index', [$test]);
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
