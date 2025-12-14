@extends('layouts.lte.pemilik-ite.main')

@section('title', 'Rekam Medis')

@section('content')
<div class="app-page-title">Rekam Medis Pet</div>

<div class="app-card">
    <p class="text-muted mb-3">
        Riwayat pemeriksaan dan tindakan medis pet Anda.
    </p>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama Pet</th>
                <th>Tanggal</th>
                <th>Dokter</th>
                <th>Diagnosa</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rekamMedis ?? [] as $i => $rm)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $rm->nama_pet ?? '-' }}</td>
                    <td>{{ $rm->tanggal ?? '-' }}</td>
                    <td>{{ $rm->nama_dokter ?? '-' }}</td>
                    <td>{{ $rm->diagnosa ?? '-' }}</td>
                    <td>{{ $rm->tindakan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Belum ada rekam medis.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
