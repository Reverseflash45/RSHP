<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $list = [];
        // resources/views/rshp/admin/Data Kategori Klinis/Index.blade.php
        return view('rshp.admin.Data Kategori Klinis.Index', compact('list'));
    }
}
