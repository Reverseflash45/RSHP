<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Perawat | Detail Rekam Medis</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',Arial,sans-serif}
    body{background:#f4f6f9;min-height:100vh;display:flex;flex-direction:column;color:#333}
    .header{background:#fff;padding:16px 20px;text-align:center;border-bottom:2px solid #002080}
    nav{background:#f5b301;display:flex;gap:26px;justify-content:center;align-items:center;padding:13px 20px}
    nav a{color:#fff;text-decoration:none;font-weight:600;padding:6px 12px;border-radius:6px}
    nav a.active,nav a:hover{background:rgba(255,255,255,.16)}
    .container{flex:1;max-width:1100px;margin:32px auto 40px;padding:0 16px;display:flex;flex-direction:column;gap:22px}
    h2{color:#020381;margin-bottom:4px}
    .meta{color:#4b5563;font-size:.9rem}
    .card{background:#fff;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,.05);padding:18px 20px}
    label{display:block;margin-bottom:4px;font-weight:600}
    textarea,input,select{width:100%;padding:8px 10px;border:1px solid #d1d5db;border-radius:6px;margin-bottom:10px}
    .actions{display:flex;gap:10px;margin-top:8px;flex-wrap:wrap}
    .btn{background:#f5b301;color:#fff;border:none;padding:7px 13px;border-radius:6px;font-weight:600;cursor:pointer}
    .btn:hover{background:#de9f00}
    .btn.ghost{background:#fff;color:#020381;border:1px solid #d1d5db}
    .btn.danger{background:#b42318}
    .btn.warn{background:#ea580c}
    .alert{padding:7px 10px;border-radius:6px;font-size:.85rem;margin-bottom:10px}
    .alert.ok{background:#ecfdf3;color:#027a48}
    .alert.err{background:#fef3f2;color:#b42318}
    table{width:100%;border-collapse:collapse;margin-top:10px}
    th,td{padding:8px 6px;border-bottom:1px solid #e5e7eb;font-size:.88rem}
    th{background:#fff7e5;color:#92400e;text-align:left}
    tr:nth-child(even){background:#fafafa}
    .inline-form{display:inline-block}
    .link-back{color:#0f766e;text-decoration:none;font-weight:600}
    .link-back:hover{text-decoration:underline}
    footer{background:#020381;color:#fff;text-align:center;padding:20px;margin-top:auto}
    @media(max-width:820px){
      table{display:block;overflow-x:auto}
      .actions{flex-direction:column;align-items:flex-start}
    }
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
    <h2>Detail Rekam Medis #{{ $idRekam ?? ($header['idrekam_medis'] ?? '') }}</h2>
    <p class="meta">
      <b>Pet:</b> {{ $header['nama_pet'] ?? '-' }}
      • <b>Pemilik:</b> {{ $header['nama_pemilik'] ?? '-' }}
    </p>

    @if(!empty($msg))
      <div class="alert {{ !empty($ok) && $ok==1 ? 'ok' : 'err' }}">{{ $msg }}</div>
    @endif

    {{-- HEADER RM --}}
    <div class="card">
      <form method="POST" action="">
        @csrf
        <input type="hidden" name="action" value="update_header">
        <label for="anamnesa">Anamnesa</label>
        <textarea id="anamnesa" name="anamnesa" rows="3">{{ $header['anamnesa'] ?? '' }}</textarea>

        <label for="temuan_klinis">Temuan Klinis</label>
        <textarea id="temuan_klinis" name="temuan_klinis" rows="3">{{ $header['temuan_klinis'] ?? '' }}</textarea>

        <label for="diagnosa">Diagnosa</label>
        <textarea id="diagnosa" name="diagnosa" rows="3">{{ $header['diagnosa'] ?? '' }}</textarea>

        <div class="actions">
          <button type="submit" class="btn warn">Simpan Header</button>
          <a href="{{ url('/perawat/rekam-medis') }}" class="btn ghost">Kembali</a>
        </div>
      </form>
    </div>

    {{-- DETAIL TINDAKAN --}}
    <div class="card">
      <h2 style="margin-top:0">Tindakan Terapi</h2>

      {{-- Tambah tindakan --}}
      <form method="POST" action="" style="margin: 6px 0 10px; display:flex; flex-wrap:wrap; gap:8px; align-items:center;">
        @csrf
        <input type="hidden" name="action" value="create_detail">
        <label for="idkode_tindakan_terapi" style="margin:0;font-weight:600;">Pilih Tindakan</label>
        <select id="idkode_tindakan_terapi" name="idkode_tindakan_terapi" required style="min-width:210px">
          <option value="">— pilih —</option>
          @foreach($listKode ?? [] as $k)
            <option value="{{ $k['idkode_tindakan_terapi'] }}">{{ $k['label'] }}</option>
          @endforeach
        </select>
        <input type="text" name="detail" placeholder="Catatan / Detail (opsional)" style="flex:1;min-width:220px">
        <button type="submit" class="btn">Tambah</button>
      </form>

      {{-- Tabel tindakan --}}
      @if(empty($detailTindakan))
        <p class="meta">Belum ada tindakan.</p>
      @else
        <table>
          <thead>
            <tr>
              <th>Kode</th>
              <th>Deskripsi</th>
              <th>Kategori</th>
              <th>Klinis</th>
              <th>Catatan</th>
              <th style="width:280px">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($detailTindakan as $row)
              <tr>
                <td>{{ $row['kode'] }}</td>
                <td>{{ $row['deskripsi_tindakan_terapi'] }}</td>
                <td>{{ $row['nama_kategori'] }}</td>
                <td>{{ $row['nama_kategori_klinis'] }}</td>
                <td>{{ $row['detail'] }}</td>
                <td>
                  {{-- form update --}}
                  <form method="POST" action="" style="display:inline-block;margin-bottom:6px;">
                    @csrf
                    <input type="hidden" name="action" value="update_detail">
                    <input type="hidden" name="iddetail" value="{{ $row['iddetail_rekam_medis'] }}">
                    <select name="idkode_tindakan_terapi" required>
                      @foreach($listKode ?? [] as $k)
                        <option value="{{ $k['idkode_tindakan_terapi'] }}" {{ $k['idkode_tindakan_terapi']==$row['idkode_tindakan_terapi'] ? 'selected' : '' }}>
                          {{ $k['label'] }}
                        </option>
                      @endforeach
                    </select>
                    <input type="text" name="detail" value="{{ $row['detail'] }}" placeholder="catatan">
                    <button type="submit" class="btn warn">Simpan</button>
                  </form>

                  {{-- form hapus --}}
                  <form method="POST" action="" style="display:inline-block" onsubmit="return confirm('Hapus tindakan ini?')">
                    @csrf
                    <input type="hidden" name="action" value="delete_detail">
                    <input type="hidden" name="iddetail" value="{{ $row['iddetail_rekam_medis'] }}">
                    <button type="submit" class="btn danger">Hapus</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>

    <a class="link-back" href="{{ url('/perawat/rekam-medis') }}">← Kembali ke Index</a>
  </div>

  <footer>
    <div>© {{ date('Y') }} Rumah Sakit Hewan Pendidikan - Universitas Airlangga</div>
    <small>All rights reserved.</small>
  </footer>
</body>
</html>
