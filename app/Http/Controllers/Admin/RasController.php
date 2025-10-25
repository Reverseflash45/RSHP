<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class RasController extends Controller
{
    public function index()
    {
        $daftarRas = [];
        // resources/views/rshp/admin/Ras Hewan/Index.blade.php
        return view('rshp.admin.Ras Hewan.Index', compact('daftarRas'));
    }
}
