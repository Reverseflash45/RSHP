@extends('layouts.lte.pemilik-ite.main')

@section('title', 'Dashboard Pemilik')

@section('content')
    <div class="app-page-title">Dashboard Pemilik</div>

    <div class="app-card">
        <h5 class="fw-bold mb-2">
            Halo, {{ auth()->user()->nama ?? auth()->user()->name ?? 'Pemilik' }} 👋
        </h5>
        <p class="mb-0 text-muted">
            Selamat datang di panel Pemilik RSHP.
        </p>
    </div>
@endsection
