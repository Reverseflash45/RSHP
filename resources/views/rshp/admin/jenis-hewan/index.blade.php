@extends('layouts.lte.main')

@section('title', 'Jenis Hewan')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                {{-- Judul dihapus sesuai permintaan --}}
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Master Data</a>
                    </li>
                    <li class="breadcrumb-item active">Jenis Hewan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        @if(session('msg'))
            <div class="alert alert-{{ session('type') === 'success' ? 'success' : 'danger' }} alert-dismissible fade show mb-3">
                {{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Data Jenis Hewan</h3>

                    <div class="d-flex" style="gap: 8px;">
                        <form method="get" class="d-flex">
                            <div class="input-group input-group-sm">
                                <input
                                    type="text"
                                    name="q"
                                    class="form-control"
                                    value="{{ request('q') }}"
                                    placeholder="Cari nama jenis hewan"
                                >
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </form>

                        <a href="{{ route('admin.jenis-hewan.create') }}" class="btn btn-success btn-sm">
                            Tambah Data
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th>Nama</th>
                            <th style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($list as $index => $row)
                            <tr>
                                <td>{{ $list->firstItem() + $index }}</td>
                                <td>{{ $row->nama_jenis_hewan }}</td>
                                <td>
                                    <a
                                        href="{{ route('admin.jenis-hewan.edit', $row->idjenis_hewan) }}"
                                        class="btn btn-primary btn-sm"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.jenis-hewan.destroy', $row->idjenis_hewan) }}"
                                        method="post"
                                        style="display:inline-block"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Belum ada data jenis hewan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($list instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="card-footer clearfix">
                    {{ $list->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection