<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ChirpController;
use \App\Http\Controllers\Auth\Register;
use \App\Http\Controllers\Auth\Logout;
use \App\Http\Controllers\LikesController;
use \App\Http\Controllers\BookmarksController;

Route::get('/debug-test', function () {
    $a = 5;
    $b = 7;
    $c = $a + $b; // ✅ BREAKPOINT HERE
    return $c;
});

Route::get('/', [ChirpController::class, 'index']);
Route::middleware('auth')->group(function () {
    Route::post('/chirps', [ChirpController::class, 'store']);
    Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit']);
    Route::put('/chirps/{chirp}', [ChirpController::class, 'update']);
    Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy']);

    Route::get('/bookmarks', [BookmarksController::class, 'index'])->name('bookmarks.index');



    Route::post('/chirps/{chirp}/bookmark', [BookmarksController::class, 'store'])->name('bookmarks.store');
    Route::delete('/chirps/{chirp}/bookmark', [BookmarksController::class, 'destroy'])->name('bookmarks.delete');
    Route::post('/chirps/{chirp}/like', [LikesController::class, 'store'])->name('chirps.like');
    Route::delete('/chirps/{chirp}/unlike', [LikesController::class, 'destroy'])->name('chirps.unlike');


});


// short-hand way to write the one above
//Route::resource('/chirps', ChirpController::class)
//    ->only(['store', 'edit', 'update', 'destroy']);

// Register routes
Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');

Route::post('/register', Register::class)
    ->middleware('guest');

//Login
Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');
Route::post('login', \App\Http\Controllers\Auth\Login::class)
    ->middleware('guest');

// Logout
Route::post('/logout', Logout::class)
    ->middleware('auth')
    ->name('logout');
