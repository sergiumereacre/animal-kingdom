<?php

use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacancyController;
use App\Models\AnimalSpecies;
use App\Models\Connection;
use App\Models\Vacancy;
use App\Models\Organisation;
use App\Models\User;
use App\Models\UsersVacancy;
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

    foreach ($past_vacancies as $vacancy){
        $past_organisations[] = Organisation::all()->find($vacancy->organisation_id);
    }

    // $past_jobs = array_combine($past_vacancies->toArray(), $past_organisations);

    return view('home', [
        'organisations' => Organisation::all()->where('owner_id', '=', auth()->id()),
        // 'connections' => Connection::all()->where('first_user_id', '=', auth()->id()),
        // All users with their ids available in second_user_id
        // of the connections table

        // 'users' => User::all()->whereIn('id', DB::table('connections')->where(
        //     'first_user_id', '=', auth()->id()
        // )->value('second_user_id'))

        'connected_users' => User::all()->whereIn('id', DB::table('connections')->where(
            'first_user_id',
            '=',
            auth()->id()
        )->pluck('second_user_id')),
        'user' => $user,
        'species' => AnimalSpecies::all()->find($user->species_id),
        'past_vacancies' => $past_vacancies,
        'past_organisations' => $past_organisations,
        // 'past_jobs' => $past_jobs,
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

require __DIR__ . '/auth.php';

// Choose Controller class along with whatever method
Route::get('/vacancies/index', [VacancyController::class, 'index'])->name('vacancies.index');

// The convention is that if you want to do ANYTHING with stuff, prefix the path with 'vacancies'
// Using the auth middleware, you'll be sent to a login page if you want to get to certain paths
Route::get('/vacancies/{organisation}/create', [VacancyController::class, 'create'])->middleware('auth');

// Post
Route::post('/vacancies', [VacancyController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/vacancies/{vacancy}/edit', [VacancyController::class, 'edit'])->middleware('auth');

Route::get('/vacancies/{vacancy}/apply', [VacancyController::class, 'apply'])->middleware('auth');

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

Route::get('/organisations/index', [OrganisationController::class, 'index'])->name('organisations.index');

Route::get('/organisations/create', [OrganisationController::class, 'create'])->middleware('auth');

Route::post('/organisations', [OrganisationController::class, 'store'])->middleware('auth');

Route::delete('/organisations/{organisation}', [OrganisationController::class, 'destroy'])->middleware('auth');

Route::get('/organisations/{organisation}/edit', [OrganisationController::class, 'edit'])->middleware('auth');

Route::put('/organisations/{organisation}', [OrganisationController::class, 'update'])->middleware('auth');


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
