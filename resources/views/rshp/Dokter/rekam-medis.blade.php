@extends('layouts.lte.dokter-ite.main')

@section('title', 'Rekam Medis')

@section('content')
<div class="app-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Rekam Medis</h4>
        <span class="text-muted">Dokter: {{ $namaDokter }}</span>
    </div>

    <table class="table table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th style="width:90px;">ID</th>
                <th>Nama Pet</th>
                <th style="width:180px;">Tanggal</th>
                <th>Anamnesa</th>
                <th>Diagnosa</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekamMedis as $rm)
            <tr>
                <td>{{ $rm->idrekam_medis }}</td>
                <td>{{ $rm->nama_pet }}</td>
                <td>{{ $rm->created_at }}</td>
                <td>{{ $rm->anamnesa }}</td>
                <td>{{ $rm->diagnosa }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Belum ada data rekam medis.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
