{{-- resources/views/rshp/Dokter/transaksi_index.blade.php --}}
@extends('layouts.lte.dokter-ite.main')

@section('title', 'Transaksi Dokter')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Transaksi Dokter</h5>
        <a href="{{ route('dokter.transaksi.create') }}" class="btn btn-sm btn-success">
            <i class="fas fa-plus"></i> Transaksi Baru
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Rekam Medis</th>
                        <th>Pet</th>
                        <th>Pemilik</th>
                        <th>Jenis Layanan</th>
                        <th>Biaya</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $row)
                    <tr>
                        <td>#{{ $row->idtransaksi_dokter }}</td>
                        <td>RM#{{ $row->idrekam_medis }}</td>
                        <td>{{ $row->nama_pet }}</td>
                        <td>{{ $row->nama_pemilik }}</td>
                        <td>{{ $row->jenis_layanan }}</td>
                        <td>Rp {{ number_format($row->biaya, 0, ',', '.') }}</td>
                        <td>
                            @if($row->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($row->status == 'proses')
                                <span class="badge bg-info">Proses</span>
                            @elseif($row->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-danger">Batal</span>
                            @endif
                        </td>
                        <td>{{ date('d/m/Y', strtotime($row->created_at)) }}</td>
                        <td>
                            <a href="{{ route('dokter.transaksi.detail', $row->idtransaksi_dokter) }}" 
                               class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">Belum ada transaksi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection