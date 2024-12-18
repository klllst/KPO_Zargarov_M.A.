<?php

use App\Http\Controllers\FacultyController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('profile.edit');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class)->except('show');
    Route::resource('faculties', FacultyController::class)->except('show');
    Route::resource('subjects', SubjectController::class)->except('show');
    Route::resource('tests', TestController::class)->except('show');
    Route::resource('tests.scores', ScoreController::class)->only(['index', 'update']);
});

Route::middleware(['auth', 'admin-teacher'])->group(function () {
    Route::resource('groups', GroupController::class);
    Route::get('/groups/{group}/export', [GroupController::class, 'export'])->name('groups.export');
});

Route::middleware(['auth', 'student'])->group(function () {
    Route::prefix('tests')->group(function () {
        Route::get('self-tests', [TestController::class, 'selfTests'])->name('tests.self-tests');
    });

    Route::prefix('scores')->group(function () {
        Route::get('self-scores', [ScoreController::class, 'selfScores'])->name('scores.self-scores');
    });
});

require __DIR__.'/auth.php';
