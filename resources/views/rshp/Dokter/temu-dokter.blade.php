@extends('layouts.lte.dokter-ite.main')

@section('title', 'Temu Dokter')

@section('content')
<div class="app-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Temu Dokter</h4>
        <span class="text-muted">Dokter: {{ $namaDokter }}</span>
    </div>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th style="width:70px;">No</th>
                <th>Nama Pet</th>
                <th style="width:220px;">Waktu Daftar</th>
                <th style="width:120px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($temuDokter as $i => $row)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $row->nama_pet }}</td>
                <td>{{ $row->waktu_daftar }}</td>
                <td>{{ $row->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-muted">Tidak ada data temu dokter.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
