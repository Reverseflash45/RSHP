@extends('layouts.lte.main')

@section('title', 'Pet')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Pet</li>
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

    <div class="card mb-3">
      <div class="card-header d-flex justify-content-between align-items-center">
        <span>Data Pet</span>
        <div class="d-flex" style="gap: 8px;">
          <form method="GET" action="{{ route('admin.pet.index') }}" class="d-flex">
            <div class="input-group input-group-sm">
              <input
                type="text"
                name="q"
                class="form-control"
                value="{{ $q ?? '' }}"
                placeholder="Cari nama pet / pemilik / ras">
              <button class="btn btn-primary" type="submit">Cari</button>
            </div>
          </form>
          <a href="{{ route('admin.pet.create') }}" class="btn btn-success btn-sm">
            + Tambah Pet
          </a>
        </div>
      </div>

      <div class="card-body p-0">
        <table class="table table-bordered table-striped mb-0">
          <thead class="table-dark">
            <tr>
              <th style="width:60px;">ID</th>
              <th>Nama Pet</th>
              <th>Jenis Kelamin</th>
              <th>Pemilik</th>
              <th>Ras</th>
              <th>Jenis Hewan</th>
              <th style="width:160px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($list as $row)
              <tr>
                <td>#{{ $row->idpet }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->jenis_kelamin === 'M' ? 'Jantan' : 'Betina' }}</td>
                <td>
                  {{ $row->pemilik->user->nama ?? '-' }}<br>
                  <small>{{ $row->pemilik->user->email ?? '' }}</small><br>
                  <small>{{ $row->pemilik->no_wa ?? '' }}</small>
                </td>
                <td>{{ $row->ras->nama_ras ?? '-' }}</td>
                <td>{{ $row->ras->jenis->nama_jenis_hewan ?? '-' }}</td>
                <td>
                  <a href="{{ route('admin.pet.edit', $row->idpet) }}" class="btn btn-primary btn-sm">
                    Edit
                  </a>
                  <form
                    action="{{ route('admin.pet.destroy', $row->idpet) }}"
                    method="POST"
                    style="display:inline-block"
                    onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                  >
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
                <td colspan="7"><em>Tidak ada data pet.</em></td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if(method_exists($list, 'links'))
        <div class="card-footer clearfix">
          {{ $list->links() }}
        </div>
      @endif
    </div>

  </div>
</section>
@endsection
