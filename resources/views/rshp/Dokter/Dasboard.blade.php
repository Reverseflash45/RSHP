{{-- resources/views/rshp/dokter/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Dokter | RSHP UNAIR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .header {
            background-color: #ffffff;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 2px solid #002080;
        }
        .header img {
            max-height: 85px;
            width: auto;
            display: block;
        }
        nav {
            background-color: #f5b301;
            padding: 15px;
            display: flex;
            justify-content: center;
            gap: 40px;
            box-shadow: 0 2px 8px rgba(0,0,0,.1);
        }
        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 1rem;
        }
        nav a:hover { color: #ff9900; }

        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px 20px;
            gap: 40px;
        }
        .welcome-box {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px #0000001a;
            text-align: center;
            max-width: 700px;
            width: 100%;
        }
        .welcome-box h2 { color: #0c5b2c; margin-bottom: 10px; }
        .section {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px #0000001a;
            width: 100%;
            max-width: 1000px;
        }
        .section h2 {
            color: #0c5b2c;
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .table-container { overflow-x: auto; margin-top: 15px; }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: .95rem;
        }
        th, td {
            padding: 12px 10px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #f5b301;
            color: #fff;
        }
        tr:nth-child(even) { background: #fafafa; }
        tr:hover { background: #eef5ff; }
        .detail-link { color: #002080; font-weight: bold; text-decoration: none; }
        .detail-link:hover { text-decoration: underline; }

        .card {
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            padding: 18px;
            margin-bottom: 16px;
            background: #fff;
        }
        .alert {
            background: #ffe5e5;
            border: 1px solid #ffbdbd;
            color: #a30000;
            padding: 10px 14px;
            border-radius: 8px;
            max-width: 800px;
            width: 100%;
            margin: 0 auto;
            text-align: center;
        }
        footer {
            background: rgb(2,3,129);
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 14px;
            line-height: 1.6;
            margin-top: auto;
        }
        footer h3 { margin: 0 0 10px; }

        @media (max-width: 768px) {
            .header { flex-direction: column; gap: 10px; }
            nav { flex-wrap: wrap; gap: 20px; }
            .section { padding: 20px; }
            table th, table td { font-size: .85rem; }
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp"
             alt="Logo Universitas Airlangga RSHP">
    </div>

    {{-- NAVBAR --}}
    <nav>
        <a href="{{ route('dokter.dashboard') }}">Home</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </nav>

    {{-- CONTENT --}}
    <div class="content">
        @if(!empty($error))
            <div class="alert">{{ $error }}</div>
        @else
            <div class="welcome-box">
                <h2>Halo, {{ $dokterName ?? (auth()->user()->nama ?? 'Dokter') }}!</h2>
                <p>Selamat datang di halaman dokter RSHP Universitas Airlangga.</p>
            </div>

            {{-- TEMU DOKTER HARI INI --}}
            <div class="section">
                <h2>Temu Dokter Hari Ini</h2>

                @php $temu = $temuDokter ?? []; @endphp

                @if(empty($temu))
                    <p style="text-align:center;">Tidak ada jadwal hari ini.</p>
                @else
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>No. Urut</th>
                                    <th>Waktu Daftar</th>
                                    <th>Nama Pet</th>
                                    <th>Pemilik</th>
                                    <th>Status</th>
                                    <th>Rekam Medis</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($temu as $row)
                                @php
                                    $rmId = $row->idrekam_medis ?? $row['idrekam_medis'] ?? null;
                                @endphp
                                <tr>
                                    <td>#{{ $row->idtemu_dokter ?? $row['idtemu_dokter'] }}</td>
                                    <td>{{ $row->no_urut ?? $row['no_urut'] }}</td>
                                    <td>{{ $row->waktu_daftar ?? $row['waktu_daftar'] }}</td>
                                    <td>{{ $row->nama_pet ?? $row['nama_pet'] }}</td>
                                    <td>{{ $row->nama_pemilik ?? $row['nama_pemilik'] }}</td>
                                    <td>{{ $row->status ?? $row['status'] }}</td>
                                    <td>
                                        @if($rmId)
                                            <a href="{{ url('perawat/rekam-medis-detail/'.$rmId) }}" class="detail-link">Lihat Detail</a>
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- REKAM MEDIS --}}
            <div class="section">
                <h2>Rekam Medis oleh Saya</h2>

                @php
                    $rmList   = $rekamMedis ?? [];
                    $tindakan = $listTindakan ?? [];
                @endphp

                @if(empty($rmList))
                    <p style="text-align:center;">Belum ada rekam medis.</p>
                @else
                    @foreach($rmList as $rm)
                        @php
                            $idRM = $rm->idrekam_medis ?? $rm['idrekam_medis'];
                            $anak = $tindakan[$idRM] ?? [];
                        @endphp
                        <div class="card">
                            <h3>RM #{{ $idRM }} — {{ $rm->nama_pet ?? $rm['nama_pet'] }} ({{ $rm->nama_pemilik ?? $rm['nama_pemilik'] }})</h3>
                            <p><b>Tanggal:</b> {{ $rm->created_at ?? $rm['created_at'] }}</p>
                            <p><b>Anamnesa:</b> {{ $rm->anamnesa ?? $rm['anamnesa'] }}</p>
                            <p><b>Diagnosa:</b> {{ $rm->diagnosa ?? $rm['diagnosa'] }}</p>

                            @if(!empty($anak))
                                <h4>Tindakan Terapi:</h4>
                                <div class="table-container">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Deskripsi</th>
                                                <th>Kategori</th>
                                                <th>Kategori Klinis</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($anak as $td)
                                            <tr>
                                                <td>{{ $td->kode ?? $td['kode'] }}</td>
                                                <td>{{ $td->deskripsi_tindakan_terapi ?? $td['deskripsi_tindakan_terapi'] }}</td>
                                                <td>{{ $td->nama_kategori ?? $td['nama_kategori'] }}</td>
                                                <td>{{ $td->nama_kategori_klinis ?? $td['nama_kategori_klinis'] }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p><i>Tidak ada tindakan terapi untuk rekam medis ini.</i></p>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    </div>

    <footer>
        <h3>© {{ date('Y') }} Rumah Sakit Hewan Pendidikan – Universitas Airlangga</h3>
        <p>All rights reserved.</p>
    </footer>
</body>
</html>
