<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Route;

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
Route::get('verify-email', EmailVerificationPromptController::class)
    ->name('verification.notice');
    

    
    Route::get('/email/verify', function () {
        return view('auth.verify');
    })->middleware('auth')->name('verification.notice');
    
    Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
        // This verifies the user's email
    })->middleware(['auth', 'signed'])->name('verification.verify');
    
    Route::post('/email/resend', function () {
        request()->user()->sendEmailVerificationNotification();
    
        return back()->with('status', 'verification-link-sent');
    })->middleware('auth')->name('verification.resend');
    

require __DIR__.'/auth.php';
