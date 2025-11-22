@extends('layouts.lte.main')

@section('title', 'Pemilik')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        {{-- Judul dihilangkan sesuai permintaan --}}
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Pemilik</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
      <div class="card-header bg-dark text-white fw-semibold">
        Data Pemilik
        <a href="{{ route('admin.pemilik.create') }}" class="btn btn-primary btn-sm float-end">+ Tambah Pemilik</a>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Email</th>
              <th>No. WA</th>
              <th>Alamat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($list as $row)
              <tr>
                <form method="POST" action="{{ route('admin.pemilik.update', $row->idpemilik) }}">
                  @csrf
                  @method('PUT')
                  <td>#{{ $row->idpemilik }}</td>
                  <td><input type="text" name="nama" value="{{ $row->nama }}" class="form-control" required></td>
                  <td><input type="email" name="email" value="{{ $row->email }}" class="form-control" required></td>
                  <td><input type="text" name="no_wa" value="{{ $row->no_wa }}" class="form-control"></td>
                  <td><input type="text" name="alamat" value="{{ $row->alamat }}" class="form-control"></td>
                  <td><button type="submit" class="btn btn-sm btn-primary">Simpan</button></td>
                </form>
              </tr>
            @empty
              <tr><td colspan="6"><em>Tidak ada data pemilik.</em></td></tr>
            @endforelse
          </tbody>
        </table>

        @if(method_exists($list, 'links'))
          <div class="mt-3">{{ $list->links() }}</div>
        @endif
      </div>
    </div>

  </div>
</section>
@endsection