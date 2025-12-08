<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public & Site
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Rshp\RshpController;

// Dashboard umum
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
*/
Route::get('/', [RshpController::class, 'index'])->name('site.home');

Route::view('/struktur', 'rshp.menu.struktur')->name('struktur');
Route::view('/layanan',  'rshp.menu.layanan')->name('layanan');
Route::view('/visi-misi','rshp.menu.visi-misi')->name('visi-misi');

Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (default Laravel)
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| DASHBOARD UMUM (kalau kamu mau pakai)
|--------------------------------------------------------------------------
*/
Route::get('/home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| ADMIN (role = 1)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdministrator'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::view('/',            'rshp.admin.AdminD.home-admin')->name('dashboard');
        Route::view('/data-master', 'rshp.admin.AdminD.data-master')->name('data-master');

        Route::resource('user', UserController::class)->only(['index','create','edit']);
        Route::get('user/{user}/reset-password', [UserController::class, 'reset'])->name('user.reset');

        Route::get('role-user',              [RoleUserController::class, 'index'])->name('role-user.index');
        Route::post('role-user/add',         [RoleUserController::class, 'add'])->name('role-user.add');
        Route::post('role-user/activate',    [RoleUserController::class, 'activate'])->name('role-user.activate');
        Route::post('role-user/deactivate',  [RoleUserController::class, 'deactivate'])->name('role-user.deactivate');
        Route::post('role-user/make-active', [RoleUserController::class, 'makeActive'])->name('role-user.makeActive');

        Route::resource('jenis-hewan',     JenisHewanController::class);
        Route::resource('ras',             RasController::class);
        Route::resource('pemilik',         PemilikController::class);
        Route::resource('pet',             PetController::class);
        Route::resource('kategori',        KategoriController::class);
        Route::resource('kategori-klinis', KategoriKlinisController::class);
        Route::resource('kode-tindakan',   KodeTindakanController::class);
        Route::post('role-user/delete',     [RoleUserController::class, 'delete'])->name('role-user.delete');
    });

/*
|--------------------------------------------------------------------------
| RESEPSIONIS (role = 4)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isResepsionis'])
    ->prefix('resepsionis')
    ->name('resepsionis.')
    ->group(function () {
        Route::view('/', 'rshp.resepsionis.dashboard')->name('dashboard');
    });

/*
|--------------------------------------------------------------------------
| DOKTER (role = 2)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isDokter'])
    ->prefix('dokter')
    ->name('dokter.')
    ->group(function () {
        Route::view('/', 'rshp.dokter.dashboard')->name('dashboard');
    });

/*
|--------------------------------------------------------------------------
| PERAWAT (role = 3)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isPerawat'])
    ->prefix('perawat')
    ->name('perawat.')
    ->group(function () {
        Route::view('/', 'rshp.perawat.dashboard')->name('dashboard');
    });

/*
|--------------------------------------------------------------------------
| PEMILIK (role = 5 atau selain 1..4)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isPemilik'])
    ->prefix('pemilik')
    ->name('pemilik.')
    ->group(function () {
        Route::view('/', 'rshp.pemilik.dashboard')->name('dashboard');
    });

/* ================= RESEPSIONIS ================= */
Route::middleware(['auth','isResepsionis'])
    ->prefix('resepsionis')
    ->name('resepsionis.')
    ->group(function () {

        // Dashboard Resepsionis
        Route::view('/', 'rshp.Resepsionis.home_resepsionis')->name('dashboard');

        // Temu Dokter
        Route::view('/temu-dokter', 'rshp.Resepsionis.edit_temudokter')->name('temu-dokter');

        // Registrasi Pemilik
        Route::view('/registrasi/pemilik', 'rshp.Resepsionis.registrasi_pemilik')->name('registrasi.pemilik');

        // Registrasi Pet
        Route::view('/registrasi/pet', 'rshp.Resepsionis.registrasi_pet')->name('registrasi.pet');
    });


/* ===================== DOKTER ================== */
Route::middleware(['auth','isDokter'])
    ->prefix('dokter')->name('dokter.')->group(function () {
        Route::view('/', 'rshp.Dokter.Dasboard')->name('dashboard');
    });

/* ==================== PERAWAT ================== */
Route::middleware(['auth','isPerawat'])
    ->prefix('perawat')
    ->name('perawat.')
    ->group(function () {

        // 1) dashboard perawat
        // pake salah satu dari ini, tergantung nama file-mu

        // kalau file-mu namanya resources/views/rshp/Perawat/home_perawat.blade.php
        // Route::view('/', 'rshp.Perawat.home_perawat')->name('dashboard');

        // kalau file-mu namanya resources/views/rshp/Perawat/Dasboard.blade.php
        Route::view('/', 'rshp.Perawat.Dasboard')->name('dashboard');

        // 2) daftar & reservasi yg belum punya rekam medis
        Route::get('/rekam-medis', function () {
            // NANTI ini idealnya pakai controller
            // untuk sekarang biar kebuka dulu
            return view('rshp.Perawat.rekam_medis_index', [
                'reservasi' => [],   // sementara kosong
                'listRM'    => [],   // sementara kosong
            ]);
        })->name('rekam-medis.index');

        // 3) form bikin rekam medis
        Route::get('/rekam-medis/create', function (\Illuminate\Http\Request $request) {
            return view('rshp.Perawat.rekam_medis_create', [
                'info' => [
                    'idtemu_dokter' => $request->query('idtemu'),
                    'no_urut'       => null,
                    'waktu_daftar'  => null,
                    'nama_pet'      => null,
                    'nama_pemilik'  => null,
                ],
                'err' => null,
                'msg' => null,
            ]);
        })->name('rekam-medis.create');

        // 4) detail + tindakan rekam medis
        Route::get('/rekam-medis/detail', function (\Illuminate\Http\Request $request) {
            return view('rshp.Perawat.rekam_medis_detail', [
                'idRekam'        => $request->query('id'),
                'header'         => [],
                'detailTindakan' => [],
                'listKode'       => [],
                'msg'            => null,
                'ok'             => null,
            ]);
        })->name('rekam-medis.detail');
    });


/* ===================== PEMILIK ================= */
Route::middleware(['auth','isPemilik'])
    ->prefix('pemilik')->name('pemilik.')->group(function () {
        Route::view('/', 'rshp.Pemilik.dashboard')->name('dashboard');
    });

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Route::middleware(['auth', 'isResepsionis'])
    ->prefix('resepsionis')
    ->name('resepsionis.')
    ->group(function () {

        // 1. Dashboard
        Route::view('/', 'rshp.Resepsionis.dashboard')->name('dashboard');

        // 2. TEMU DOKTER (LIST + FORM)
        Route::get('/temu-dokter', function () {
            // semua pet + nama pemilik
            $allPets = DB::table('pet')
                ->join('pemilik', 'pemilik.idpemilik', '=', 'pet.idpemilik')
                ->join('user', 'user.iduser', '=', 'pemilik.iduser')
                ->select(
                    'pet.idpet',
                    'pet.nama as nama_pet',
                    'user.nama as nama_pemilik'
                )
                ->orderBy('pet.nama')
                ->get();

            // pet yang hari ini sudah daftar
            $activePetIds = DB::table('temu_dokter')
                ->whereDate('waktu_daftar', today())
                ->pluck('idpet')
                ->toArray();

            // daftar dokter aktif
            $dokter = DB::table('role_user as ru')
                ->join('role as r', 'r.idrole', '=', 'ru.idrole')
                ->join('user as u', 'u.iduser', '=', 'ru.iduser')
                ->where('r.nama_role', 'Dokter')
                ->where('ru.status', 1)
                ->orderBy('u.nama')
                ->get();

            // antrian hari ini
            $antrian = DB::table('temu_dokter as td')
                ->join('pet as p', 'p.idpet', '=', 'td.idpet')
                ->join('role_user as ru', 'ru.idrole_user', '=', 'td.idrole_user')
                ->join('user as ud', 'ud.iduser', '=', 'ru.iduser')
                ->select(
                    'td.idtemu_dokter',
                    'td.no_urut',
                    'td.waktu_daftar',
                    'p.nama as nama_pet',
                    'ud.nama as nama_dokter',
                    'td.status'
                )
                ->whereDate('td.waktu_daftar', today())
                ->orderBy('td.no_urut')
                ->get();

            return view('rshp.Resepsionis.edit_temudokter', [
                'allPets'      => $allPets,
                'activePetIds' => $activePetIds,
                'dokter'       => $dokter,
                'antrian'      => $antrian,
            ]);
        })->name('temu-dokter');

        // 2a. SIMPAN ANTRIAN TEMU DOKTER
        Route::post('/temu-dokter', function (Request $request) {
            $data = $request->validate([
                'idpet'       => 'required|integer',
                'idrole_user' => 'required|integer',
                'act'         => 'nullable|string',
            ]);

            // tambah antrian
            if (($data['act'] ?? '') === 'add') {
                // cari nomor urut hari ini
                $lastNo = DB::table('temu_dokter')
                    ->whereDate('waktu_daftar', today())
                    ->max('no_urut');

                $nextNo = (int)$lastNo + 1;

                DB::table('temu_dokter')->insert([
                    'idpet'       => $data['idpet'],
                    'idrole_user' => $data['idrole_user'],
                    'no_urut'     => $nextNo,
                    'status'      => 0,
                    'waktu_daftar'=> now(),
                ]);

                return back()->with('success', 'Pendaftaran berhasil. No. Urut: ' . $nextNo);
            }

            return back();
        })->name('temu-dokter.store');

        // 2b. UPDATE STATUS ANTRIAN
        Route::post('/temu-dokter/status', function (Request $request) {
            $data = $request->validate([
                'idtemu' => 'required|integer',
                'status' => 'required|integer|in:1,2',
            ]);

            DB::table('temu_dokter')
                ->where('idtemu_dokter', $data['idtemu'])
                ->update([
                    'status' => $data['status'],
                ]);

            return back()->with('success', 'Status antrian diperbarui.');
        })->name('temu-dokter.status');

        // 3. REGISTRASI PEMILIK (FORM)
        Route::get('/registrasi-pemilik', function () {
            return view('rshp.Resepsionis.registrasi_pemilik');
        })->name('registrasi-pemilik');

        // 3a. REGISTRASI PEMILIK (SIMPAN)
        Route::post('/registrasi-pemilik', function (Request $request) {
            $data = $request->validate([
                'nama'     => 'required|string|max:100',
                'email'    => 'required|email|max:150',
                'password' => 'required|string|min:3',
                'no_wa'    => 'required|string|max:50',
                'alamat'   => 'required|string',
            ]);

            // insert ke user
            $userId = DB::table('user')->insertGetId([
                'nama'           => $data['nama'],
                'email'          => $data['email'],
                'password'       => bcrypt($data['password']),
                'remember_token' => null,
            ]);

            // insert ke pemilik
            DB::table('pemilik')->insert([
                'iduser'  => $userId,
                'no_wa'   => $data['no_wa'],
                'alamat'  => $data['alamat'],
            ]);

            // kasih role pemilik kalau kamu perlu
            // misal di DB kamu: 5 = pemilik
            DB::table('role_user')->insert([
                'iduser' => $userId,
                'idrole' => 5,
                'status' => 1,
            ]);

            return back()->with('success', 'Pemilik berhasil didaftarkan.');
        })->name('registrasi-pemilik.store');

        // 4. REGISTRASI PET (FORM)
        Route::get('/registrasi-pet', function () {
            $pemilik = DB::table('pemilik')
                ->join('user', 'user.iduser', '=', 'pemilik.iduser')
                ->select('pemilik.idpemilik', 'user.nama', 'user.email')
                ->orderBy('user.nama')
                ->get();

            $ras = DB::table('ras_hewan')
                ->leftJoin('jenis_hewan', 'jenis_hewan.idjenis_hewan', '=', 'ras_hewan.idjenis_hewan')
                ->select(
                    'ras_hewan.idras_hewan',
                    'ras_hewan.nama_ras',
                    'jenis_hewan.nama_jenis_hewan'
                )
                ->orderBy('ras_hewan.nama_ras')
                ->get();

            return view('rshp.Resepsionis.registrasi_pet', [
                'pemilik_list' => $pemilik,
                'ras_list'     => $ras,
            ]);
        })->name('registrasi-pet');

        // 4a. REGISTRASI PET (SIMPAN)
        Route::post('/registrasi-pet', function (Request $request) {
            $data = $request->validate([
                'nama'          => 'required|string|max:100',
                'tanggal_lahir' => 'nullable|date',
                'warna_tanda'   => 'nullable|string|max:100',
                'jenis_kelamin' => 'required|in:M,F',
                'idpemilik'     => 'required|integer',
                'idras_hewan'   => 'required|integer',
            ]);

            DB::table('pet')->insert([
                'nama'          => $data['nama'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'warna_tanda'   => $data['warna_tanda'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'idpemilik'     => $data['idpemilik'],
                'idras_hewan'   => $data['idras_hewan'],
            ]);

            return back()->with('success', 'Pet berhasil didaftarkan.');
        })->name('registrasi-pet.store');
    });

    Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('pemilik', \App\Http\Controllers\Admin\PemilikController::class);
});

use App\Http\Controllers\Admin\JenisController;

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // ...route lain...

    Route::resource('jenis', JenisController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // ...route lain...

    Route::resource('kategori', KategoriController::class);
});


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // ... route lain ...
    Route::resource('kode-tindakan', KodeTindakanController::class);
});


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // ... route lain ...
    Route::resource('kategori-klinis', KategoriKlinisController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // ... route lain ...
    Route::get('role-user', [RoleUserController::class, 'index'])->name('role-user.index');
    Route::post('role-user/activate', [RoleUserController::class, 'activate'])->name('role-user.activate');
    Route::post('role-user/deactivate', [RoleUserController::class, 'deactivate'])->name('role-user.deactivate');
    Route::post('role-user/make-active', [RoleUserController::class, 'makeActive'])->name('role-user.makeActive');
    Route::post('role-user/add', [RoleUserController::class, 'add'])->name('role-user.add');
});


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // ... route lain ...
    Route::resource('user', UserController::class);
    Route::get('user/{id}/reset', [UserController::class, 'reset'])->name('user.reset');
});

use App\Http\Controllers\Dokter\RekamMedisController;

Route::prefix('dokter')->name('dokter.')->middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('dashboard', [RekamMedisController::class, 'dashboard'])->name('dashboard');
    Route::get('rekam-medis/create/{temuId}', [RekamMedisController::class, 'create'])->name('rekam-medis.create');
    Route::post('rekam-medis/store', [RekamMedisController::class, 'store'])->name('rekam-medis.store');
});

Route::prefix('dokter')->name('dokter.')->middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('dashboard', [RekamMedisController::class, 'dashboard'])->name('dashboard');
});


Route::prefix('dokter')->name('dokter.')->middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('dashboard', [RekamMedisController::class, 'dashboard'])->name('dashboard');
    Route::get('rekam-medis/create/{temuId}', [RekamMedisController::class, 'create'])->name('rekam-medis.create');
    Route::post('rekam-medis/store', [RekamMedisController::class, 'store'])->name('rekam-medis.store');
});

use App\Http\Controllers\TenagaMedisController;

Route::get('/dokter/create', [TenagaMedisController::class, 'createDokter'])->name('dokter.create');
Route::post('/dokter/store', [TenagaMedisController::class, 'storeDokter'])->name('dokter.store');

Route::get('/perawat/create', [TenagaMedisController::class, 'createPerawat'])->name('perawat.create');
Route::post('/perawat/store', [TenagaMedisController::class, 'storePerawat'])->name('perawat.store');

