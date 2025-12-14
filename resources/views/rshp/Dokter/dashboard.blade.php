{{-- resources/views/rshp/Dokter/dashboard.blade.php --}}
@extends('layouts.lte.dokter-ite.main')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Dashboard Dokter</h5>
    </div>
    <div class="card-body">
        <h4 class="mb-1">Halo, {{ $namaDokter }}</h4>
        <p class="mb-0 text-muted">Selamat datang di Panel Dokter RSHP.</p>

        <hr>

        <div class="d-flex flex-wrap gap-2">
            <a class="btn btn-sm btn-primary" href="{{ route('dokter.temu-dokter') }}">
                <i class="fas fa-calendar-check"></i> Temu Dokter
            </a>
            
            <a class="btn btn-sm btn-success" href="{{ route('dokter.rekam-medis') }}">
                <i class="fas fa-file-medical"></i> Rekam Medis
            </a>
            
            <a class="btn btn-sm btn-info" href="{{ route('dokter.transaksi.index') }}">
                <i class="fas fa-money-bill-wave"></i> Transaksi Dokter
            </a>
        </div>
    </div>
</div>
@endsection