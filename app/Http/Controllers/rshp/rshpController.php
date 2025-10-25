<?php

namespace App\Http\Controllers\rshp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class rshpController extends Controller
{
    public function index()
    {
        return view('rshp.home');
    }
}
