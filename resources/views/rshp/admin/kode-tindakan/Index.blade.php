@extends('layouts.lte.main')

@section('title', 'Kode Tindakan Terapi')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Kode Tindakan Terapi</li>
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
        <span>Kode Tindakan Terapi</span>

        <div class="d-flex" style="gap: 8px;">
          <form method="GET" action="{{ route('admin.kode-tindakan.index') }}" class="d-flex">
            <div class="input-group input-group-sm me-2">
              <input
                type="text"
                name="q"
                class="form-control"
                value="{{ $q }}"
                placeholder="Cari kode / deskripsi">
            </div>

            <select name="kategori" class="form-control form-control-sm me-2" style="width:auto;">
              <option value="">Kategori</option>
              @foreach($kategori as $k)
                <option value="{{ $k->idkategori }}" {{ (string)$kategoriId === (string)$k->idkategori ? 'selected' : '' }}>
                  {{ $k->nama_kategori }}
                </option>
              @endforeach
            </select>

            <select name="klinis" class="form-control form-control-sm me-2" style="width:auto;">
              <option value="">Klinis</option>
              @foreach($klinis as $kk)
                <option value="{{ $kk->idkategori_klinis }}" {{ (string)$klinisId === (string)$kk->idkategori_klinis ? 'selected' : '' }}>
                  {{ $kk->nama_kategori_klinis }}
                </option>
              @endforeach
            </select>

            <button class="btn btn-primary btn-sm me-1" type="submit">Filter</button>
            <a href="{{ route('admin.kode-tindakan.index') }}" class="btn btn-secondary btn-sm">Reset</a>
          </form>

          <a href="{{ route('admin.kode-tindakan.create') }}" class="btn btn-success btn-sm">
            + Tambah
          </a>
        </div>
      </div>

      <div class="card-body p-0">
        <table class="table table-bordered table-hover mb-0">
          <thead class="table-dark">
            <tr>
              @php
                $dirId      = ($sort === 'id'      && $dir === 'asc') ? 'desc' : 'asc';
                $dirKode    = ($sort === 'kode'    && $dir === 'asc') ? 'desc' : 'asc';
                $dirKat     = ($sort === 'kategori'&& $dir === 'asc') ? 'desc' : 'asc';
                $dirKlinis  = ($sort === 'klinis'  && $dir === 'asc') ? 'desc' : 'asc';
              @endphp
              <th style="width:70px;">
                <a href="{{ route('admin.kode-tindakan.index', ['sort' => 'id', 'dir' => $dirId] + request()->except('sort','dir','page')) }}" class="text-white">
                  ID
                </a>
              </th>
              <th style="width:90px;">
                <a href="{{ route('admin.kode-tindakan.index', ['sort' => 'kode', 'dir' => $dirKode] + request()->except('sort','dir','page')) }}" class="text-white">
                  Kode
                </a>
              </th>
              <th>Deskripsi</th>
              <th style="width:160px;">
                <a href="{{ route('admin.kode-tindakan.index', ['sort' => 'kategori', 'dir' => $dirKat] + request()->except('sort','dir','page')) }}" class="text-white">
                  Kategori
                </a>
              </th>
              <th style="width:160px;">
                <a href="{{ route('admin.kode-tindakan.index', ['sort' => 'klinis', 'dir' => $dirKlinis] + request()->except('sort','dir','page')) }}" class="text-white">
                  Kategori Klinis
                </a>
              </th>
              <th style="width:150px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($list as $row)
              <tr>
                <td>#{{ $row->idkode_tindakan_terapi }}</td>
                <td>{{ $row->kode }}</td>
                <td>{{ $row->deskripsi_tindakan_terapi }}</td>
                <td>{{ $row->nama_kategori ?? '-' }}</td>
                <td>{{ $row->nama_kategori_klinis ?? '-' }}</td>
                <td>
                  <a href="{{ route('admin.kode-tindakan.edit', $row->idkode_tindakan_terapi) }}" class="btn btn-primary btn-sm">
                    Edit
                  </a>
                  <form action="{{ route('admin.kode-tindakan.destroy', $row->idkode_tindakan_terapi) }}"
                        method="POST"
                        style="display:inline-block"
                        onsubmit="return confirm('Yakin ingin menghapus kode ini?')">
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
                <td colspan="6" class="text-center">
                  <em>Belum ada data kode tindakan.</em>
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
