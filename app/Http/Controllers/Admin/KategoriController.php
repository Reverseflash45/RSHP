<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index()
    {
        $list = [];
        // resources/views/rshp/admin/Data Kategori/Index.blade.php
        return view('rshp.admin.Data Kategori.Index', compact('list'));
    }
}
