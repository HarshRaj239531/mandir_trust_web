<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\PavitraDaanController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Devotee\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Temple Pages (100% Dynamic MySQL Driven)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\TemplePublicController;

Route::get('/', [TemplePublicController::class, 'home'])->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/poojas', [TemplePublicController::class, 'poojas'])->name('poojas');
Route::post('/poojas/book', [TemplePublicController::class, 'bookPooja'])->name('poojas.book');

Route::get('/donate', [TemplePublicController::class, 'donate'])->name('donate');
Route::post('/donate', [TemplePublicController::class, 'processDonation'])->name('donate.process');

Route::get('/events', [TemplePublicController::class, 'events'])->name('events');
Route::get('/gallery', [TemplePublicController::class, 'gallery'])->name('gallery');
Route::get('/facilities', [TemplePublicController::class, 'facilities'])->name('facilities');



/*
|--------------------------------------------------------------------------
| Devotee Authentication & Registration Routes (10-Field Registration)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/verify-sponsor', [AuthController::class, 'verifySponsor'])->name('sponsor.verify');

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

Route::get('/admin', function () {
    if (auth()->check() && auth()->user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return view('auth.login');
});

Route::get('/mandiradmin', function () {
    if (auth()->check() && auth()->user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return view('auth.login');
})->name('admin.login');

Route::post('/mandiradmin/login', [AuthController::class, 'login']);
Route::post('/admin/login', [AuthController::class, 'login']);

Route::middleware(['auth', 'admin'])->prefix('mandiradmin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    
    // Devotee Management
    Route::get('/devotees', [AdminDashboardController::class, 'devotees'])->name('devotees.index');
    Route::get('/devotees/{id}/edit', [AdminDashboardController::class, 'editUser'])->name('devotee.edit');
    Route::put('/devotees/{id}', [AdminDashboardController::class, 'updateUser'])->name('devotee.update');
    Route::post('/devotees/{id}/toggle-status', [AdminDashboardController::class, 'toggleStatus'])->name('devotee.toggle-status');
    Route::delete('/devotees/{id}', [AdminDashboardController::class, 'deleteUser'])->name('devotee.delete');

    // 1. Temple Operations Modules (Yoga-style comprehensive admin panel)
    Route::get('/poojas', [AdminDashboardController::class, 'poojas'])->name('poojas.index');
    Route::post('/poojas', [AdminDashboardController::class, 'storePooja'])->name('poojas.store');
    Route::delete('/poojas/{id}', [AdminDashboardController::class, 'deletePooja'])->name('poojas.delete');

    Route::get('/donations', [AdminDashboardController::class, 'donations'])->name('donations.index');
    Route::post('/donations', [AdminDashboardController::class, 'storeDonation'])->name('donations.store');
    Route::delete('/donations/{id}', [AdminDashboardController::class, 'deleteDonation'])->name('donations.delete');

    Route::get('/events', [AdminDashboardController::class, 'events'])->name('events.index');
    Route::post('/events', [AdminDashboardController::class, 'storeEvent'])->name('events.store');
    Route::delete('/events/{id}', [AdminDashboardController::class, 'deleteEvent'])->name('events.delete');

    Route::get('/facilities', [AdminDashboardController::class, 'facilities'])->name('facilities.index');
    Route::post('/facilities', [AdminDashboardController::class, 'storeFacility'])->name('facilities.store');
    Route::delete('/facilities/{id}', [AdminDashboardController::class, 'deleteFacility'])->name('facilities.delete');

    Route::get('/gallery', [AdminDashboardController::class, 'gallery'])->name('gallery.index');
    Route::post('/gallery', [AdminDashboardController::class, 'storeGallery'])->name('gallery.store');
    Route::put('/gallery/{id}', [AdminDashboardController::class, 'updateGallery'])->name('gallery.update');
    Route::delete('/gallery/{id}', [AdminDashboardController::class, 'deleteGallery'])->name('gallery.delete');
    
    // Pavitra Daan Configuration & Seva Causes Management
    Route::get('/pavitra-daan', [PavitraDaanController::class, 'index'])->name('pavitra-daan.index');
    Route::post('/pavitra-daan/sevas', [PavitraDaanController::class, 'storeSeva'])->name('pavitra-daan.sevas.store');
    Route::put('/pavitra-daan/sevas/{id}', [PavitraDaanController::class, 'updateSeva'])->name('pavitra-daan.sevas.update');
    Route::post('/pavitra-daan/sevas/{id}/toggle-status', [PavitraDaanController::class, 'toggleSevaStatus'])->name('pavitra-daan.sevas.toggle-status');
    Route::delete('/pavitra-daan/sevas/{id}', [PavitraDaanController::class, 'deleteSeva'])->name('pavitra-daan.sevas.delete');
    Route::post('/pavitra-daan/settings', [PavitraDaanController::class, 'updateSettings'])->name('pavitra-daan.settings.update');

    // Security & Settings (Credentials, Profile, & Dynamic Homepage Media)
    Route::get('/settings', [AdminDashboardController::class, 'settings'])->name('settings');
    Route::post('/settings/password', [AdminDashboardController::class, 'updatePassword'])->name('settings.password');
    Route::post('/settings/profile', [AdminDashboardController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/settings/homepage-media', [AdminDashboardController::class, 'updateHomepageMedia'])->name('settings.homepage-media');
});

// Secondary route prefix alias so /admin/... URLs also work seamlessly
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard']);
    Route::get('/pavitra-daan', [PavitraDaanController::class, 'index']);
    Route::post('/pavitra-daan/sevas', [PavitraDaanController::class, 'storeSeva']);
    Route::put('/pavitra-daan/sevas/{id}', [PavitraDaanController::class, 'updateSeva']);
    Route::post('/pavitra-daan/sevas/{id}/toggle-status', [PavitraDaanController::class, 'toggleSevaStatus']);
    Route::delete('/pavitra-daan/sevas/{id}', [PavitraDaanController::class, 'deleteSeva']);
    Route::post('/pavitra-daan/settings', [PavitraDaanController::class, 'updateSettings']);
    Route::get('/gallery', [AdminDashboardController::class, 'gallery']);
    Route::post('/gallery', [AdminDashboardController::class, 'storeGallery']);
    Route::put('/gallery/{id}', [AdminDashboardController::class, 'updateGallery']);
    Route::delete('/gallery/{id}', [AdminDashboardController::class, 'deleteGallery']);
    Route::get('/poojas', [AdminDashboardController::class, 'poojas']);
    Route::post('/poojas', [AdminDashboardController::class, 'storePooja']);
    Route::delete('/poojas/{id}', [AdminDashboardController::class, 'deletePooja']);
    Route::get('/donations', [AdminDashboardController::class, 'donations']);
    Route::post('/donations', [AdminDashboardController::class, 'storeDonation']);
    Route::delete('/donations/{id}', [AdminDashboardController::class, 'deleteDonation']);
    Route::get('/events', [AdminDashboardController::class, 'events']);
    Route::post('/events', [AdminDashboardController::class, 'storeEvent']);
    Route::delete('/events/{id}', [AdminDashboardController::class, 'deleteEvent']);
    Route::get('/facilities', [AdminDashboardController::class, 'facilities']);
    Route::post('/facilities', [AdminDashboardController::class, 'storeFacility']);
    Route::delete('/facilities/{id}', [AdminDashboardController::class, 'deleteFacility']);
    Route::get('/settings', [AdminDashboardController::class, 'settings']);
    Route::post('/settings/password', [AdminDashboardController::class, 'updatePassword']);
    Route::post('/settings/profile', [AdminDashboardController::class, 'updateProfile']);
    Route::post('/settings/homepage-media', [AdminDashboardController::class, 'updateHomepageMedia']);
});

/*
|--------------------------------------------------------------------------
| Dynamic Media & Storage Routes (Guaranteed to work on Hostinger/cPanel)
|--------------------------------------------------------------------------
*/
Route::get('/media-file/{path}', function ($path) {
    // 1. Check in public/uploads/
    $uploadPath = public_path('uploads/' . $path);
    if (file_exists($uploadPath) && is_file($uploadPath)) {
        return response()->file($uploadPath);
    }

    // 2. Check in storage/app/public/
    $storagePath = storage_path('app/public/' . $path);
    if (file_exists($storagePath) && is_file($storagePath)) {
        return response()->file($storagePath);
    }

    // 3. Check in public/
    $publicPath = public_path($path);
    if (file_exists($publicPath) && is_file($publicPath)) {
        return response()->file($publicPath);
    }

    abort(404);
})->where('path', '.*')->name('media.file');

Route::get('/storage/{path}', function ($path) {
    $storagePath = storage_path('app/public/' . $path);
    if (file_exists($storagePath) && is_file($storagePath)) {
        return response()->file($storagePath);
    }

    $uploadPath = public_path('uploads/' . $path);
    if (file_exists($uploadPath) && is_file($uploadPath)) {
        return response()->file($uploadPath);
    }

    abort(404);
})->where('path', '.*')->name('storage.fallback');



