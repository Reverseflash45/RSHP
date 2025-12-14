@extends('layouts.lte.dokter-ite.main')

@section('title', 'Detail Transaksi #' . $transaksi->idtransaksi_dokter)

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Transaksi #{{ $transaksi->idtransaksi_dokter }}</h5>
        <a href="{{ route('dokter.transaksi.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-light">
                        <b>Informasi Transaksi</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="40%"><b>ID Transaksi</b></td>
                                <td>#{{ $transaksi->idtransaksi_dokter }}</td>
                            </tr>
                            <tr>
                                <td><b>Rekam Medis</b></td>
                                <td>RM#{{ $transaksi->idrekam_medis }}</td>
                            </tr>
                            <tr>
                                <td><b>Jenis Layanan</b></td>
                                <td>{{ ucwords(str_replace('_', ' ', $transaksi->jenis_layanan)) }}</td>
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
                                <td><b>Tanggal</b></td>
                                <td>{{ date('d/m/Y H:i', strtotime($transaksi->created_at)) }}</td>
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
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="40%"><b>Pet</b></td>
                                <td>{{ $transaksi->nama_pet }}</td>
                            </tr>
                            <tr>
                                <td><b>Pemilik</b></td>
                                <td>{{ $transaksi->nama_pemilik }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-light">
                <b>Detail Layanan & Biaya</b>
            </div>
            <div class="card-body">
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
    </div>
</div>
@endsection
