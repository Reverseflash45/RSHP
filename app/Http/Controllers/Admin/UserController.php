<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $q    = trim((string) $request->get('q', ''));
        $sort = $request->get('sort', 'id');
        $dir  = $request->get('dir', 'asc');

        $sortMap = [
            'id'    => 'iduser',
            'nama'  => 'nama',
            'email' => 'email',
        ];

        if (! isset($sortMap[$sort])) {
            $sort = 'id';
        }

        $dir = strtolower($dir) === 'desc' ? 'desc' : 'asc';

        $list = User::query()
            ->when($q !== '', function ($w) use ($q) {
                $w->where('nama', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%");
            })
            ->orderBy($sortMap[$sort], $dir)
            ->orderBy('iduser')
            ->paginate(10)
            ->withQueryString();

        return view('rshp.admin.user.index', [
            'list' => $list,
            'q'    => $q,
            'sort' => $sort,
            'dir'  => $dir,
        ]);
    }

    public function create()
    {
        return view('rshp.admin.user.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'     => ['required', 'string', 'max:100'],
            'email'    => [
                'required',
                'email',
                'max:150',
                Rule::unique('user', 'email')->whereNull('deleted_at'),
            ],
            'password' => ['required', 'string', 'min:6'],
        ]);

        User::create([
            'nama'     => $data['nama'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('rshp.admin.user.edit', [
            'item' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'nama'     => ['required', 'string', 'max:100'],
            'email'    => [
                'required',
                'email',
                'max:150',
                Rule::unique('user', 'email')
                    ->ignore($user->iduser, 'iduser')
                    ->whereNull('deleted_at'),
            ],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        $payload = [
            'nama'  => $data['nama'],
            'email' => $data['email'],
        ];

        if (! empty($data['password'])) {
            $payload['password'] = bcrypt($data['password']);
        }

        $user->update($payload);

        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if (auth()->check()) {
            $user->deleted_by = auth()->id();
            $user->save();
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }

    public function reset($id)
    {
        $user = User::findOrFail($id);

        $user->password = bcrypt('password');
        $user->save();

        return back()->with('success', 'Password user berhasil di-reset ke: password');
    }
}
