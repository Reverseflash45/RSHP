@extends('layouts.lte.main')

@section('title', 'User')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">User</li>
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
      <div class="card-header d-flex justify-content-between align-items-center">
        <span>Data User</span>

        <div class="d-flex" style="gap: 8px;">
          <form method="GET" action="{{ route('admin.user.index') }}" class="d-flex">
            <div class="input-group input-group-sm">
              <input type="text"
                     name="q"
                     class="form-control"
                     value="{{ $q }}"
                     placeholder="Cari nama / email">
              <button class="btn btn-primary" type="submit">Cari</button>
            </div>
          </form>

          <a href="{{ route('admin.user.create') }}" class="btn btn-success btn-sm">
            + Tambah User
          </a>
        </div>
      </div>

      <div class="card-body p-0">
        <table class="table table-bordered table-hover mb-0">
          <thead class="table-dark">
            @php
              $dirId    = ($sort === 'id'    && $dir === 'asc') ? 'desc' : 'asc';
              $dirNama  = ($sort === 'nama'  && $dir === 'asc') ? 'desc' : 'asc';
              $dirEmail = ($sort === 'email' && $dir === 'asc') ? 'desc' : 'asc';
              $base     = request()->except('sort','dir','page');
            @endphp
            <tr>
              <th style="width:70px;">
                <a href="{{ route('admin.user.index', array_merge($base, ['sort' => 'id', 'dir' => $dirId])) }}" class="text-white">
                  ID
                </a>
              </th>
              <th>
                <a href="{{ route('admin.user.index', array_merge($base, ['sort' => 'nama', 'dir' => $dirNama])) }}" class="text-white">
                  Nama
                </a>
              </th>
              <th>
                <a href="{{ route('admin.user.index', array_merge($base, ['sort' => 'email', 'dir' => $dirEmail])) }}" class="text-white">
                  Email
                </a>
              </th>
              <th style="width:200px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($list as $row)
              <tr>
                <td>#{{ $row->iduser }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->email }}</td>
                <td>
                  <a href="{{ route('admin.user.edit', $row->iduser) }}" class="btn btn-primary btn-sm">
                    Edit
                  </a>
                  <a href="{{ route('admin.user.reset', $row->iduser) }}" class="btn btn-warning btn-sm"
                     onclick="return confirm('Reset password user ini ke: password ?')">
                    Reset PW
                  </a>
                  <form action="{{ route('admin.user.destroy', $row->iduser) }}"
                        method="POST"
                        style="display:inline-block"
                        onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                      Hapus
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center">
                  <em>Belum ada data user.</em>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($list instanceof \Illuminate\Contracts\Pagination\Paginator ||
          $list instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
        <div class="card-footer">
        </div>
      @endif
    </div>

  </div>
</section>
@endsection
