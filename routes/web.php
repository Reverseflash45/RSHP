<?php

use Illuminate\Support\Facades\Route;

// Public & Site
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Rshp\RshpController;
use App\Http\Controllers\HomeController;

// Admin
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
| PUBLIC ROUTES
|--------------------------------------------------------------------------
| "/" adalah landing RSHP. Jangan redirect ke /home, karena /home adalah
| dashboard setelah login (sesuai modul).
*/
Route::get('/', [RshpController::class, 'index'])->name('site.home');

Route::view('/struktur', 'rshp.menu.struktur')->name('struktur');
Route::view('/layanan',  'rshp.menu.layanan')->name('layanan');
Route::view('/visi-misi','rshp.menu.visi-misi')->name('visi-misi');

Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES (PASTIKAN DI ATAS ADMIN)
|--------------------------------------------------------------------------
| Pakai scaffolding bawaan. Hapus route login/logout custom kamu agar
| tidak bentrok.
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| DASHBOARD SETELAH LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (WAJIB LOGIN) — diletakkan DI BAWAH Auth::routes()
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard & Data Master (view statis)
    Route::view('/',            'rshp.admin.AdminD.home-admin')->name('dashboard');
    Route::view('/data-master', 'rshp.admin.AdminD.data-master')->name('data-master');

    // DATA USER (sesuai link di Blade)
    Route::resource('user', UserController::class)->only(['index','create','edit']);
    Route::get('user/{user}/reset-password', [UserController::class, 'reset'])->name('user.reset');

    // ROLE USER (aksi pivot)
    Route::get('role-user',              [RoleUserController::class, 'index'])->name('role-user.index');
    Route::post('role-user/add',         [RoleUserController::class, 'add'])->name('role-user.add');
    Route::post('role-user/activate',    [RoleUserController::class, 'activate'])->name('role-user.activate');
    Route::post('role-user/deactivate',  [RoleUserController::class, 'deactivate'])->name('role-user.deactivate');
    Route::post('role-user/make-active', [RoleUserController::class, 'makeActive'])->name('role-user.makeActive');

    // MASTER DATA
    Route::resource('jenis-hewan',     JenisHewanController::class);
    Route::resource('ras',             RasController::class);
    Route::resource('pemilik',         PemilikController::class);
    Route::resource('pet',             PetController::class);
    Route::resource('kategori',        KategoriController::class);
    Route::resource('kategori-klinis', KategoriKlinisController::class);
    Route::resource('kode-tindakan',   KodeTindakanController::class);
});

Auth::routes();

// Dashboard umum setelah login (tetap)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* ==================== ADMIN ==================== */
Route::middleware(['auth','isAdministrator'])
    ->prefix('admin')->name('admin.')->group(function () {

    Route::view('/',            'rshp.admin.AdminD.home-admin')->name('dashboard');
    Route::view('/data-master', 'rshp.admin.AdminD.data-master')->name('data-master');

    Route::resource('user', App\Http\Controllers\Admin\UserController::class)->only(['index','create','edit']);
    Route::get('user/{user}/reset-password', [App\Http\Controllers\Admin\UserController::class, 'reset'])->name('user.reset');

    Route::get('role-user',              [App\Http\Controllers\Admin\RoleUserController::class, 'index'])->name('role-user.index');
    Route::post('role-user/add',         [App\Http\Controllers\Admin\RoleUserController::class, 'add'])->name('role-user.add');
    Route::post('role-user/activate',    [App\Http\Controllers\Admin\RoleUserController::class, 'activate'])->name('role-user.activate');
    Route::post('role-user/deactivate',  [App\Http\Controllers\Admin\RoleUserController::class, 'deactivate'])->name('role-user.deactivate');
    Route::post('role-user/make-active', [App\Http\Controllers\Admin\RoleUserController::class, 'makeActive'])->name('role-user.makeActive');

    Route::resource('jenis-hewan',     App\Http\Controllers\Admin\JenisHewanController::class);
    Route::resource('ras',             App\Http\Controllers\Admin\RasController::class);
    Route::resource('pemilik',         App\Http\Controllers\Admin\PemilikController::class);
    Route::resource('pet',             App\Http\Controllers\Admin\PetController::class);
    Route::resource('kategori',        App\Http\Controllers\Admin\KategoriController::class);
    Route::resource('kategori-klinis', App\Http\Controllers\Admin\KategoriKlinisController::class);
    Route::resource('kode-tindakan',   App\Http\Controllers\Admin\KodeTindakanController::class);
});

/* ================= RESEPSIONIS ================ */
Route::middleware(['auth','isResepsionis'])
    ->prefix('resepsionis')->name('resepsionis.')->group(function () {
    Route::view('/', 'rshp.resepsionis.dashboard')->name('dashboard');
    // Tambah route khusus resepsionis di sini
});

/* ===================== DOKTER ================== */
Route::middleware(['auth','isDokter'])
    ->prefix('dokter')->name('dokter.')->group(function () {
    Route::view('/', 'rshp.dokter.dashboard')->name('dashboard');
    // Tambah route dokter di sini
});

/* ==================== PERAWAT ================== */
Route::middleware(['auth','isPerawat'])
    ->prefix('perawat')->name('perawat.')->group(function () {
    Route::view('/', 'rshp.perawat.dashboard')->name('dashboard');
    // Tambah route perawat di sini
});

/* ===================== PEMILIK ================= */
Route::middleware(['auth','isPemilik'])
    ->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::view('/', 'rshp.pemilik.dashboard')->name('dashboard');
    // Tambah route pemilik di sini
});
