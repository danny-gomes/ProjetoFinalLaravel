<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BandController;  // Import BandController
use App\Http\Controllers\AlbumController; // Import AlbumController
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;

// Login Routes
Route::get('/', function () {
    return view('loginViews/loginView');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('checkLogin');

Route::get('/users/add', [UserController::class, 'getAddUserView'])->name('login.addUserView');
Route::post('users/create-user', [UserController::class, 'register'])->name('login.registerUser');

// User Dashboard Route
Route::get('/user/dashboard', [UserController::class, 'dashboard'])->middleware('auth')->name('user.dashboard');

// Admin Dashboard Route
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', CheckAdmin::class])->name('admin.dashboard');

// Band Routes
Route::resource('bands', BandController::class)->except(['show']);
Route::get('bands/create-band/', [BandController::class, 'getCreateBandView'])->name('band.createBandView');

// Album Routes
Route::resource('albums', AlbumController::class)->except(['show']);

