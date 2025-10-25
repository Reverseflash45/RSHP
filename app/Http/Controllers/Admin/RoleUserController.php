<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function index()
    {
        $users = [];
        $role_options = [];
        // resources/views/rshp/admin/Menejemen Role/Index.blade.php
        return view('rshp.admin.Menejemen Role.Index', compact('users','role_options'));
    }

    public function add(Request $r)        { return back()->with('type','success')->with('msg','[stub] add role'); }
    public function activate(Request $r)   { return back()->with('type','success')->with('msg','[stub] activate role'); }
    public function deactivate(Request $r) { return back()->with('type','success')->with('msg','[stub] deactivate role'); }
    public function makeActive(Request $r) { return back()->with('type','success')->with('msg','[stub] make active'); }
}
