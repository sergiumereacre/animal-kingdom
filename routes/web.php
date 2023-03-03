<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Choose Controller class along with whatever method
Route::get('/vacancies/index', [VacancyController::class, 'index']);

// The convention is that if you want to do ANYTHING with stuff, prefix the path with 'vacancies'
// Using the auth middleware, you'll be sent to a login page if you want to get to certain paths
Route::get('/vacancies/create', [VacancyController::class, 'create'])->middleware('auth');

// Post
Route::post('/vacancies', [VacancyController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/vacancies/{vacancy}/edit', [VacancyController::class, 'edit'])->middleware('auth');

// Updating Vacancy, Edit Submit to Update
// Edit shows the form, update does the actual updating
Route::put('/vacancies/{vacancy}', [VacancyController::class, 'update'])->middleware('auth');

// Deletes vacancies
Route::delete('/vacancies/{vacancy}', [VacancyController::class, 'destroy'])->middleware('auth');

// Manage vacancies
Route::get('/vacancies/manage', [VacancyController::class, 'manage'])->middleware('auth');

// Make sure {vacancy} and Vacancy $vacancy match up
// Make sure to put this towards the bottom if you plan to do other stuff with vacancies
Route::get('/vacancies/{vacancy}', [VacancyController::class, 'show']);

