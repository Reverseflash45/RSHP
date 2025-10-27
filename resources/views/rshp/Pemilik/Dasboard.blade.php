@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">Dashboard - Pemilik</div>
    <div class="card-body">
      @if (session('error'))   <div class="alert alert-danger">{{ session('error') }}</div> @endif
      @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

      <p>Halo, {{ auth()->user()->nama ?? auth()->user()->name }}. Ini halaman khusus <b>Pemilik</b>.</p>
    </div>
  </div>
</div>
@endsection
