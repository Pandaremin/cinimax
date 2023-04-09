<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserManagementController;
use App\Http\Controllers\Backend\AdminController;
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
    // Admin
    // Manage user
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/profile', [UserManagementController::class, 'profile'])->name('admin.profile');
    Route::post('/update/password', [UserManagementController::class, 'passwordUpdate'])->name('admin.password.update');
    Route::get('/view/user', [UserManagementController::class, 'userIndex'])->name('admin.users.view');
    Route::get('/add/content-manager', [UserManagementController::class, 'contentManagerAdd'])->name('content.manager.add');
    Route::post('/content-manager/store', [UserManagementController::class, 'contentManagerStore'])->name('content.manager.store');
    Route::get('edit//user/{id}', [UserManagementController::class, 'userEdit'])->name('user.edit');
    Route::post('/update/user/{id}', [UserManagementController::class, 'userUpdate'])->name('user.update');
    Route::delete('/delete/user/{id}', [UserManagementController::class, 'userDestroy'])->name('user.delete');

    // Genre
    Route::get('genre/', [GenreController::class, 'index'])->name('genre.index');
    Route::get('genre/create', [GenreController::class, 'create'])->name('genre.create');
    Route::post('genre/store', [GenreController::class, 'store'])->name('genre.store');
    Route::get('genre/edit/{id}', [GenreController::class, 'edit'])->name('genre.edit');
    Route::post('genre/update/{id}', [GenreController::class, 'update'])->name('genre.update');
    Route::delete('/genre/delete/{id}', [GenreController::class, 'destroy'])->name('genre.delete');
    Route::get('genre/search', [GenreController::class, 'search'])->name('genre.search');

    // Movies
    Route::get('movie/', [MovieController::class, 'index'])->name('movie.index');
    Route::get('movie/create', [MovieController::class, 'create'])->name('movie.create');
    Route::post('movie/store', [MovieController::class, 'store'])->name('movie.store');
    Route::get('movie/edit/{id}', [MovieController::class, 'edit'])->name('movie.edit');
    Route::post('movie/update/{id}', [MovieController::class, 'update'])->name('movie.update');
    Route::delete('/movie/delete/{id}', [MovieController::class, 'destroy'])->name('movie.delete');
    Route::get('movie/search', [MovieController::class, 'search'])->name('movie.search');

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


    