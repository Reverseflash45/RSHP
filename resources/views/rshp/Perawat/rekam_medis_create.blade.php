<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Perawat | Buat Rekam Medis</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',Arial,sans-serif}
    body{background:#f4f6f9;min-height:100vh;display:flex;flex-direction:column;color:#333}
    .header{background:#fff;padding:16px 20px;text-align:center;border-bottom:2px solid #002080}
    nav{background:#f5b301;display:flex;gap:26px;justify-content:center;align-items:center;padding:13px 20px}
    nav a{color:#fff;text-decoration:none;font-weight:600;padding:6px 12px;border-radius:6px}
    nav a.active,nav a:hover{background:rgba(255,255,255,.16)}
    .container{flex:1;max-width:800px;margin:32px auto 40px;padding:0 16px}
    h2{color:#020381;margin-bottom:12px}
    .card{background:#fff;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,.05);padding:18px 20px}
    label{display:block;margin-bottom:4px;font-weight:600}
    textarea{width:100%;padding:9px 10px;border:1px solid #d1d5db;border-radius:6px;resize:vertical}
    .alert{margin-bottom:10px;padding:8px 12px;border-radius:6px;font-size:.88rem}
    .alert.ok{background:#ecfdf3;color:#027a48}
    .alert.err{background:#fef3f2;color:#b42318}
    .actions{display:flex;gap:10px;margin-top:10px}
    .btn{background:#f5b301;color:#fff;border:none;padding:8px 14px;border-radius:6px;font-weight:600;cursor:pointer}
    .btn:hover{background:#de9f00}
    .btn.outline{background:#fff;color:#020381;border:1px solid #d1d5db}
    .link-back{display:inline-block;margin-top:14px;text-decoration:none;color:#0f766e;font-weight:600}
    .meta{color:#4b5563;font-size:.88rem}
    footer{background:#020381;color:#fff;text-align:center;padding:20px;margin-top:auto}
    @media(max-width:600px){.actions{flex-direction:column}}
  </style>
</head>
<body>
  <div class="header">
    <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="RSHP" style="max-height:80px">
  </div>

  <nav>
    <a href="{{ url('/perawat') }}">Home</a>
    <a href="{{ url('/perawat/rekam-medis') }}">Rekam Medis</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
  </nav>

  <div class="container">
    <h2>Buat Rekam Medis</h2>

    <div class="card">
      {{-- info singkat pasien/reservasi, variabel dari controller --}}
      <p class="meta">
        <b>Reservasi:</b> #{{ $info['idtemu_dokter'] ?? '-' }}
        (No. {{ $info['no_urut'] ?? '-' }}) •
        <b>Waktu:</b> {{ $info['waktu_daftar'] ?? '-' }}<br>
        <b>Pet:</b> {{ $info['nama_pet'] ?? '-' }} •
        <b>Pemilik:</b> {{ $info['nama_pemilik'] ?? '-' }}
      </p>

      @if(!empty($err))
        <div class="alert err">{{ $err }}</div>
      @endif
      @if(!empty($msg))
        <div class="alert ok">{{ $msg }}</div>
      @endif

      <form method="POST" action="">
        @csrf
        <div style="margin-bottom:10px">
          <label for="anamnesa">Anamnesa</label>
          <textarea id="anamnesa" name="anamnesa" rows="3" required></textarea>
        </div>
        <div style="margin-bottom:10px">
          <label for="temuan_klinis">Temuan Klinis (opsional)</label>
          <textarea id="temuan_klinis" name="temuan_klinis" rows="3"></textarea>
        </div>
        <div style="margin-bottom:10px">
          <label for="diagnosa">Diagnosa</label>
          <textarea id="diagnosa" name="diagnosa" rows="3" required></textarea>
        </div>
        <div class="actions">
          <button type="submit" class="btn">Simpan Rekam Medis</button>
          <a href="{{ url('/perawat/rekam-medis') }}" class="btn outline">Batal</a>
        </div>
      </form>
    </div>

    <a class="link-back" href="{{ url('/perawat/rekam-medis') }}">← Kembali ke Daftar Rekam Medis</a>
  </div>

  <footer>
    <div>© {{ date('Y') }} Rumah Sakit Hewan Pendidikan - Universitas Airlangga</div>
    <small>All rights reserved.</small>
  </footer>
</body>
</html>
