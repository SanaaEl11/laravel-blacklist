<?php

use App\Http\Controllers\PublicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BlacklistController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\EntrepriseDashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SecteurController;
use App\Http\Controllers\TypeProductController;

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


Route::get('/login', function () {
    return view('login');
})->name('login');



Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/status', function () {
    return view('status.page');
})->name('status.page');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/entreprise/dashboard', [EntrepriseController::class, 'index'])->name('entreprise.dashboard');


// Dans routes/web.php
Route::middleware(['auth:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
});


    // In routes/web.php
// Correction dans routes/web.php
Route::middleware(['auth:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
        Route::get('/admin/Statistique', [AdminDashboardController::class, 'indexCharts'])
        ->name('admin.Charts');


// For example, if you have an EnterpriseDashboardController:
    Route::get('/entreprise', [EntrepriseDashboardController::class, 'index'])->name('entreprise.index');
    Route::get('/entreprises/verification', [EntrepriseController::class, 'verifiedEntreprise'])
        ->name('admin.verifiedEntreprise');
    Route::post('/entreprises/{entreprise}/update-status', [EntrepriseController::class, 'updateStatus'])
        ->name('entreprises.updateStatus');
    Route::get('/entreprises/search', [EntrepriseController::class, 'search'])
        ->name('admin.entreprises.search');
    
    // Cette route devrait être pour afficher une entreprise spécifique
    Route::get('/entreprises/{entreprise}', [EntrepriseController::class, 'show'])
        ->name('admin.entreprises.show');
// ajouter secteur
    Route::get('/ajouter-secteur', [SecteurController::class, 'create'])
        ->name('admin.ajouterSecteur');
        
    Route::post('/ajouter-secteur', [SecteurController::class, 'store'])->name('admin.ajouterSecteur.store');;
// ajoutee type 
    Route::get('/ajouter-type', [TypeProductController::class, 'create'])
        ->name('admin.ajouterType');
        
    Route::post('/ajouter-type', [TypeProductController::class, 'store'])->name('admin.ajouterType.store');

    // products list 
    Route::get('/products', [ProductController::class, 'index'])
    ->name('admin.listProducts');
    // Routes publications
    Route::prefix('publications')->group(function() {
        Route::get('/check-posts', [PublicationController::class, 'checkPosts'])
        ->name('admin.publications.check'); // Doit correspondre exactement
        
        Route::put('/{id}', [PublicationController::class, 'updateStatus'])
            ->name('admin.publications.update');
        
        // Formulaire de rejet
        Route::get('/{id}/reject', [PublicationController::class, 'rejectForm'])
            ->name('admin.publications.reject.form');
        
        // Traitement du rejet
        Route::post('/{id}/reject', [PublicationController::class, 'rejectStore'])
            ->name('admin.publications.reject.store');
    });

// Routes pour afficher les fichiers
Route::get('/view-image/{file}', function ($file) {
    $path = storage_path('app/uploads/' . $file);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->name('admin.view.image');

Route::get('/view-file/{file}', function ($file) {
    $path = storage_path('app/uploads/' . $file);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->name('admin.view.file');

Route::middleware(['auth:admin'])->group(function() {
    Route::get('/blacklist-directory', [BlacklistController::class, 'index'])
        ->name('admin.blacklist.directory');
});
});
// routes/web.php

Route::middleware(['auth:entreprise'])->group(function () {
    Route::get('/dashboard', [EntrepriseDashboardController::class, 'index'])
        ->name('entreprise.dashboard');
});