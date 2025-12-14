@extends('layouts.lte.resepsionis-ite.main')

@section('title', 'Registrasi Pemilik')

@section('page')
  <div class="row g-3">
    <div class="col-12">
      <div class="card card-soft p-3">
        <h5 class="mb-1" style="font-weight:800;color:#020381;">Registrasi Pemilik</h5>
        <div class="text-muted">Input data pemilik baru.</div>
      </div>
    </div>

    <div class="col-12">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
      @endif
    </div>

    <div class="col-12 col-lg-7">
      <div class="card card-soft p-3">
        <form method="POST" action="{{ route('resepsionis.registrasi-pemilik.store') }}">
          @csrf

          <div class="mb-2">
            <label class="form-label fw-bold">Nama</label>
            <input class="form-control" name="nama" value="{{ old('nama') }}" required>
          </div>

          <div class="mb-2">
            <label class="form-label fw-bold">Email</label>
            <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
          </div>

          <div class="mb-2">
            <label class="form-label fw-bold">Password</label>
            <input class="form-control" type="password" name="password" required>
          </div>

          <div class="mb-2">
            <label class="form-label fw-bold">No. WA</label>
            <input class="form-control" name="no_wa" value="{{ old('no_wa') }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Alamat</label>
            <textarea class="form-control" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
          </div>

          <button class="btn btn-rshp">
            <i class="fa-solid fa-floppy-disk"></i> Simpan
          </button>
          <a class="btn btn-outline-secondary" href="{{ route('resepsionis.dashboard') }}">Kembali</a>
        </form>
      </div>
    </div>
  </div>
@endsection
