<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Manajemen Role User</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial,sans-serif}
body{background:#f9f9f9;color:#111827}

.nav-atas{background:#f5b301}
.nav-atas .wrap{max-width:1100px;margin:0 auto;padding:12px 16px;display:flex;gap:16px;align-items:center}
.nav-atas a,.nav-atas button{color:#fff;font-weight:700;text-decoration:none;padding:6px 10px;border:none;background:transparent;cursor:pointer;border-radius:4px}
.nav-atas a:hover,.nav-atas button:hover{background:rgba(255,255,255,.2)}

.wrap{max-width:1100px;margin:26px auto;padding:0 16px}

table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,.08)}
th,td{border:1px solid #e5e7eb;padding:12px 14px;text-align:left;vertical-align:top}
th{background:#1f2937;color:#fff}
tbody tr:nth-child(even){background:#f8fafc}

.flash{margin-bottom:14px;padding:10px;border-radius:6px;font-weight:600}
.flash.ok{background:#d1f5d3;color:#2d7a2f}
.flash.err{background:#f9d6d5;color:#a33a36}

.role-box{display:flex;justify-content:space-between;gap:12px;align-items:center;background:#f1f5f9;border:1px solid #e2e8f0;border-radius:8px;padding:10px;margin:8px 0}
.badge{display:inline-block;padding:2px 8px;border-radius:999px;font-size:.8rem;margin-left:6px}
.badge.on{background:#dcfce7;color:#166534}
.badge.off{background:#fee2e2;color:#991b1b}
.actions{display:flex;gap:8px;flex-wrap:wrap}
.btn{border:none;border-radius:6px;padding:7px 12px;font-weight:700;cursor:pointer;transition:.18s}
.btn:hover{opacity:.92;transform:translateY(-1px)}
.btn-toggle-on{background:#e11d48;color:#fff}
.btn-toggle-off{background:#10b981;color:#fff}
.btn-make-active{background:#2563eb;color:#fff}
.btn-add{background:#2563eb;color:#fff}
select{padding:8px;border:1px solid #cbd5e1;border-radius:6px;background:#fff}

@media (max-width:800px){
    .role-box{flex-direction:column;align-items:stretch}
    .actions{justify-content:flex-start}
}
</style>
</head>
<body>

{{-- NAV --}}
<nav class="nav-atas">
<div class="wrap">
    <a href="{{ route('admin.dashboard') }}">Home</a>
    <a href="{{ route('admin.data-master') }}">Data Master</a>
    <form method="POST" action="{{ route('logout') }}" style="margin-left:auto">
    @csrf
    <button type="submit">Logout</button>
    </form>
</div>
</nav>

<div class="wrap">

{{-- Flash dari session (utama) --}}
@if(session('msg'))
    <div class="flash {{ session('type')==='success' ? 'ok' : 'err' }}">{{ session('msg') }}</div>
@endif

{{-- Tabel User & Role --}}
<table>
    <thead>
    <tr>
        <th style="width:90px">ID User</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Roles</th>
    </tr>
    </thead>
    <tbody>
    @forelse($users as $u)
        @php
        $uid   = is_array($u) ? $u['iduser'] : ($u->iduser ?? null);
        $unama = is_array($u) ? $u['nama']   : ($u->nama   ?? null);
        $uemail= is_array($u) ? $u['email']  : ($u->email  ?? null);
        $roles = is_array($u) ? ($u['roles'] ?? []) : ($u->roles ?? []);
        @endphp
        <tr>
        <td>{{ $uid }}</td>
        <td>{{ $unama }}</td>
        <td>{{ $uemail }}</td>
        <td>
            {{-- Daftar role milik user --}}
            @if(!empty($roles))
            @foreach($roles as $r)
                @php
                $idru  = is_array($r) ? $r['idrole_user'] : ($r->idrole_user ?? null);
                $idrole= is_array($r) ? $r['idrole']      : ($r->idrole ?? null);
                $nrole = is_array($r) ? $r['nama_role']   : ($r->nama_role ?? null);
                $stat  = (int) (is_array($r) ? $r['status'] : ($r->status ?? 0));
                @endphp
                <div class="role-box">
                <div>
                    <strong>{{ $nrole }}</strong>
                    @if($stat === 1)
                    <span class="badge on">Aktif</span>
                    @else
                    <span class="badge off">Tidak Aktif</span>
                    @endif
                </div>
                <div class="actions">
                    @if($stat === 1)
                    {{-- Nonaktifkan --}}
                    <form method="POST" action="{{ route('admin.role-user.deactivate') }}">
                        @csrf
                        <input type="hidden" name="idrole_user" value="{{ $idru }}">
                        <button type="submit" class="btn btn-toggle-on">Nonaktifkan</button>
                    </form>
                    @else
                    {{-- Aktifkan --}}
                    <form method="POST" action="{{ route('admin.role-user.activate') }}">
                        @csrf
                        <input type="hidden" name="idrole_user" value="{{ $idru }}">
                        <button type="submit" class="btn btn-toggle-off">Aktifkan</button>
                    </form>
                    @endif

                    {{-- Jadikan Role Aktif (menonaktifkan yang lain milik user ini) --}}
                    <form method="POST" action="{{ route('admin.role-user.makeActive') }}">
                    @csrf
                    <input type="hidden" name="idrole_user" value="{{ $idru }}">
                    <button type="submit" class="btn btn-make-active">Jadikan Role Aktif</button>
                    </form>
                </div>
                </div>
            @endforeach
            @else
            <em>Belum memiliki role</em>
            @endif

            {{-- Tambahkan role baru ke user --}}
            @if(!empty($role_options))
            <div style="margin-top:10px">
                <form method="POST" action="{{ route('admin.role-user.add') }}" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap">
                @csrf
                <input type="hidden" name="iduser" value="{{ $uid }}">
                <select name="idrole" required>
                    <option value="">— Pilih Role —</option>
                    @foreach($role_options as $opt)
                    @php
                        $rid = is_array($opt) ? $opt['idrole'] : ($opt->idrole ?? null);
                        $rnm = is_array($opt) ? $opt['nama_role'] : ($opt->nama_role ?? null);
                    @endphp
                    <option value="{{ $rid }}">{{ $rnm }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-add">Tambah Role</button>
                </form>
            </div>
            @endif

        </td>
        </tr>
    @empty
        <tr><td colspan="4" style="text-align:center"><em>Belum ada user.</em></td></tr>
    @endforelse
    </tbody>
</table>
</div>

</body>
</html>
