@extends('layouts.lte.dokter-ite.main')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="app-card">
    <h4 class="mb-1">Halo, {{ $namaDokter }}</h4>
    <p class="mb-0 text-muted">Selamat datang di Panel Dokter RSHP.</p>
</div>
@endsection
