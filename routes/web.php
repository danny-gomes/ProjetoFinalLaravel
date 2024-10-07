<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BandController;  // Import BandController
use App\Http\Controllers\AlbumController; // Import AlbumController
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;

// Login
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard')->with('success', 'You are already logged in.');
    }

    return view('loginViews/loginView');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('checkLogin');

Route::get('/users/add', [UserController::class, 'getAddUserView'])->name('login.addUserView');
Route::post('users/create-user', [UserController::class, 'register'])->name('login.registerUser');

// Dashboard
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

// Banda
Route::resource('bands', BandController::class)->except(['index']);
// Nao quero middleware no index, todos podem ver a lista de bandas e albuns a partir da barra de endereco
Route::get('bands', [BandController::class, 'index'])->name('bands.index');


// Album
Route::resource('albums', AlbumController::class)->except(['index']);
// Nao quero middleware no index, todos podem ver a lista de bandas e albuns a partir da barra de endereco
Route::get('albums', [AlbumController::class, 'index'])->name('albums.index');

// Aplicar middleware as rotas recurso especificas
Route::middleware(['auth'])->group(function () {
    Route::resource('bands', BandController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('albums', AlbumController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');


