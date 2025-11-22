<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Dokter | RSHP UNAIR</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f9;
      margin: 0;
      padding-bottom: 60px;
    }
    .navbar {
      background-color: #0c5b2c;
      padding: 12px 24px;
    }
    .navbar-brand {
      color: #fff;
      font-weight: 600;
      font-size: 1.1rem;
    }
    .nav-link {
      color: #fff !important;
      font-weight: 500;
    }
    .greeting {
      margin: 30px 0;
      text-align: left;
    }
    .greeting h2 {
      font-size: 1.8rem;
      font-weight: 600;
      color: #0c5b2c;
      margin-bottom: 8px;
    }
    .greeting p {
      font-size: 1rem;
      color: #555;
    }
    .section-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.06);
      padding: 24px;
      margin-bottom: 30px;
    }
    .section-card h3 {
      font-size: 1.3rem;
      font-weight: 600;
      color: #0c5b2c;
      margin-bottom: 20px;
    }
    .table th {
      background-color: #f5b301;
      color: #fff;
      font-size: 0.95rem;
    }
    .table td {
      font-size: 0.9rem;
    }
    .btn-transaksi {
      background-color: #0c5b2c;
      color: #fff;
      font-weight: 500;
      padding: 6px 12px;
      border-radius: 6px;
    }
    .btn-transaksi:hover {
      background-color: #094a24;
    }
    footer {
      position: fixed;
      bottom: 0;
      width: 100%;
      background: #0c5b2c;
      color: #fff;
      text-align: center;
      padding: 12px;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

<nav class="navbar d-flex justify-content-between">
  <span class="navbar-brand">RSHP Dokter</span>
  <a class="nav-link" href="{{ route('logout') }}"
     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
  </form>
</nav>

<div class="container py-4">

  {{-- Greeting --}}
  <div class="greeting">
    <h2>Halo, {{ auth()->user()->nama ?? 'Dokter' }}</h2>
    <p>Selamat datang di halaman dokter RSHP Universitas Airlangga. Semua transaksi hari ini ada di bawah.</p>
  </div>

  {{-- Temu Dokter Hari Ini --}}
  <div class="section-card">
    <h3>Temu Dokter Hari Ini</h3>
    @if(empty($temuDokter) || $temuDokter->isEmpty())
      <p class="text-muted">Tidak ada jadwal hari ini.</p>
    @else
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Waktu</th>
              <th>Pet</th>
              <th>Pemilik</th>
              <th>Status</th>
              <th>Transaksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($temuDokter as $row)
              <tr>
                <td>#{{ $row->idtemu_dokter }}</td>
                <td>{{ $row->waktu_daftar }}</td>
                <td>{{ $row->nama_pet }}</td>
                <td>{{ $row->nama_pemilik }}</td>
                <td>{{ $row->status }}</td>
                <td>
                  <a href="{{ route('dokter.rekam-medis.create', $row->idtemu_dokter) }}"
                     class="btn btn-transaksi btn-sm">+ Rekam Medis</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>

  {{-- Rekam Medis --}}
  <div class="section-card">
    <h3>Rekam Medis oleh Saya</h3>
    @if(empty($rekamMedis) || $rekamMedis->isEmpty())
      <p class="text-muted">Belum ada rekam medis.</p>
    @else
      @foreach($rekamMedis as $rm)
        @php $anak = $listTindakan[$rm->idrekam_medis] ?? []; @endphp
        <div class="mb-4 p-3 border rounded bg-light">
          <h5 class="mb-2">RM #{{ $rm->idrekam_medis }} — {{ $rm->nama_pet }} ({{ $rm->nama_pemilik }})</h5>
          <p><b>Tanggal:</b> {{ $rm->created_at }}</p>
          <p><b>Anamnesa:</b> {{ $rm->anamnesa }}</p>
          <p><b>Diagnosa:</b> {{ $rm->diagnosa }}</p>

          @if(!empty($anak))
            <table class="table table-sm table-bordered mt-2">
              <thead>
                <tr>
                  <th>Kode</th>
                  <th>Deskripsi</th>
                  <th>Kategori</th>
                  <th>Klinis</th>
                </tr>
              </thead>
              <tbody>
                @foreach($anak as $td)
                  <tr>
                    <td>{{ $td->kode }}</td>
                    <td>{{ $td->deskripsi_tindakan_terapi }}</td>
                    <td>{{ $td->nama_kategori }}</td>
                    <td>{{ $td->nama_kategori_klinis }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <p><i>Tidak ada tindakan terapi untuk rekam medis ini.</i></p>
          @endif
        </div>
      @endforeach
    @endif
  </div>

  {{-- Transaksi Dokter Hari Ini --}}
  <div class="section-card">
    <h3>Transaksi Saya Hari Ini</h3>
    @if(empty($transaksiDokter) || $transaksiDokter->isEmpty())
      <p class="text-muted">Belum ada transaksi hari ini.</p>
    @else
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID Transaksi</th>
              <th>Pet</th>
              <th>Pemilik</th>
              <th>Jenis</th>
              <th>Deskripsi</th>
              <th>Waktu</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transaksiDokter as $trx)
              <tr>
                <td>#{{ $trx->idtransaksi }}</td>
                <td>{{ $trx->nama_pet }}</td>
                <td>{{ $trx->nama_pemilik }}</td>
                <td>{{ $trx->jenis_transaksi }}</td>
                <td>{{ $trx->deskripsi }}</td>
                <td>{{ $trx->created_at }}</td>
                <td>
                  <a href="{{ route('dokter.transaksi.edit', $trx->idtransaksi) }}" class="btn btn-transaksi btn-sm">Edit</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>

</div>

<footer>
  © {{ date('Y') }} RSHP Universitas Airlangga — Halaman Dokter
</footer>

</body>
</html>