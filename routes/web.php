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
})->name('landing');

Route::get('/teslanding', function () {
    return view('landingpage');
    // 'recruitment' ini harus sama persis dengan nama file blade kamu (tanpa .blade.php)
});
// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ApplicantController::class, 'index'])->name('dashboard');
    Route::post('/applicant/store', [ApplicantController::class, 'store'])->name('applicant.store');
    Route::post('/applicant/store-tasks', [ApplicantController::class, 'storeTasks'])->name('applicant.store_tasks');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(PengumumanController::class)->group(function () {
    Route::get('/announcement', 'index')->name('pengumuman.index');
    Route::post('/announcement', 'show')->name('pengumuman.check');
});

require __DIR__.'/auth.php';
