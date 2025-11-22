@extends('layouts.lte.main')

@section('title', 'Data Kategori Klinis')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Kategori Klinis</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Data Kategori Klinis</li>
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
        <span>Tabel Data Kategori Klinis</span>
        <a href="{{ route('admin.kategori-klinis.create') }}" class="btn btn-success btn-sm">+ Tambah</a>
      </div>

      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-0">
            <thead class="bg-primary text-white">
              <tr>
                <th style="width:110px">ID</th>
                <th>Nama Kategori Klinis</th>
                <th style="width:220px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php
                $rows = $list ?? $kk_list ?? [];
              @endphp

              @forelse($rows as $row)
                @php
                  $id   = $row->idkategori_klinis ?? $row['idkategori_klinis'] ?? $row->id ?? $row['id'] ?? null;
                  $nama = $row->nama_kategori_klinis ?? $row['nama_kategori_klinis'] ?? $row->nama ?? $row['nama'] ?? null;
                @endphp
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $nama }}</td>
                  <td>
                    <a href="{{ route('admin.kategori-klinis.edit', $id) }}" class="btn btn-warning btn-sm">Ubah</a>
                    <form method="POST" action="{{ route('admin.kategori-klinis.destroy', $id) }}" style="display:inline-block" onsubmit="return confirm('Hapus kategori klinis ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="3" class="text-center"><em>Belum ada data.</em></td></tr>
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