<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialAuthController;

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
    return view('welcome');
});

// Rutas de logueo con Facebook
Route::get('/auth/redirectFacebook', [SocialAuthController::class, 'redirectFacebook'])->name('auth.redirectFacebook');
Route::get('/auth/callbackFacebook', [SocialAuthController::class, 'callbackFacebook'])->name('auth.callbackFacebook');

// Rutas de logueo con Google
Route::get('/auth/redirectGoogle', [SocialAuthController::class, 'redirectGoogle'])->name('auth.redirectGoogle');
Route::get('/auth/callbackGoogle', [SocialAuthController::class, 'callbackGoogle'])->name('auth.callbackGoogle');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
