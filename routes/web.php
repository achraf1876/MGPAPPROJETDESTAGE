<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\BordereauController;
use App\Http\Controllers\HistoriqueController;

/*
|-------------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------------
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
    Route::get('/demande/create', [DemandeController::class, 'create'])->name('demande.create');
    Route::post('/demandes', [DemandeController::class, 'store'])->name('demandes.store');
    Route::get('/demandes', [DemandeController::class, 'index'])->name('demandes.index');
    Route::get('/demandes/{demande}', [DemandeController::class, 'show'])->name('demandes.show');
    Route::post('/demandes/generer-bordereau', [DemandeController::class, 'genererBordereau'])->name('demandes.genererBordereau');


    // Routes liées aux bordereaux

    // Historique des bordereaux
   
    Route::post('/historique', [HistoriqueController::class, 'store'])->name('historique.store');
    Route::get('/historique', [HistoriqueController::class, 'index'])->name('historique.index');
    Route::post('/bordereau/generate', [BordereauController::class, 'generate'])->name('bordereau.generate');
    Route::get('/bordereaux', [BordereauController::class, 'afficher']);

});
Route::get('/bordereaux', [BordereauController::class, 'index'])->name('bordereaux.index');
Route::post('/bordereau/generate', [BordereauController::class, 'generate'])->name('bordereaux.generate');
Route::get('/bordereau/afficher', [BordereauController::class, 'afficher'])->name('bordereaux.afficher');
Route::get('/bordereau/download/{id}', [BordereauController::class, 'download'])->name('bordereaux.download');
Route::delete('/bordereaux/{id}', [BordereauController::class, 'destroy'])->name('bordereaux.destroy');
Route::get('/demandes/{demande}/edit', [DemandeController::class, 'edit'])->name('demandes.edit');
Route::put('/demandes/{demande}', [DemandeController::class, 'update'])->name('demandes.update');
Route::delete('/demandes/{id}', [DemandeController::class, 'destroy'])->name('demandes.destroy');


Route::get('/demande/fichier/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);

    if (!file_exists($path)) {
        abort(404, 'Fichier non trouvé');
    }

    return response()->file($path);
})->name('demande.fichier');

require __DIR__.'/auth.php';
