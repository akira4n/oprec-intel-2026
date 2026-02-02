<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('landing', [
        'deadline' => config('app.oprec_deadline'),
    ]);
})->middleware('throttle:40,1')->name('landing');

Route::middleware(['auth', 'verified', 'throttle:40,1'])->group(function () {
    Route::get('/dashboard', [ApplicantController::class, 'index'])->name('dashboard');
    Route::post('/applicant/store', [ApplicantController::class, 'store'])->name('applicant.store');
    Route::post('/applicant/store-tasks', [ApplicantController::class, 'storeTasks'])->name('applicant.store_tasks');
});

Route::middleware(['auth', 'throttle:40,1'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(PengumumanController::class)->middleware('throttle:40,1')->group(function () {
    Route::get('/announcement', 'index')->name('pengumuman.index');
    Route::post('/announcement', 'show')->name('pengumuman.check');
});

require __DIR__ . '/auth.php';
