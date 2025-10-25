<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // sementara: kosongkan dulu, atau ganti ambil dari modelmu
        $list = []; // atau paginator dari model User-mu

        // PERHATIKAN path view-nya sesuai foldermu "Data User/index.blade.php"
        return view('rshp.admin.Data User.index', compact('list'));
    }

    public function create()
    {
        return view('rshp.admin.Data User.create'); // bikin nanti kalau dibutuhkan
    }

    public function edit($id)
    {
        return view('rshp.admin.Data User.edit', compact('id')); // bikin nanti kalau dibutuhkan
    }

    public function reset($id)
    {
        // logika reset password-mu di sini (GET sesuai link sekarang)
        // lalu redirect balik dengan flash
        return redirect()
            ->route('admin.user.index')
            ->with('type','success')
            ->with('msg',"Password user #{$id} di-reset (dummy).");
    }
}
