<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
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
    return redirect()->route('login'); 
});

// Route::get('resume/{resume}/public', [ResumeController::class, 'showPublic'])->name('resume.public');
Route::get('resume/public/{public_url}', [ResumeController::class, 'showPublic'])->name('resumes.public');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resume Routes
    Route::resource('resumes', ResumeController::class); // Basic CRUD operations
    // Route::get('resumes', [ResumeController::class, 'index'])->name('resumes.index'); // Basic CRUD operations
    Route::delete('resumes/{resume}', [ResumeController::class, 'destroy'])->name('resumes.destroy');

    // Education Routes
    Route::resource('resumes.educations', 'EducationController')->shallow(); // Nested within resumes

    // Experience Routes
    Route::resource('resumes.experiences', 'ExperienceController')->shallow(); // Nested within resumes

    Route::post('/education', [EducationController::class, 'store'])->name('education.store');
    Route::get('/education/{id}', [EducationController::class, 'getDataForEdit'])->name('education.getDataForEdit');
    Route::put('/education/{id}', [EducationController::class, 'update'])->name('education.update');
    Route::delete('education/{id}', [EducationController::class, 'destroy'])->name('education.destroy');
    // Experience Routes
    Route::post('/experience', [ExperienceController::class, 'store'])->name('experience.store');
    Route::get('/experience/{id}', [ExperienceController::class, 'getDataForEdit'])->name('experience.getDataForEdit');
    Route::put('/experience/{id}', [ExperienceController::class, 'update'])->name('experience.update');
    Route::delete('experience/{id}', [ExperienceController::class, 'destroy'])->name('experience.destroy');
});

require __DIR__.'/auth.php';
