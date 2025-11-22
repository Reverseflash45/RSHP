@extends('layouts.lte.main')

@section('title', 'Data User')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data User</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.data-master') }}">Data Master</a></li>
          <li class="breadcrumb-item active">Data User</li>
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
      <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white fw-semibold">
        <span>Tabel Data User</span>
        <a href="{{ route('admin.user.create') }}" class="btn btn-success btn-sm">+ Tambah User</a>
      </div>

      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-0">
            <thead class="bg-primary text-white">
              <tr>
                <th style="width:140px">ID User</th>
                <th>Nama</th>
                <th>Email</th>
                <th style="width:220px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php
                $rows = $list ?? $users ?? [];
              @endphp

              @forelse($rows as $u)
                @php
                  $id    = $u->iduser ?? $u['iduser'] ?? null;
                  $nama  = $u->nama   ?? $u['nama']   ?? null;
                  $email = $u->email  ?? $u['email']  ?? null;
                @endphp
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $nama }}</td>
                  <td>{{ $email }}</td>
                  <td class="aksi">
                    <a href="{{ route('admin.user.edit', $id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('admin.user.reset', $id) }}" class="btn btn-danger btn-sm">Reset Password</a>
                  </td>
                </tr>
              @empty
                <tr><td colspan="4" class="text-center"><em>Tidak ada data user</em></td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      @php
        $isPaginator =
          $rows instanceof \Illuminate\Contracts\Pagination\Paginator ||
          $rows instanceof \Illuminate\Pagination\LengthAwarePaginator ||
          $rows instanceof \Illuminate\Pagination\Paginator;
      @endphp
      @if($isPaginator)
        <div class="card-footer">
          {{ $rows->links() }}
        </div>
      @endif
    </div>

  </div>
</section>
@endsection