<?php

use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacancyController;
use App\Models\Connection;
use App\Models\Vacancy;
use App\Models\Organisation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

Route::get('/home', function () {
    // return view('home');
    return view('home', [
        'organisations' => Organisation::all()->where('owner_id', '=', auth()->id()),
        // All users with their ids available in second_user_id
        // of the connections table
        
        // 'users' => User::all()->whereIn('id', DB::table('connections')->where(
        //     'first_user_id', '=', auth()->id()
        // )->pluck('second_user_id'))
        'vacancies' => Vacancy::all()

    ]);
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // For viewing other users, possibly some exclusive to admins
    // Route::get('/users/index', [ProfileController::class, 'index']);

    // Route::get('/users/{organisation}/edit', [ProfileController::class, 'edit'])->middleware('auth');

    // Route::put('/users/{organisation}', [ProfileController::class, 'update'])->middleware('auth');

    // Route::delete('/users/{organisation}', [ProfileController::class, 'destroy'])->middleware('auth');

    // Route::get('/users/manage', [ProfileController::class, 'manage'])->middleware('auth');

    // Route::get('/organisations/{organisation}', [ProfileController::class, 'show']);

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

// ========== ORGANISATIONS ================

Route::get('/organisations/index', [OrganisationController::class, 'index']);

Route::get('/organisations/create', [OrganisationController::class, 'create'])->middleware('auth');

Route::post('/organisations', [OrganisationController::class, 'store'])->middleware('auth');

Route::get('/organisations/{organisation}/edit', [OrganisationController::class, 'edit'])->middleware('auth');

Route::put('/organisations/{organisation}', [OrganisationController::class, 'update'])->middleware('auth');

Route::delete('/organisations/{organisation}', [OrganisationController::class, 'destroy'])->middleware('auth');

Route::get('/organisations/manage', [OrganisationController::class, 'manage'])->middleware('auth');

Route::get('/organisations/{organisation}', [OrganisationController::class, 'show']);

// ========== ORGANISATIONS ================

// ========== USERS ================

Route::get('/users/index', [ProfileController::class, 'index'])->name('users.index');

Route::get('/users/{user}', [ProfileController::class, 'show'])->name('user');


// ========== USERS ================

Route::get('/settings', function () {
    return view('settings');
})->name('settings');
