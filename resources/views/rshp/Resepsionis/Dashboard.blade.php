@extends('layouts.lte.resepsionis-ite.main')

@section('title', 'Dashboard Resepsionis')

@section('page')
  <div class="row g-3">
    <div class="col-12">
      <div class="card card-soft p-4">
        <h4 class="mb-1" style="color:#020381;font-weight:800;">
          Halo, {{ auth()->user()->nama ?? 'Resepsionis' }} 👋
        </h4>
        <div class="text-muted">
          Selamat datang di dashboard resepsionis RSHP. Pilih menu di kiri untuk mulai.
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-soft p-3">
        <div class="d-flex align-items-center gap-2">
          <i class="fa-solid fa-stethoscope fa-lg" style="color:#020381"></i>
          <div>
            <div class="fw-bold">Temu Dokter</div>
            <div class="text-muted" style="font-size:12px;">Tambah & kelola antrian hari ini</div>
          </div>
        </div>
        <div class="mt-3">
          <a class="btn btn-rshp w-100" href="{{ route('resepsionis.temu-dokter') }}">Buka</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-soft p-3">
        <div class="d-flex align-items-center gap-2">
          <i class="fa-solid fa-user-plus fa-lg" style="color:#020381"></i>
          <div>
            <div class="fw-bold">Registrasi Pemilik</div>
            <div class="text-muted" style="font-size:12px;">Tambah pemilik baru</div>
          </div>
        </div>
        <div class="mt-3">
          <a class="btn btn-rshp w-100" href="{{ route('resepsionis.registrasi-pemilik') }}">Buka</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card card-soft p-3">
        <div class="d-flex align-items-center gap-2">
          <i class="fa-solid fa-paw fa-lg" style="color:#020381"></i>
          <div>
            <div class="fw-bold">Registrasi Pet</div>
            <div class="text-muted" style="font-size:12px;">Tambah pet baru</div>
          </div>
        </div>
        <div class="mt-3">
          <a class="btn btn-rshp w-100" href="{{ route('resepsionis.registrasi-pet') }}">Buka</a>
        </div>
      </div>
    </div>
  </div>
@endsection
