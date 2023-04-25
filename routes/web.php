<?php

use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VacancyController;
use App\Models\AnimalSpecies;
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

    // Current user
    $user = User::all()->find(auth()->id());

    $past_vacancies = Vacancy::all()
        ->whereIn('vacancy_id', DB::table('users_vacancies')
            ->where(
                'user_id',
                '=',
                auth()->id()
            )->pluck('vacancy_id'));

    $past_organisations = array();

    foreach ($past_vacancies as $vacancy) {
        $past_organisations[] = Organisation::all()->find($vacancy->organisation_id);
    }

    return view('home', [
        'organisations' => Organisation::all()->where('owner_id', '=', auth()->id()),

        'connected_users' => User::all()->whereIn('id', DB::table('connections')->where(
            'first_user_id',
            '=',
            auth()->id()
        )->pluck('second_user_id')),
        'user' => $user,
        'species' => AnimalSpecies::all()->find($user->species_id),
        'past_vacancies' => $past_vacancies,
        'past_organisations' => $past_organisations,
    ]);
})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile')->middleware('auth');
    Route::get('/profile/{user}/edit', [ProfileController::class, 'editOther'])->name('profile.editOther')->middleware('auth');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
    Route::patch('/profile/{user}/personal', [ProfileController::class, 'updateOtherPersonal'])->name('profile.updateOtherPersonal')->middleware('auth');
    Route::patch('/profile/personal', [ProfileController::class, 'updatePersonal'])->name('profile.updatePersonal')->middleware('auth');
    Route::patch('/profile/{user}', [ProfileController::class, 'updateOther'])->name('profile.updateOther')->middleware('auth');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('auth');
    Route::delete('/users/{user}', [ProfileController::class, 'destroyOther'])->middleware('auth');
});

require __DIR__ . '/auth.php';

// Choose Controller class along with whatever method
Route::get('/vacancies/index', [VacancyController::class, 'index'])->name('home')->middleware('auth');

// The convention is that if you want to do ANYTHING with stuff, prefix the path with 'vacancies'
// Using the auth middleware, you'll be sent to a login page if you want to get to certain paths
Route::get('/vacancies/{organisation}/create', [VacancyController::class, 'create'])->middleware('auth');

// Post
Route::post('/vacancies', [VacancyController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/vacancies/{vacancy}/edit', [VacancyController::class, 'edit'])->middleware('auth');

Route::get('/vacancies/recommended', [VacancyController::class, 'recommended'])->middleware('auth');

Route::put('/vacancies/{vacancy}/apply', [VacancyController::class, 'apply'])->middleware('auth');

Route::put('/vacancies/{vacancy}/unapply', [VacancyController::class, 'unapply'])->middleware('auth');


// Updating Vacancy, Edit Submit to Update
// Edit shows the form, update does the actual updating
Route::put('/vacancies/{vacancy}', [VacancyController::class, 'update'])->name('vacancy.update');

// Deletes vacancies
Route::delete('/vacancies/{vacancy}', [VacancyController::class, 'destroy'])->middleware('auth');


// Make sure {vacancy} and Vacancy $vacancy match up
// Make sure to put this towards the bottom if you plan to do other stuff with vacancies
Route::get('/vacancies/{vacancy}', [VacancyController::class, 'show'])->middleware('auth');

// ========== ORGANISATIONS ================

Route::get('/organisations/index', [OrganisationController::class, 'index'])->name('organisations.index')->middleware('auth');

Route::get('/organisations/create', [OrganisationController::class, 'create'])->middleware('auth');

Route::post('/organisations', [OrganisationController::class, 'store'])->middleware('auth');

Route::delete('/organisations/{organisation}', [OrganisationController::class, 'destroy'])->middleware('auth');


// Edit organisation
Route::get('/organisations/{organisation}/edit', [OrganisationController::class, 'edit'])->name('organisations.update')->middleware('auth');

// Update organisation

Route::put('/organisations/{organisation}', [OrganisationController::class, 'update'])->name('organisation.update')->middleware('auth');


Route::get('/organisations/{organisation}', [OrganisationController::class, 'show'])->middleware('auth');

// ========== ORGANISATIONS ================

// ========== USERS ================

Route::get('/users/index', [ProfileController::class, 'index'])->name('users.index')->middleware('auth');

Route::post('/users/filter', [ProfileController::class, 'filter'])->name('users.filter')->middleware('auth');

Route::put('/users/{user}/toggleBan', [ProfileController::class, 'toggleBan'])->middleware('auth');

Route::put('/users/{user}/toggleConnect', [ProfileController::class, 'toggleConnect'])->middleware('auth');

Route::get('/users/{user}', [ProfileController::class, 'show'])->name('user.show')->middleware('auth');

// ========== USERS ================

Route::get('/settings', function () {
    return view('settings');
})->name('settings')->middleware('auth');

// ========== SEARCH ==========

Route::get('/search', [SearchController::class, 'query'])->name('search')->middleware('auth');

// ========== SEARCH ==========
