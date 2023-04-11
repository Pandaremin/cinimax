<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserManagementController;
use App\Http\Controllers\Backend\AdminDashboardController;
use App\Http\Controllers\Backend\GenreController;
use App\Http\Controllers\Backend\MovieController;

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
// User
Route::get('/', function () {
    return view('frontend.layout');
})->name('user.dashboard');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'authRole'
])->prefix('admin')->group(function () {

    // Admin and Writer
    // Manage Profile
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.index');
    Route::get('/profile', [UserManagementController::class, 'profile'])->name('admin.profile');
    Route::post('/update/password', [UserManagementController::class, 'passwordUpdate'])->name('admin.password.update');

    // Genre
    Route::get('search/genre', [GenreController::class, 'search'])->name('genre.search');
    Route::resource('genre',GenreController::class);

    // Movies
    Route::get('search/movie', [MovieController::class, 'search'])->name('movie.search');
    Route::resource('movie',MovieController::class);

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:isAdmin'
])->prefix('admin')->group(function () {
    // Admin only
    // Manage user
    Route::get('/view/user', [UserManagementController::class, 'userIndex'])->name('admin.users.view');
    Route::get('/add/content-manager', [UserManagementController::class, 'contentManagerAdd'])->name('content.manager.add');
    Route::post('store/content-manager', [UserManagementController::class, 'contentManagerStore'])->name('content.manager.store');
    Route::get('edit//user/{id}', [UserManagementController::class, 'userEdit'])->name('user.edit');
    Route::post('/update/user/{id}', [UserManagementController::class, 'userUpdate'])->name('user.update');
    Route::delete('/delete/user/{id}', [UserManagementController::class, 'userDestroy'])->name('user.delete');

});

// User
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


    