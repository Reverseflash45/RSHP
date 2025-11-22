@extends('layouts.lte.main')

@section('title', 'Tambah Kategori')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Tambah Kategori</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.kategori.index') }}">Kategori</a></li>
          <li class="breadcrumb-item active">Tambah</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">

    @if(session('msg'))
      <div class="alert alert-{{ session('type') === 'success' ? 'success' : 'danger' }}">
        {{ session('msg') }}
      </div>
    @endif

    <div class="card">
      <div class="card-header bg-dark text-white fw-semibold">
        Form Tambah Kategori
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('admin.kategori.store') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input name="nama_kategori" value="{{ old('nama_kategori') }}" class="form-control" required>
            @error('nama_kategori') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <button class="btn btn-success">Simpan</button>
          <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>

  </div>
</section>
@endsection