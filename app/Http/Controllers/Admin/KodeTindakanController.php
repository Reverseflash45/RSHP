<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class KodeTindakanController extends Controller
{
    public function index()
    {
        $list = [];
        // resources/views/rshp/admin/Data Kode Tindakan Terapi/Index.blade.php
        return view('rshp.admin.Data Kode Tindakan Terapi.Index', compact('list'));
    }
}
