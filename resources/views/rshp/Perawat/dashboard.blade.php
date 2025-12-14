{{-- resources/views/rshp/Perawat/dashboard.blade.php --}}
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

        <div class="d-flex flex-wrap gap-2">
            <a class="btn btn-sm btn-success" href="{{ route('perawat.rekam-medis.index') }}">
                <i class="fas fa-file-medical"></i> Buka Rekam Medis
            </a>
            
            {{-- TAMBAH LINK TRANSAKSI --}}
            <a class="btn btn-sm btn-primary" href="{{ route('perawat.transaksi.index') }}">
                <i class="fas fa-money-bill-wave"></i> Transaksi Perawat
            </a>
        </div>
    </div>
</div>
@endsection