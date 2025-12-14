@extends('layouts.lte.perawat-ite.main')

@section('title', 'Dashboard Perawat')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Dashboard Perawat</h5>
    </div>
    <div class="card-body">
        <p class="mb-1"><b>Halo, {{ $namaPerawat ?? (auth()->user()->nama ?? 'Perawat') }}!</b></p>
        <p class="mb-0 text-muted">Selamat datang di halaman perawat RSHP Universitas Airlangga.</p>

        <hr>

        <a class="btn btn-sm btn-success" href="{{ route('perawat.rekam-medis.index') }}">
            Buka Rekam Medis
        </a>
    </div>
</div>
@endsection
