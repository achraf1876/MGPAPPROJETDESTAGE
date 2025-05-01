<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\BordereauController;
use App\Http\Controllers\HistoriqueController;

/*
|----------------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard après authentification
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Routes liées au profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes liées à la demande
    Route::middleware(['auth'])->group(function () {
        Route::get('/demande/create', [DemandeController::class, 'create'])->name('demande.create');
        Route::post('/demandes', [DemandeController::class, 'store'])->name('demandes.store');
        Route::get('/demandes', [DemandeController::class, 'index'])->name('demandes.index');
    });
    Route::get('/demandes/{demande}', [DemandeController::class, 'show'])->name('demandes.show');

    // Routes liées aux bordereaux
    Route::post('/bordereau/generer', [App\Http\Controllers\DemandeController::class, 'genererBordereau'])
    ->name('bordereau.generer');    
    Route::get('/bordereaux/create', [BordereauController::class, 'create'])->name('bordereaux.create');
    Route::post('/bordereaux', [BordereauController::class, 'store'])->name('bordereaux.store');
    Route::get('/bordereau/historique', [BordereauController::class, 'historique'])->name('bordereau.historique');
    Route::get('/bordereau/historique/{id}', [BordereauController::class, 'historique'])->name('bordereau.historique');
    Route::get('/bordereau/{id}', [BordereauController::class, 'show'])->name('bordereau.show');
    Route::get('/bordereaux/{id}', [BordereauController::class, 'show'])->name('bordereaux.show');
Route::get('/demandes/historique', [App\Http\Controllers\DemandeController::class, 'historique'])
    ->name('demandes.historique');
    Route::delete('/demandes/delete', [App\Http\Controllers\DemandeController::class, 'delete'])
    ->name('demandes.delete');
    Route::post('/historique', [HistoriqueController::class, 'store'])->name('historique.store');
    Route::get('/historique', [HistoriqueController::class, 'index'])->name('historique.index');
});



require __DIR__.'/auth.php';