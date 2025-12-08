@extends('layouts.lte.main')

@section('title', 'Edit Kategori Tindakan')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.kategori.index') }}">Kategori Tindakan</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">

    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card">
      <div class="card-header">
        Edit Kategori #{{ $kategori->idkategori }}
      </div>
      <div class="card-body">
        <form action="{{ route('admin.kategori.update', $kategori->idkategori) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text"
                   name="nama_kategori"
                   class="form-control"
                   value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                   required>
          </div>

          <button type="submit" class="btn btn-primary">Update</button>
          <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>

  </div>
</section>
@endsection
