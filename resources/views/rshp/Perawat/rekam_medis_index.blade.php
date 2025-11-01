<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Perawat | Rekam Medis</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',Arial,sans-serif}
    body{background:#f4f6f9;min-height:100vh;display:flex;flex-direction:column;color:#333}
    .header{background:#fff;padding:16px 20px;text-align:center;border-bottom:2px solid #002080}
    .header img{max-height:80px}
    nav{background:#f5b301;display:flex;gap:26px;justify-content:center;align-items:center;padding:13px 20px}
    nav a{color:#fff;text-decoration:none;font-weight:600;padding:6px 12px;border-radius:6px}
    nav a.active,nav a:hover{background:rgba(255,255,255,.16)}
    .container{flex:1;max-width:1100px;margin:32px auto 40px;padding:0 16px;display:flex;flex-direction:column;gap:26px}
    h2{color:#020381;margin-bottom:10px}
    .card{background:#fff;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,.05);padding:18px 20px}
    .muted{color:#6b7280}
    table{width:100%;border-collapse:collapse;margin-top:10px}
    th,td{padding:9px 8px;border-bottom:1px solid #e5e7eb;font-size:.9rem}
    th{background:#fff7e5;text-align:left;color:#92400e}
    tr:nth-child(even){background:#fafafa}
    a.btn-link{color:#0f766e;font-weight:600;text-decoration:none}
    a.btn-link:hover{text-decoration:underline}
    .link-back{display:inline-block;margin-top:10px;color:#0f766e;text-decoration:none;font-weight:600}
    .link-back:hover{text-decoration:underline}
    footer{background:#020381;color:#fff;text-align:center;padding:20px;margin-top:auto}
    @media(max-width:768px){
      table{display:block;overflow-x:auto}
      nav{flex-wrap:wrap}
    }
  </style>
</head>
<body>
  <div class="header">
    <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="RSHP">
  </div>

  <nav>
    <a href="{{ url('/perawat') }}">Home</a>
    <a href="{{ url('/perawat/rekam-medis') }}" class="active">Rekam Medis</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
  </nav>

  <div class="container">
    {{-- 1. Reservasi tanpa rekam medis --}}
    <div class="card">
      <h2>Reservasi tanpa Rekam Medis</h2>
      @if(empty($reservasi))
        <p class="muted">Tidak ada reservasi yang menunggu pembuatan rekam medis.</p>
      @else
        <table>
          <thead>
            <tr>
              <th>Reservasi</th>
              <th>Waktu Daftar</th>
              <th>Pet</th>
              <th>Pemilik</th>
              <th style="width:210px">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($reservasi as $r)
              <tr>
                <td>#{{ $r['idtemu_dokter'] }} (No.{{ $r['no_urut'] }})</td>
                <td>{{ $r['waktu_daftar'] }}</td>
                <td>{{ $r['nama_pet'] }}</td>
                <td>{{ $r['nama_pemilik'] }}</td>
                <td>
                  <a class="btn-link"
                     href="{{ url('/perawat/rekam-medis/create') }}?idtemu={{ $r['idtemu_dokter'] }}&idpet={{ $r['idpet'] }}&idrole_user={{ $r['idrole_user'] }}">
                     Buat Rekam Medis
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>

    {{-- 2. Rekam medis terbaru --}}
    <div class="card">
      <h2>Rekam Medis Terbaru</h2>
      @if(empty($listRM))
        <p class="muted">Belum ada rekam medis.</p>
      @else
        <table>
          <thead>
            <tr>
              <th style="width:90px">ID RM</th>
              <th style="width:160px">Created</th>
              <th>Pet</th>
              <th>Pemilik</th>
              <th>Dokter</th>
              <th>Anamnesa</th>
              <th>Diagnosa</th>
              <th style="width:130px">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($listRM as $rm)
              <tr>
                <td>#{{ $rm['idrekam_medis'] }}</td>
                <td>{{ $rm['created_at'] }}</td>
                <td>{{ $rm['nama_pet'] }}</td>
                <td>{{ $rm['nama_pemilik'] }}</td>
                <td>{{ $rm['nama_dokter'] ?? '-' }}</td>
                <td>{{ $rm['anamnesa'] }}</td>
                <td>{{ $rm['diagnosa'] }}</td>
                <td>
                  <a class="btn-link" href="{{ url('/perawat/rekam-medis/detail?id='.$rm['idrekam_medis']) }}">Detail</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>

    <a class="link-back" href="{{ url('/perawat') }}">← Kembali ke Dashboard Perawat</a>
  </div>

  <footer>
    <div>© {{ date('Y') }} Rumah Sakit Hewan Pendidikan - Universitas Airlangga</div>
    <small>All rights reserved.</small>
  </footer>
</body>
</html>
