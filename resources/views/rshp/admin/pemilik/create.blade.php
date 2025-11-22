@extends('layouts.lte.main')

@section('title', 'Tambah Pemilik')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"><h1 class="m-0">Tambah Pemilik</h1></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.pemilik.index') }}">Pemilik</a></li>
          <li class="breadcrumb-item active">Tambah</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header bg-dark text-white fw-semibold">Form Tambah Pemilik</div>
      <div class="card-body">
        <form method="POST" action="{{ route('admin.pemilik.store') }}">
          @csrf
          <div class="row mb-3">
            <div class="col-md-4">
              <label>Nama</label>
              <input name="nama" value="{{ old('nama') }}" class="form-control" required>
              @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-4">
              <label>Email</label>
              <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
              @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-4">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
              @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-4">
              <label>No. WA</label>
              <input name="no_wa" value="{{ old('no_wa') }}" class="form-control" required>
              @error('no_wa') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-8">
              <label>Alamat</label>
              <input name="alamat" value="{{ old('alamat') }}" class="form-control" required>
              @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>
          <button class="btn btn-primary">Simpan</button>
          <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection