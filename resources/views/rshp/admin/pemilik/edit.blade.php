@extends('layouts.lte.main')

@section('title', 'Edit Pemilik')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.pemilik.index') }}">Pemilik</a></li>
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
        <h3 class="card-title mb-0">Edit Pemilik #{{ $pemilik->idpemilik }}</h3>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.pemilik.update', $pemilik->idpemilik) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $pemilik->nama) }}" required>
          </div>

          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $pemilik->email) }}" required>
          </div>

          <div class="mb-3">
            <label>No. WA</label>
            <input type="text" name="no_wa" class="form-control" value="{{ old('no_wa', $pemilik->no_wa) }}">
          </div>

          <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $pemilik->alamat) }}</textarea>
          </div>

          <button type="submit" class="btn btn-primary">Update</button>
          <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>

  </div>
</section>
@endsection
