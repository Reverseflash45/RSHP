@extends('layouts.lte.perawat-ite.main')

@section('title', 'Rekam Medis Perawat')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Rekam Medis</h5>
</div>

@if(session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
@endif

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white">
        <b>Reservasi tanpa Rekam Medis (Hari ini)</b>
    </div>
    <div class="card-body">
        @if($reservasi->isEmpty())
            <div class="text-muted">Tidak ada reservasi yang menunggu pembuatan rekam medis.</div>
        @else
            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead>
                        <tr>
                            <th>Reservasi</th>
                            <th>Waktu</th>
                            <th>Pet</th>
                            <th>Pemilik</th>
                            <th>Dokter</th>
                            <th style="width:160px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservasi as $r)
                        <tr>
                            <td>#{{ $r->idtemu_dokter }} (No.{{ $r->no_urut }})</td>
                            <td>{{ $r->waktu_daftar }}</td>
                            <td>{{ $r->nama_pet }}</td>
                            <td>{{ $r->nama_pemilik }}</td>
                            <td>{{ $r->nama_dokter ?? '-' }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary"
                                   href="{{ route('perawat.rekam-medis.create', ['idtemu' => $r->idtemu_dokter]) }}">
                                   Buat RM
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <b>Rekam Medis Terbaru</b>
    </div>
    <div class="card-body">
        @if($listRM->isEmpty())
            <div class="text-muted">Belum ada rekam medis.</div>
        @else
            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Created</th>
                            <th>Pet</th>
                            <th>Pemilik</th>
                            <th>Dokter</th>
                            <th>Anamnesa</th>
                            <th>Diagnosa</th>
                            <th style="width:120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listRM as $rm)
                        <tr>
                            <td>#{{ $rm->idrekam_medis }}</td>
                            <td>{{ $rm->created_at }}</td>
                            <td>{{ $rm->nama_pet }}</td>
                            <td>{{ $rm->nama_pemilik }}</td>
                            <td>{{ $rm->nama_dokter ?? '-' }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($rm->anamnesa, 35) }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($rm->diagnosa, 35) }}</td>
                            <td>
                                <a class="btn btn-sm btn-outline-success"
                                   href="{{ route('perawat.rekam-medis.detail', $rm->idrekam_medis) }}">
                                   Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
