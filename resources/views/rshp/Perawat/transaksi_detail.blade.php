@extends('layouts.lte.perawat-ite.main')

@section('title', 'Detail Transaksi #' . $transaksi->idtransaksi_perawat)

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Transaksi #{{ $transaksi->idtransaksi_perawat }}</h5>
        <a href="{{ route('perawat.transaksi.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        @if(session('msg'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('err'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('err') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <b>Informasi Transaksi</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <td width="40%"><b>ID Transaksi</b></td>
                                <td>#{{ $transaksi->idtransaksi_perawat }}</td>
                            </tr>
                            <tr>
                                <td><b>Rekam Medis</b></td>
                                <td>RM#{{ $transaksi->idrekam_medis }}</td>
                            </tr>
                            <tr>
                                <td><b>Status</b></td>
                                <td>
                                    @if($transaksi->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($transaksi->status == 'proses')
                                        <span class="badge bg-info">Proses</span>
                                    @elseif($transaksi->status == 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @else
                                        <span class="badge bg-danger">Batal</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Tanggal Buat</b></td>
                                <td>{{ date('d/m/Y H:i', strtotime($transaksi->created_at)) }}</td>
                            </tr>
                            <tr>
                                <td><b>Terakhir Update</b></td>
                                <td>{{ date('d/m/Y H:i', strtotime($transaksi->updated_at)) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <b>Informasi Pasien</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <td width="40%"><b>Pet</b></td>
                                <td>{{ $transaksi->nama_pet }}</td>
                            </tr>
                            <tr>
                                <td><b>Pemilik</b></td>
                                <td>{{ $transaksi->nama_pemilik }}</td>
                            </tr>
                            <tr>
                                <td><b>Dokter</b></td>
                                <td>{{ $transaksi->nama_dokter ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-light">
                <b>Detail Tindakan & Pembayaran</b>
            </div>
            <div class="card-body">
                <p><b>Tindakan:</b></p>
                <p class="ps-3">{{ $transaksi->tindakan }}</p>
                
                <p><b>Biaya:</b></p>
                <h4 class="text-success">Rp {{ number_format($transaksi->biaya, 0, ',', '.') }}</h4>
                
                @if($transaksi->keterangan)
                <p><b>Keterangan:</b></p>
                <p class="ps-3">{{ $transaksi->keterangan }}</p>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <b>Informasi Rekam Medis</b>
            </div>
            <div class="card-body">
                <p><b>Anamnesa:</b></p>
                <p class="ps-3">{{ $transaksi->anamnesa ?? '-' }}</p>
                
                <p><b>Diagnosa:</b></p>
                <p class="ps-3">{{ $transaksi->diagnosa ?? '-' }}</p>
                
                @if($transaksi->temuan_klinis)
                <p><b>Temuan Klinis:</b></p>
                <p class="ps-3">{{ $transaksi->temuan_klinis }}</p>
                @endif
            </div>
        </div>

        <hr>

        <div class="d-flex gap-2">
            @if($transaksi->status != 'selesai')
            <form method="POST" action="{{ route('perawat.transaksi.bayar', $transaksi->idtransaksi_perawat) }}">
                @csrf
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check"></i> Tandai sebagai Selesai
                </button>
            </form>
            @endif
            
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fas fa-edit"></i> Edit
            </button>
            
            <form method="POST" action="{{ route('perawat.transaksi.delete', $transaksi->idtransaksi_perawat) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus transaksi ini?')">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('perawat.transaksi.update', $transaksi->idtransaksi_perawat) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tindakan</label>
                        <textarea class="form-control" name="tindakan" rows="3" required>{{ $transaksi->tindakan }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Biaya (Rp)</label>
                        <input type="number" class="form-control" name="biaya" 
                               value="{{ $transaksi->biaya }}" min="0" step="500" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="2">{{ $transaksi->keterangan }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="pending" {{ $transaksi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="proses" {{ $transaksi->status == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ $transaksi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="batal" {{ $transaksi->status == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection