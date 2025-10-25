<?php

use Illuminate\Support\Facades\Route;

// Site & RSHP
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Rshp\RshpController;

// Auth
use App\Http\Controllers\Rshp\AuthController;

// Admin controllers
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\RasController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanController;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

// Root -> Home
Route::redirect('/', '/home');

// Public pages
Route::get('/home', [RshpController::class, 'index'])->name('home');
Route::view('/struktur', 'rshp.menu.struktur')->name('struktur');
Route::view('/layanan', 'rshp.menu.layanan')->name('layanan');
Route::view('/visi-misi', 'rshp.menu.visi-misi')->name('visi-misi');

// Utility
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
*/
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin routes (protected)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Dashboard & Data Master
    Route::view('/',            'rshp.admin.AdminD.home-admin')->name('dashboard');
    Route::view('/data-master', 'rshp.admin.AdminD.data-master')->name('data-master');

    // Data Master cards (index endpoints)
    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    // Role User (index + aksi)
    Route::get('/role-user',            [RoleUserController::class, 'index'])->name('role-user.index');
    Route::post('/role-user/add',       [RoleUserController::class, 'add'])->name('role-user.add');
    Route::post('/role-user/activate',  [RoleUserController::class, 'activate'])->name('role-user.activate');
    Route::post('/role-user/deactivate',[RoleUserController::class, 'deactivate'])->name('role-user.deactivate');
    Route::post('/role-user/make-active',[RoleUserController::class, 'makeActive'])->name('role-user.makeActive');

    // Resources (CRUD)
    Route::resource('jenis-hewan',     JenisHewanController::class);
    Route::resource('ras',             RasController::class);
    Route::resource('pemilik',         PemilikController::class);
    Route::resource('pet',             PetController::class);
    Route::resource('kategori',        KategoriController::class);
    Route::resource('kategori-klinis', KategoriKlinisController::class);
    Route::resource('kode-tindakan',   KodeTindakanController::class);

    // (Opsional) kalau butuh create/edit user dalam admin:
    // Route::resource('user', UserController::class)->only(['index','create','edit']);
});
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Dashboard + data-master (punyamu sudah ada, biarkan)
    Route::view('/', 'rshp.admin.AdminD.home-admin')->name('dashboard');
    Route::view('/data-master', 'rshp.admin.AdminD.data-master')->name('data-master');

    // ==== DATA USER (sesuai yang dipakai di Blade) ====
    Route::resource('user', UserController::class)->only(['index','create','edit']);
    // Tambahkan route reset password (GET dulu sesuai link di Blade)
    Route::get('user/{user}/reset-password', [UserController::class, 'reset'])->name('user.reset');

    // ==== ROLE USER (sesuai link yg kamu pakai) ====
    Route::get('role-user', [RoleUserController::class,'index'])->name('role-user.index');
    Route::post('role-user/add', [RoleUserController::class,'add'])->name('role-user.add');
    Route::post('role-user/activate', [RoleUserController::class,'activate'])->name('role-user.activate');
    Route::post('role-user/deactivate', [RoleUserController::class,'deactivate'])->name('role-user.deactivate');
    Route::post('role-user/make-active', [RoleUserController::class,'makeActive'])->name('role-user.makeActive');

    // (route CRUD lainmu: jenis-hewan, ras, pemilik, pet, kategori, kategori-klinis, kode-tindakan) tetap di sini
});