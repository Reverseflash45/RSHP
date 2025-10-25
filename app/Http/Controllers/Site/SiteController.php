<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- penting untuk akses database

class SiteController extends Controller
{
    // Fungsi untuk halaman utama
    public function index()
    {
        return view('rshp.home');

    }

    // Fungsi untuk cek koneksi database
    public function cekKoneksi()
    {
        try {
            // Coba melakukan koneksi ke database
            DB::connection()->getPdo();
            return 'Koneksi ke database berhasil!!';
        } catch (\Exception $e) {
            // Jika gagal, tampilkan pesan error-nya
            return 'Koneksi ke database gagal: ' . $e->getMessage();
        }
    }
}
