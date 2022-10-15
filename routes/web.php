<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Teacher;
use App\Models\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/teacher-profile/{teacher}', function (Teacher $teacher, Profile $profile) {
//     return Inertia::render('TeacherProfile', [
//         'teacher' => $teacher,
//         'profile' => $profile
//     ]);
// })->name('teacher-profile');
Route::get('/teacher-profile/{teacher}', function (Teacher $teacher) {
    return Inertia::render('TeacherProfile', [
        'teacher_id' => $teacher->id
    ]);
})->middleware(['auth', 'verified'])->name('teacher-profile');


// Route::get('/teacher-profile', 'TeacherController@show');
require __DIR__.'/auth.php';
