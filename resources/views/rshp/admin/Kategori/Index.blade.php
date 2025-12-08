@extends('layouts.lte.main')

@section('title', 'Kategori Tindakan')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Kategori Tindakan</li>
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
        <span>Kategori Tindakan</span>

        <div class="d-flex" style="gap: 8px;">
          <form method="GET" action="{{ route('admin.kategori.index') }}" class="d-flex">
            <div class="input-group input-group-sm">
              <input
                type="text"
                name="q"
                class="form-control"
                value="{{ $q }}"
                placeholder="Cari nama kategori">
              <button class="btn btn-primary" type="submit">Cari</button>
            </div>
          </form>

          <a href="{{ route('admin.kategori.create') }}" class="btn btn-success btn-sm">
            + Tambah
          </a>
        </div>
      </div>

      <div class="card-body p-0">
        <table class="table table-bordered table-hover mb-0">
          <thead class="table-dark">
            <tr>
              <th style="width:70px;">
                @php
                  $dirId = ($sort === 'id' && $dir === 'asc') ? 'desc' : 'asc';
                @endphp
                <a href="{{ route('admin.kategori.index', ['sort' => 'id', 'dir' => $dirId, 'q' => $q]) }}" class="text-white">
                  ID
                </a>
              </th>
              <th>
                @php
                  $dirNama = ($sort === 'nama' && $dir === 'asc') ? 'desc' : 'asc';
                @endphp
                <a href="{{ route('admin.kategori.index', ['sort' => 'nama', 'dir' => $dirNama, 'q' => $q]) }}" class="text-white">
                  Nama Kategori
                </a>
              </th>
              <th style="width:160px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($list as $row)
              <tr>
                <td>#{{ $row->idkategori }}</td>
                <td>{{ $row->nama_kategori }}</td>
                <td>
                  <a href="{{ route('admin.kategori.edit', $row->idkategori) }}" class="btn btn-primary btn-sm">
                    Edit
                  </a>
                  <form action="{{ route('admin.kategori.destroy', $row->idkategori) }}"
                        method="POST"
                        style="display:inline-block"
                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
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
                <td colspan="3" class="text-center">
                  <em>Belum ada data kategori.</em>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($list instanceof \Illuminate\Contracts\Pagination\Paginator ||
          $list instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
        <div class="card-footer">
          {{ $list->links() }}
        </div>
      @endif
    </div>

  </div>
</section>
@endsection
