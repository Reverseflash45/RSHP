<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Temu Dokter | Resepsionis RSHP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    *{box-sizing:border-box;margin:0;padding:0;font-family:Arial,Helvetica,sans-serif}
    body{background:#f8f9fa;min-height:100vh;display:flex;flex-direction:column}
    .header{background:#fff;padding:10px;text-align:center;border-bottom:3px solid #f5b301}
    .header img{max-height:80px}
    nav{background:#f5b301;display:flex;justify-content:center;gap:30px;padding:14px 20px}
    nav a{color:#fff;font-weight:bold;text-decoration:none;padding:8px 12px;border-radius:6px}
    nav a.active,nav a:hover{background:#e0a800}
    .content{width:100%;max-width:1100px;margin:30px auto;display:flex;flex-direction:column;gap:30px}
    .panel{background:#fff;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,.06);padding:20px 24px}
    h2{margin-bottom:12px;color:#020381}
    form.row{display:flex;flex-wrap:wrap;gap:10px}
    select,button{padding:8px 10px;border:1px solid #ccc;border-radius:6px}
    button{background:#020381;color:#fff;cursor:pointer;font-weight:bold}
    button:hover{opacity:.9}
    table{width:100%;border-collapse:collapse;margin-top:14px}
    th,td{padding:10px;border-bottom:1px solid #e5e7eb;text-align:left}
    th{background:#f5b301;color:#fff}
    .badge{display:inline-block;padding:3px 10px;border-radius:99px;font-size:.75rem;font-weight:bold}
    .badge.ok{background:#d1fae5;color:#065f46}
    .badge.err{background:#fee2e2;color:#b91c1c}
    .badge.status-0{background:#e5edff;color:#113bb4}
    .badge.status-1{background:#d1fae5;color:#065f46}
    .badge.status-2{background:#fee2e2;color:#b91c1c}
    td.actions{display:flex;gap:8px}
    td.actions form{display:inline}
    footer{background:#020381;color:#fff;text-align:center;padding:18px;margin-top:auto}
  </style>
</head>
<body>
  <div class="header">
    <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo RSHP">
  </div>

  <nav>
    <a href="{{ route('resepsionis.dashboard') }}">Home</a>
    <a class="active" href="{{ route('resepsionis.temu-dokter') }}">Temu Dokter</a>
    <a href="{{ route('resepsionis.registrasi-pemilik') }}">Registrasi Pemilik</a>
    <a href="{{ route('resepsionis.registrasi-pet') }}">Registrasi Pet</a>
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
  </nav>

  <div class="content">

    <div class="panel">
      <h2>Tambah Antrian Temu Dokter</h2>

      @if(session('success'))
        <div class="badge ok">{{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div class="badge err">{{ session('error') }}</div>
      @endif

      <form class="row" method="POST" action="{{ route('resepsionis.temu-dokter.store') }}">
        @csrf
        <input type="hidden" name="act" value="add">

        <select name="idpet" required>
          <option value="">— Pilih Pet —</option>
          @foreach($allPets as $p)
            @if(in_array($p->idpet, $activePetIds ?? [])) @continue @endif
            <option value="{{ $p->idpet }}">
              {{ $p->nama_pet }} — Pemilik: {{ $p->nama_pemilik }}
            </option>
          @endforeach
        </select>

        <select name="idrole_user" required>
          <option value="">— Pilih Dokter —</option>
          @foreach($dokter as $d)
            <option value="{{ $d->idrole_user }}">{{ $d->nama_dokter }}</option>
          @endforeach
        </select>

        <button type="submit">Daftarkan</button>
      </form>
    </div>

    <div class="panel">
      <h2>Antrian Hari Ini</h2>
      <table>
        <thead>
          <tr>
            <th>No. Urut</th>
            <th>Waktu Daftar</th>
            <th>Pet</th>
            <th>Dokter</th>
            <th>Status</th>
            <th style="width:180px">Aksi</th>
          </tr>
        </thead>
        <tbody>
        @forelse($antrian as $row)
          @php
            $txt = $row->status == 0 ? 'Menunggu' : ($row->status == 1 ? 'Selesai' : 'Batal');
          @endphp
          <tr>
            <td>{{ $row->no_urut }}</td>
            <td>{{ $row->waktu_daftar }}</td>
            <td>{{ $row->nama_pet }}</td>
            <td>{{ $row->nama_dokter }}</td>
            <td><span class="badge status-{{ $row->status }}">{{ $txt }}</span></td>
            <td class="actions">
              <form method="POST" action="{{ route('resepsionis.temu-dokter.status') }}">
                @csrf
                <input type="hidden" name="idtemu" value="{{ $row->idtemu_dokter }}">
                <input type="hidden" name="status" value="1">
                <button type="submit">Selesai</button>
              </form>
              <form method="POST" action="{{ route('resepsionis.temu-dokter.status') }}"
                    onsubmit="return confirm('Batalkan antrian ini?')">
                @csrf
                <input type="hidden" name="idtemu" value="{{ $row->idtemu_dokter }}">
                <input type="hidden" name="status" value="2">
                <button type="submit" style="background:#b42318">Batal</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" style="text-align:center">Belum ada antrian.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <footer>
    <h3>© {{ date('Y') }} Rumah Sakit Hewan Pendidikan - Universitas Airlangga</h3>
    <p>All rights reserved.</p>
  </footer>
</body>
</html>
