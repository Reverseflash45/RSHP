@extends('layouts.lte.main')

@section('title', 'Ras Hewan')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Ras Hewan</h1>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.ras.index') }}" class="form-inline">
                    <div class="form-group mr-2">
                        <input type="text" name="q" class="form-control" placeholder="Cari ID / Nama / Jenis"
                               value="{{ $search }}">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Cari</button>
                    <a href="{{ route('admin.ras.index') }}" class="btn btn-secondary">Reset</a>
                </form>
            </div>
        </div>

        <div class="mb-3">
            <a href="{{ route('admin.ras.create') }}" class="btn btn-primary btn-sm">Tambah Ras</a>
        </div>

        @forelse($ras as $jenis => $items)
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title mb-0">{{ $jenis }}</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-striped mb-0">
                        <thead>
                            <tr>
                                <th>
                                    <a href="{{ route('admin.ras.index', [
                                        'sort' => 'id',
                                        'dir' => $sort === 'id' && $dir === 'asc' ? 'desc' : 'asc',
                                        'q' => $search
                                    ]) }}">
                                        ID
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.ras.index', [
                                        'sort' => 'nama',
                                        'dir' => $sort === 'nama' && $dir === 'asc' ? 'desc' : 'asc',
                                        'q' => $search
                                    ]) }}">
                                        Nama Ras
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('admin.ras.index', [
                                        'sort' => 'jenis',
                                        'dir' => $sort === 'jenis' && $dir === 'asc' ? 'desc' : 'asc',
                                        'q' => $search
                                    ]) }}">
                                        Jenis Hewan
                                    </a>
                                </th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $r)
                                <tr>
                                    <td>{{ $r->idras_hewan }}</td>
                                    <td>{{ $r->nama_ras }}</td>
                                    <td>{{ $r->nama_jenis_hewan }}</td>
                                    <td>
                                        <a href="{{ route('admin.ras.edit', $r->idras_hewan) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.ras.destroy', $r->idras_hewan) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                Belum ada data ras hewan.
            </div>
        @endforelse
    </div>
</section>
@endsection
