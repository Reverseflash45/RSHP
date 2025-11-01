<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Registrasi Pet | Resepsionis RSHP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    *{box-sizing:border-box;margin:0;padding:0;font-family:Arial,Helvetica,sans-serif}
    body{background:#f8f9fa;min-height:100vh;display:flex;flex-direction:column}
    .header{background:#fff;padding:10px;text-align:center;border-bottom:3px solid #f5b301}
    .header img{max-height:80px}
    nav{background:#f5b301;display:flex;justify-content:center;gap:30px;padding:14px 20px}
    nav a{color:#fff;font-weight:bold;text-decoration:none;padding:8px 12px;border-radius:6px}
    nav a.active,nav a:hover{background:#e0a800}
    .content{max-width:700px;width:100%;margin:30px auto}
    .panel{background:#fff;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,.07);padding:24px}
    h2{margin-bottom:16px;color:#020381}
    label{display:block;margin:10px 0 4px;font-weight:bold}
    input,textarea,select{width:100%;padding:8px 10px;border:1px solid #d1d5db;border-radius:6px}
    .badge{display:inline-block;padding:4px 10px;border-radius:99px;font-size:.75rem;font-weight:bold;margin-bottom:10px}
    .badge.ok{background:#d1fae5;color:#065f46}
    .badge.err{background:#fee2e2;color:#b91c1c}
    .actions{margin-top:16px;display:flex;gap:12px}
    button,.btn-secondary{padding:9px 12px;border:none;border-radius:6px;font-weight:bold;cursor:pointer}
    button{background:#020381;color:#fff}
    .btn-secondary{background:#e5e7eb;color:#111;text-decoration:none;display:inline-flex;align-items:center}
    footer{background:#020381;color:#fff;text-align:center;padding:18px;margin-top:auto}
  </style>
</head>
<body>
  <div class="header">
    <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo RSHP">
  </div>

  <nav>
    <a href="{{ route('resepsionis.dashboard') }}">Home</a>
    <a href="{{ route('resepsionis.temu-dokter') }}">Temu Dokter</a>
    <a href="{{ route('resepsionis.registrasi-pemilik') }}">Registrasi Pemilik</a>
    <a class="active" href="{{ route('resepsionis.registrasi-pet') }}">Registrasi Pet</a>
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>
  </nav>

  <div class="content">
    <div class="panel">
      <h2>Registrasi Pet Baru</h2>

      @if(session('success'))
        <div class="badge ok">{{ session('success') }}</div>
      @endif
      @if($errors->any())
        <div class="badge err">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('resepsionis.registrasi-pet.store') }}">
        @csrf
        <label>Nama Pet</label>
        <input type="text" name="nama" value="{{ old('nama') }}" required>

        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">

        <label>Warna / Tanda</label>
        <input type="text" name="warna_tanda" value="{{ old('warna_tanda') }}">

        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin">
          <option value="M" {{ old('jenis_kelamin')=='M' ? 'selected' : '' }}>Jantan</option>
          <option value="F" {{ old('jenis_kelamin')=='F' ? 'selected' : '' }}>Betina</option>
        </select>

        <label>Pemilik</label>
        <select name="idpemilik" required>
          <option value="">— Pilih Pemilik —</option>
          @foreach($pemilik_list as $p)
            <option value="{{ $p->idpemilik }}" {{ old('idpemilik')==$p->idpemilik ? 'selected':'' }}>
              {{ $p->nama }} ({{ $p->email }})
            </option>
          @endforeach
        </select>

        <label>Ras Hewan</label>
        <select name="idras_hewan" required>
          <option value="">— Pilih Ras —</option>
          @foreach($ras_list as $r)
            <option value="{{ $r->idras_hewan }}" {{ old('idras_hewan')==$r->idras_hewan ? 'selected':'' }}>
              {{ $r->nama_ras }}{{ $r->nama_jenis_hewan ? ' - '.$r->nama_jenis_hewan : '' }}
            </option>
          @endforeach
        </select>

        <div class="actions">
          <button type="submit">Daftar</button>
          <a class="btn-secondary" href="{{ route('resepsionis.dashboard') }}">Batal</a>
        </div>
      </form>
    </div>
  </div>

  <footer>
    <h3>© {{ date('Y') }} Rumah Sakit Hewan Pendidikan - Universitas Airlangga</h3>
    <p>All rights reserved.</p>
  </footer>
</body>
</html>
