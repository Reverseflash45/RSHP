<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PetController extends Controller
{
    public function index()
    {
        $rows = [];
        // resources/views/rshp/admin/Data Pet/Index.blade.php
        return view('rshp.admin.Data Pet.Index', compact('rows'));
    }
}
