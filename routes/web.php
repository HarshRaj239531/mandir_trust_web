<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Devotee\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Temple Pages
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/poojas', function () {
    return view('poojas');
})->name('poojas');

Route::get('/donate', function () {
    return view('donate');
})->name('donate');

Route::get('/events', function () {
    return view('events');
})->name('events');

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

Route::get('/facilities', function () {
    return view('facilities');
})->name('facilities');


/*
|--------------------------------------------------------------------------
| Devotee Authentication & Registration Routes (10-Field Registration)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Devotee Account & Profile (Shows locked fields & allows updating editable fields)
    Route::get('/my-account', [ProfileController::class, 'show'])->name('devotee.profile');
    Route::post('/my-account', [ProfileController::class, 'update'])->name('devotee.profile.update');
});


/*
|--------------------------------------------------------------------------
| Mandir Administrator Portal (/mandiradmin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('mandiradmin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/devotees', [AdminDashboardController::class, 'devotees'])->name('devotees.index');
    Route::get('/devotees/{id}/edit', [AdminDashboardController::class, 'editUser'])->name('devotee.edit');
    Route::put('/devotees/{id}', [AdminDashboardController::class, 'updateUser'])->name('devotee.update');
    Route::post('/devotees/{id}/toggle-status', [AdminDashboardController::class, 'toggleStatus'])->name('devotee.toggle-status');
    Route::delete('/devotees/{id}', [AdminDashboardController::class, 'deleteUser'])->name('devotee.delete');
});
