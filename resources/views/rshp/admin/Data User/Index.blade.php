<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Halaman Admin - Data User</title>
<meta name="description" content="Halaman Admin RSHP Unair">
<meta name="keywords" content="RSHP Unair, Halaman Admin">
<meta name="author" content="Marsha">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial,sans-serif}
body{background:#f9f9f9;color:#111827}

/* Nav atas */
.nav-atas{background:#f5b301}
.nav-atas .wrap{max-width:1100px;margin:0 auto;padding:12px 16px;display:flex;gap:16px;align-items:center}
.nav-atas a,.nav-atas button{color:#fff;font-weight:700;text-decoration:none;padding:6px 10px;border:none;background:transparent;cursor:pointer;border-radius:4px}
.nav-atas a:hover,.nav-atas button:hover{background:rgba(255,255,255,.2)}

/* Container */
.container{max-width:1100px;margin:28px auto;padding:0 16px}

/* Header actions */
.button-container{display:flex;gap:10px;justify-content:space-between;align-items:center;margin-bottom:12px}
.btn{display:inline-block;padding:9px 14px;border-radius:6px;font-weight:700;text-decoration:none;border:none;cursor:pointer;transition:.18s}
.btn:hover{opacity:.92;transform:translateY(-1px)}
.btn.kembali{background:#e2e8f0;color:#0f172a}
.btn.tambah-user{background:#2563eb;color:#fff}

/* Flash */
.alert{margin:12px 0;padding:10px;border-radius:6px;font-weight:600}
.ok{background:#d1f5d3;color:#2d7a2f}
.err{background:#f9d6d5;color:#a33a36}

/* Table */
table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 2px 6px rgba(0,0,0,.08)}
th,td{border:1px solid #e5e7eb;padding:12px 14px;text-align:left;vertical-align:middle}
th{background:#1f2937;color:#fff}
tbody tr:nth-child(even){background:#f8fafc}
.aksi a,.aksi form{display:inline-block}
.aksi .btn{padding:7px 12px}
.btn.edit{background:#f59e0b;color:#fff}
.btn.reset{background:#dc2626;color:#fff}

/* Footer */
footer{background:#020381;color:#fff;text-align:center;padding:16px;margin-top:28px}
footer h3{margin-bottom:6px}

/* Responsive */
@media(max-width:800px){
    .button-container{flex-direction:column;align-items:stretch}
    .aksi .btn{margin-top:6px}
}
</style>
</head>
<body>

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

<div class="container">
    <div class="button-container">
        <a href="{{ route('admin.data-master') }}" class="btn kembali">Kembali</a>
        <a href="{{ route('admin.user.create') }}" class="btn tambah-user">Tambah User</a>
    </div>

    @if (session('msg'))
        <div class="alert {{ session('type')==='success' ? 'ok' : 'err' }}">{{ session('msg') }}</div>
    @endif

    <table>
        <thead>
        <tr>
            <th style="width:140px">ID User</th>
            <th>Nama</th>
            <th>Email</th>
            <th style="width:320px">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @php
            // Normalisasi supaya aman untuk array / collection / paginator / object model lama
            $rows = $list ?? $users ?? [];
        @endphp

        @forelse ($rows as $u)
            @php
                // Tarik field dengan fallback berbagai bentuk data
                $id    = $u->iduser  ?? $u['iduser']  ?? (method_exists($u,'get_user') ? ($u->get_user()['iduser'] ?? null) : null);
                $nama  = $u->nama    ?? $u['nama']    ?? (method_exists($u,'get_user') ? ($u->get_user()['nama']   ?? null) : null);
                $email = $u->email   ?? $u['email']   ?? (method_exists($u,'get_user') ? ($u->get_user()['email']  ?? null) : null);
            @endphp
            <tr>
                <td>{{ $id }}</td>
                <td>{{ $nama }}</td>
                <td>{{ $email }}</td>
                <td class="aksi">
                    <a class="btn edit"  href="{{ route('admin.user.edit', $id) }}">Edit</a>
                    {{-- Link reset sesuai yang kamu pakai (GET). Jika nanti mau POST, ganti ke form POST. --}}
                    <a class="btn reset" href="{{ route('admin.user.reset', $id) }}">Reset Password</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" style="text-align:center">Tidak ada data user</td></tr>
        @endforelse
        </tbody>
    </table>

    {{-- Pagination: cek dengan instanceof, bukan method_exists --}}
    @php
        $isPaginator =
            $rows instanceof \Illuminate\Contracts\Pagination\Paginator ||
            $rows instanceof \Illuminate\Pagination\LengthAwarePaginator ||
            $rows instanceof \Illuminate\Pagination\Paginator;
    @endphp
    @if($isPaginator)
        <div style="margin-top:14px">
            {{ $rows->links() }}
        </div>
    @endif
</div>

<footer>
    <h3>© {{ now()->year }} Rumah Sakit Hewan Pendidikan - Universitas Airlangga</h3>
    <p>All rights reserved.</p>
</footer>

</body>
</html>
