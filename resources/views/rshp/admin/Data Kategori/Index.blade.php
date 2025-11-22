@extends('layouts.lte.main')

@section('title', 'Data Kategori')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Kategori</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Data Kategori</li>
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
        <span>Tabel Data Kategori</span>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-success btn-sm">+ Tambah</a>
      </div>

      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-0">
            <thead class="bg-primary text-white">
              <tr>
                <th style="width:120px">ID</th>
                <th>Nama Kategori</th>
                <th style="width:220px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($list as $k)
                <tr>
                  <td>{{ $k->idkategori }}</td>
                  <td>{{ $k->nama_kategori }}</td>
                  <td>
                    <a href="{{ route('admin.kategori.edit', $k->idkategori) }}" class="btn btn-warning btn-sm">Ubah</a>
                    <form method="POST" action="{{ route('admin.kategori.destroy', $k->idkategori) }}" style="display:inline-block" onsubmit="return confirm('Hapus data ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" class="text-center"><em>Belum ada data.</em></td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      @php
        use Illuminate\Contracts\Pagination\Paginator;
        use Illuminate\Contracts\Pagination\LengthAwarePaginator;
      @endphp
      @if(isset($list) && ($list instanceof Paginator || $list instanceof LengthAwarePaginator))
        <div class="card-footer">
          {{ $list->links() }}
        </div>
      @endif
    </div>

  </div>
</section>
@endsection