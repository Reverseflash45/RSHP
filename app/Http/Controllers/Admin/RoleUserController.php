<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleUserController extends Controller
{
    public function index(Request $request)
    {
        $q        = trim((string) $request->get('q', ''));
        $roleId   = $request->get('role');
        $status   = $request->get('status');

        $query = RoleUser::query()
            ->join('user', 'user.iduser', '=', 'role_user.iduser')
            ->join('role', 'role.idrole', '=', 'role_user.idrole')
            ->select(
                'role_user.idrole_user',
                'role_user.iduser',
                'role_user.idrole',
                'role_user.status',
                'user.nama',
                'user.email',
                'role.nama_role'
            );

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('user.nama', 'like', "%{$q}%")
                  ->orWhere('user.email', 'like', "%{$q}%");
            });
        }

        if ($roleId) {
            $query->where('role_user.idrole', $roleId);
        }

        if ($status !== null && $status !== '') {
            $query->where('role_user.status', (int) $status);
        }

        $list = $query
            ->orderBy('user.nama')
            ->orderBy('role.nama_role')
            ->paginate(15)
            ->withQueryString();

        $roles  = Role::orderBy('nama_role')->get();
        $users  = User::orderBy('nama')->get();

        return view('rshp.admin.role-user.index', [
            'list'   => $list,
            'roles'  => $roles,
            'users'  => $users,
            'q'      => $q,
            'roleId' => $roleId,
            'status' => $status,
        ]);
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'iduser' => ['required', 'integer', 'exists:user,iduser'],
            'idrole' => ['required', 'integer', 'exists:role,idrole'],
        ]);

        $exists = RoleUser::where('iduser', $data['iduser'])
            ->where('idrole', $data['idrole'])
            ->whereNull('deleted_at')
            ->first();

        if ($exists) {
            return back()->with('error', 'User tersebut sudah memiliki role ini.');
        }

        RoleUser::create([
            'iduser' => $data['iduser'],
            'idrole' => $data['idrole'],
            'status' => 1,
        ]);

        return back()->with('success', 'Role berhasil ditambahkan ke user.');
    }

    public function activate(Request $request)
    {
        $id = (int) $request->input('idrole_user');

        $row = RoleUser::find($id);
        if (! $row) {
            return back()->with('error', 'Data role user tidak ditemukan.');
        }

        $row->status = 1;
        $row->save();

        return back()->with('success', 'Role user berhasil diaktifkan.');
    }

    public function deactivate(Request $request)
    {
        $id = (int) $request->input('idrole_user');

        $row = RoleUser::find($id);
        if (! $row) {
            return back()->with('error', 'Data role user tidak ditemukan.');
        }

        $row->status = 0;
        $row->save();

        return back()->with('success', 'Role user berhasil dinonaktifkan.');
    }

    public function makeActive(Request $request)
    {
        $id = (int) $request->input('idrole_user');

        $row = RoleUser::find($id);
        if (! $row) {
            return back()->with('error', 'Data role user tidak ditemukan.');
        }

        DB::transaction(function () use ($row) {
            RoleUser::where('iduser', $row->iduser)
                ->update(['status' => 0]);

            $row->status = 1;
            $row->save();
        });

        return back()->with('success', 'Role ini dijadikan role aktif utama untuk user tersebut.');
    }

    public function delete(Request $request)
    {
        $id = (int) $request->input('idrole_user');

        $row = RoleUser::find($id);
        if (! $row) {
            return back()->with('error', 'Data role user tidak ditemukan.');
        }

        if (auth()->check()) {
            $row->deleted_by = auth()->id();
            $row->save();
        }

        $row->delete();

        return back()->with('success', 'Role user berhasil dihapus (soft delete).');
    }
}
