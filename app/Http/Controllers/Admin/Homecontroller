<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Optional: jika login flow-mu belum menyetok role ke session
        if (! session()->has('user_role_name')) {
            $activeRole = optional(auth()->user()->roles()->wherePivot('status', 1)->first());
            session()->put('user_role_name', $activeRole->nama_role ?? 'User');
        }

        return view('home');
    }
}
