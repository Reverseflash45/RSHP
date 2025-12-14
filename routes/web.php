<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
use App\Http\Controllers\Admin\JenisController;

// Dokter
use App\Http\Controllers\Dokter\RekamMedisController;

// Perawat
use App\Http\Controllers\Perawat\PerawatController;

// Tenaga Medis
use App\Http\Controllers\TenagaMedisController;

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
| DASHBOARD UMUM
|--------------------------------------------------------------------------
*/
Route::get('/home', [HomeController::class, 'index'])->name('home');


/* =========================================================
|  ROLE 1 — ADMIN (role = 1)
|========================================================= */
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
        Route::post('role-user/delete',      [RoleUserController::class, 'delete'])->name('role-user.delete');

        Route::resource('jenis-hewan',     JenisHewanController::class);
        Route::resource('ras',             RasController::class);
        Route::resource('pemilik',         PemilikController::class);
        Route::resource('pet',             PetController::class);
        Route::resource('kategori',        KategoriController::class);
        Route::resource('kategori-klinis', KategoriKlinisController::class);
        Route::resource('kode-tindakan',   KodeTindakanController::class);

        Route::resource('jenis', JenisController::class);
    });
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/user', [UserController::class, 'index'])
        ->name('user.index');

    Route::post('/user/{iduser}/reset', [UserController::class, 'reset'])
        ->name('user.reset');

    Route::delete('/user/{iduser}', [UserController::class, 'destroy'])
        ->name('user.destroy');

});

/* =========================================================
|  ROLE 2 — DOKTER (role = 2)
|========================================================= */
Route::middleware(['auth', 'isDokter'])
    ->prefix('dokter')
    ->name('dokter.')
    ->group(function () {

        Route::get('/', [RekamMedisController::class, 'dashboard'])->name('dashboard');

        Route::get('/temu-dokter', [RekamMedisController::class, 'temuDokter'])->name('temu-dokter');

        Route::get('/rekam-medis', [RekamMedisController::class, 'rekamMedis'])->name('rekam-medis');

        Route::get('/rekam-medis/create/{temuId}', [RekamMedisController::class, 'create'])->name('rekam-medis.create');

        Route::post('/rekam-medis/store', [RekamMedisController::class, 'store'])->name('rekam-medis.store');

        // ===========================================
        // ROUTES TRANSAKSI DOKTER - BARU
        // ===========================================
        Route::prefix('transaksi')->name('transaksi.')->group(function () {
            Route::get('/', [RekamMedisController::class, 'transaksiIndex'])->name('index');
            Route::get('/create', [RekamMedisController::class, 'transaksiCreate'])->name('create');
            Route::post('/store', [RekamMedisController::class, 'transaksiStore'])->name('store');
            Route::get('/{id}', [RekamMedisController::class, 'transaksiDetail'])->name('detail');
        });
    });

/* =========================================================
|  ROLE 3 — PERAWAT (role = 3)
|========================================================= */
Route::middleware(['auth', 'isPerawat'])
    ->prefix('perawat')
    ->name('perawat.')
    ->group(function () {

        Route::get('/', [PerawatController::class, 'dashboard'])->name('dashboard');

        // ... routes rekam medis yang sudah ada ...

        Route::get('/rekam-medis', [PerawatController::class, 'rekamMedisIndex'])
            ->name('rekam-medis.index');

        Route::get('/rekam-medis/create', [PerawatController::class, 'rekamMedisCreate'])
            ->name('rekam-medis.create');

        Route::post('/rekam-medis/store', [PerawatController::class, 'rekamMedisStore'])
            ->name('rekam-medis.store');

        Route::get('/rekam-medis/{id}', [PerawatController::class, 'rekamMedisDetail'])
            ->whereNumber('id')
            ->name('rekam-medis.detail');

        Route::post('/rekam-medis/{id}/header', [PerawatController::class, 'rekamMedisUpdateHeader'])
            ->whereNumber('id')
            ->name('rekam-medis.header.update');

        Route::post('/rekam-medis/{id}/detail/add', [PerawatController::class, 'detailAdd'])
            ->whereNumber('id')
            ->name('rekam-medis.detail.add');

        Route::post('/rekam-medis/{id}/detail/update', [PerawatController::class, 'detailUpdate'])
            ->whereNumber('id')
            ->name('rekam-medis.detail.update');

        Route::post('/rekam-medis/{id}/detail/delete', [PerawatController::class, 'detailDelete'])
            ->whereNumber('id')
            ->name('rekam-medis.detail.delete');

        // ===========================================
        // TAMBAHKAN ROUTES TRANSAKSI DI SINI
        // ===========================================
        
        // Group untuk transaksi
        Route::prefix('transaksi')->name('transaksi.')->group(function () {
            Route::get('/', [PerawatController::class, 'transaksiIndex'])->name('index');
            Route::get('/create', [PerawatController::class, 'transaksiCreate'])->name('create');
            Route::post('/store', [PerawatController::class, 'transaksiStore'])->name('store');
            Route::get('/{id}', [PerawatController::class, 'transaksiDetail'])
                ->whereNumber('id')
                ->name('detail');
            Route::post('/{id}/update', [PerawatController::class, 'transaksiUpdate'])
                ->whereNumber('id')
                ->name('update');
            Route::post('/{id}/delete', [PerawatController::class, 'transaksiDelete'])
                ->whereNumber('id')
                ->name('delete');
            Route::post('/{id}/bayar', [PerawatController::class, 'transaksiBayar'])
                ->whereNumber('id')
                ->name('bayar');
        });
    });

/* =========================================================
|  ROLE 4 — RESEPSIONIS (role = 4)
|========================================================= */
Route::middleware(['auth','isResepsionis'])
    ->prefix('resepsionis')
    ->name('resepsionis.')
    ->group(function () {

        // Dashboard (sesuai file yang kamu punya: resources/views/rshp/resepsionis/dashboard.blade.php)
        Route::view('/', 'rshp.resepsionis.dashboard')->name('dashboard');

        // ==============
        // TEMU DOKTER
        // ==============
        Route::get('/temu-dokter', function () {

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

            $activePetIds = DB::table('temu_dokter')
                ->whereDate('waktu_daftar', today())
                ->pluck('idpet')
                ->toArray();

            $dokter = DB::table('role_user as ru')
                ->join('role as r', 'r.idrole', '=', 'ru.idrole')
                ->join('user as u', 'u.iduser', '=', 'ru.iduser')
                ->where('r.nama_role', 'Dokter')
                ->where('ru.status', 1)
                ->select('ru.idrole_user', 'u.nama as nama_dokter')
                ->orderBy('u.nama')
                ->get();

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

            return view('rshp.resepsionis.edit_temudokter', [
                'allPets'      => $allPets,
                'activePetIds' => $activePetIds,
                'dokter'       => $dokter,
                'antrian'      => $antrian,
            ]);
        })->name('temu-dokter');

        Route::post('/temu-dokter', function (Request $request) {
            $data = $request->validate([
                'idpet'       => 'required|integer',
                'idrole_user' => 'required|integer',
                'act'         => 'nullable|string',
            ]);

            if (($data['act'] ?? '') === 'add') {
                $lastNo = DB::table('temu_dokter')
                    ->whereDate('waktu_daftar', today())
                    ->max('no_urut');

                $nextNo = (int)$lastNo + 1;

                DB::table('temu_dokter')->insert([
                    'idpet'        => $data['idpet'],
                    'idrole_user'  => $data['idrole_user'],
                    'no_urut'      => $nextNo,
                    'status'       => 0,
                    'waktu_daftar' => now(),
                ]);

                return back()->with('success', 'Pendaftaran berhasil. No. Urut: ' . $nextNo);
            }

            return back();
        })->name('temu-dokter.store');

        Route::post('/temu-dokter/status', function (Request $request) {
            $data = $request->validate([
                'idtemu' => 'required|integer',
                'status' => 'required|integer|in:1,2',
            ]);

            DB::table('temu_dokter')
                ->where('idtemu_dokter', $data['idtemu'])
                ->update(['status' => $data['status']]);

            return back()->with('success', 'Status antrian diperbarui.');
        })->name('temu-dokter.status');

        // ==================
        // REGISTRASI PEMILIK
        // ==================
        Route::get('/registrasi-pemilik', function () {
            return view('rshp.resepsionis.registrasi_pemilik');
        })->name('registrasi-pemilik');

        Route::post('/registrasi-pemilik', function (Request $request) {
            $data = $request->validate([
                'nama'     => 'required|string|max:100',
                'email'    => 'required|email|max:150',
                'password' => 'required|string|min:3',
                'no_wa'    => 'required|string|max:50',
                'alamat'   => 'required|string',
            ]);

            $userId = DB::table('user')->insertGetId([
                'nama'           => $data['nama'],
                'email'          => $data['email'],
                'password'       => bcrypt($data['password']),
                'remember_token' => null,
            ]);

            DB::table('pemilik')->insert([
                'iduser' => $userId,
                'no_wa'  => $data['no_wa'],
                'alamat' => $data['alamat'],
            ]);

            DB::table('role_user')->insert([
                'iduser' => $userId,
                'idrole' => 5,
                'status' => 1,
            ]);

            return back()->with('success', 'Pemilik berhasil didaftarkan.');
        })->name('registrasi-pemilik.store');

        // =============
        // REGISTRASI PET
        // =============
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

            return view('rshp.resepsionis.registrasi_pet', [
                'pemilik_list' => $pemilik,
                'ras_list'     => $ras,
            ]);
        })->name('registrasi-pet');

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


/* =========================================================
|  ROLE 5 — PEMILIK (role = 5)
|========================================================= */
Route::middleware(['auth','isPemilik'])
    ->prefix('pemilik')
    ->name('pemilik.')
    ->group(function () {

        Route::view('/', 'rshp.Pemilik.Dashboard')->name('dashboard');
        Route::view('/data-pet', 'rshp.Pemilik.data-pet')->name('data-pet');
        Route::view('/rekam-medis', 'rshp.Pemilik.rekam-medis')->name('rekam-medis');
    });


/* =========================================================
|  TENAGA MEDIS (FORM CREATE) - BIARIN TETEP
|========================================================= */
Route::get('/dokter/create', [TenagaMedisController::class, 'createDokter'])->name('dokter.create');
Route::post('/dokter/store', [TenagaMedisController::class, 'storeDokter'])->name('dokter.store');

Route::get('/perawat/create', [TenagaMedisController::class, 'createPerawat'])->name('perawat.create');
Route::post('/perawat/store', [TenagaMedisController::class, 'storePerawat'])->name('perawat.store');

