@extends('layouts.lte.main')

@section('title', 'Data Pet')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Pet</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Data Pet</li>
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
        <span>Tabel Data Pet</span>
        <a href="{{ route('admin.pet.create') }}" class="btn btn-success btn-sm">+ Tambah Pet</a>
      </div>

      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-0">
            <thead class="bg-primary text-white">
              <tr>
                <th>ID</th>
                <th>Nama Pet</th>
                <th>Pemilik</th>
                <th>Ras</th>
                <th>Jenis Hewan</th>
                <th>Tanggal Lahir</th>
                <th style="width:180px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($rows as $p)
                <tr>
                  <td>{{ $p->idpet ?? '-' }}</td>
                  <td>{{ $p->nama ?? '-' }}</td>
                  <td>{{ $p->pemilik->nama ?? '-' }}</td>
                  <td>{{ $p->ras->nama_ras ?? '-' }}</td>
                  <td>{{ $p->jenis->nama_jenis ?? '-' }}</td>
                  <td>{{ $p->tanggal_lahir ?? '-' }}</td>
                  <td>
                    <a href="{{ route('admin.pet.edit', $p->idpet ?? 0) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.pet.destroy', $p->idpet ?? 0) }}" style="display:inline-block" onsubmit="return confirm('Hapus data ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center"><em>Belum ada data.</em></td>
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
      @if(isset($rows) && ($rows instanceof Paginator || $rows instanceof LengthAwarePaginator))
        <div class="card-footer">
          {{ $rows->links() }}
        </div>
      @endif
    </div>

  </div>
</section>
@endsection