@extends('layouts.lte.main')

@section('title', 'Edit User')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
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
        Edit User #{{ $item->iduser }}
      </div>
      <div class="card-body">
        <form action="{{ route('admin.user.update', $item->iduser) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label>Nama</label>
            <input type="text"
                   name="nama"
                   class="form-control"
                   value="{{ old('nama', $item->nama) }}"
                   required>
          </div>

          <div class="mb-3">
            <label>Email</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email', $item->email) }}"
                   required>
          </div>

          <div class="mb-3">
            <label>Password Baru (opsional)</label>
            <input type="password"
                   name="password"
                   class="form-control">
            <small class="form-text text-muted">
              Kosongkan jika tidak ingin mengubah password.
            </small>
          </div>

          <button type="submit" class="btn btn-primary">Update</button>
          <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>

  </div>
</section>
@endsection
