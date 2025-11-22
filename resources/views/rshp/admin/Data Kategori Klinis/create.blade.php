@extends('layouts.lte.main')

@section('title', 'Tambah Kategori Klinis')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Tambah Kategori Klinis</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.kategori-klinis.index') }}">Kategori Klinis</a></li>
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
        Form Tambah Kategori Klinis
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('admin.kategori-klinis.store') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">Nama Kategori Klinis</label>
            <input type="text" name="nama_kategori_klinis" value="{{ old('nama_kategori_klinis') }}" class="form-control" required>
            @error('nama_kategori_klinis')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <button type="submit" class="btn btn-success">Simpan</button>
          <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>

  </div>
</section>
@endsection