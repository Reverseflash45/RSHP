@extends('layouts.lte.main')

@section('title', 'Data Kode Tindakan Terapi')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Kode Tindakan Terapi</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Data Kode Tindakan Terapi</li>
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
        <span>Tabel Data Kode Tindakan Terapi</span>
        <a href="{{ route('admin.kode-tindakan.create') }}" class="btn btn-success btn-sm">+ Tambah</a>
      </div>

      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-0">
            <thead class="bg-primary text-white">
              <tr>
                <th style="width:80px">ID</th>
                <th style="width:140px">Kode</th>
                <th>Deskripsi Tindakan</th>
                <th style="width:220px">Kategori</th>
                <th style="width:240px">Kategori Klinis</th>
                <th style="width:220px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php
                $rows = $list ?? $kt_list ?? [];
                $mapKat  = $mapKat  ?? [];
                $mapKlin = $mapKlin ?? [];
              @endphp

              @forelse($rows as $row)
                @php
                  $id   = $row->id ?? $row['id'] ?? null;
                  $kode = $row->kode ?? $row['kode'] ?? null;
                  $desk = $row->deskripsi ?? $row['deskripsi'] ?? null;
                  $idk  = $row->idkategori ?? $row['idkategori'] ?? null;
                  $idkk = $row->idkategori_klinis ?? $row['idkategori_klinis'] ?? null;

                  $namaKat  = $mapKat[$idk]  ?? (string) $idk;
                  $namaKlin = $mapKlin[$idkk] ?? (string) $idkk;
                @endphp
                <tr>
                  <td>{{ $id }}</td>
                  <td>{{ $kode }}</td>
                  <td>{{ $desk }}</td>
                  <td>{{ $namaKat }}</td>
                  <td>{{ $namaKlin }}</td>
                  <td>
                    <a href="{{ route('admin.kode-tindakan.edit', $id) }}" class="btn btn-warning btn-sm">Ubah</a>
                    <form method="POST" action="{{ route('admin.kode-tindakan.destroy', $id) }}" style="display:inline-block" onsubmit="return confirm('Hapus data ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="6" class="text-center"><em>Belum ada data.</em></td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      @if(is_object($rows) && method_exists($rows, 'links'))
        <div class="card-footer">
          {{ $rows->links() }}
        </div>
      @endif
    </div>

  </div>
</section>
@endsection