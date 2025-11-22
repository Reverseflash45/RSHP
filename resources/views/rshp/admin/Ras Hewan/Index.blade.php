@extends('layouts.lte.main')

@section('title', 'Ras Hewan')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                {{-- Judul dihapus sesuai permintaan --}}
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Master Data</a></li>
                    <li class="breadcrumb-item active">Ras Hewan</li>
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

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Data Ras Hewan</h3>

                <div class="d-flex" style="gap: 8px;">
                    <form method="get" class="d-flex">
                        <div class="input-group input-group-sm">
                            <input type="text" name="q" class="form-control" value="{{ request('q') }}" placeholder="Cari nama ras hewan">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </form>

                    <a href="{{ route('admin.ras.create') }}" class="btn btn-success btn-sm">Tambah Data</a>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 240px;">Jenis</th>
                        <th>Ras</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $source = $list ?? $daftarRas ?? [];
                        $rows = [];
                        foreach ($source as $item) {
                            if (is_array($item) && isset($item['obj'])) {
                                $o = $item['obj'];
                                $id = $o->idras_hewan ?? null;
                                $nama_ras = $o->nama_ras ?? null;
                                $jenis_nama = $item['nama_jenis'] ?? ($o->jenis->nama_jenis_hewan ?? null);
                            } else {
                                $id = $item->idras_hewan ?? $item['id'] ?? null;
                                $nama_ras = $item->nama_ras ?? null;
                                $jenis_nama = $item->jenis->nama_jenis_hewan
                                    ?? $item['jenis_nama']
                                    ?? $item['nama_jenis']
                                    ?? $item->nama_jenis
                                    ?? $item->nama_jenis_hewan
                                    ?? null;
                            }
                            if ($id !== null && $nama_ras !== null) {
                                $rows[] = ['id'=>$id, 'nama_ras'=>$nama_ras, 'jenis_nama'=>$jenis_nama ?? '—'];
                            }
                        }
                        usort($rows, fn($a,$b) => [$a['jenis_nama'],$a['nama_ras']] <=> [$b['jenis_nama'],$b['nama_ras']]);
                        $current = null;
                    @endphp

                    @forelse($rows as $r)
                        @if($r['jenis_nama'] !== $current)
                            @php $current = $r['jenis_nama']; @endphp
                            <tr class="table-secondary fw-semibold"><td colspan="3">{{ $current }}</td></tr>
                        @endif
                        <tr>
                            <td class="text-muted">{{ $current }}</td>
                            <td>{{ $r['nama_ras'] }}</td>
                            <td>
                                <a href="{{ route('admin.ras.edit', $r['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.ras.destroy', $r['id']) }}" style="display:inline-block" onsubmit="return confirm('Hapus ras ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center"><em>Belum ada data ras hewan.</em></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
</section>
@endsection