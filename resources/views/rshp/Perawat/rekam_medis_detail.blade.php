@extends('layouts.lte.perawat-ite.main')

@section('title', 'Detail Rekam Medis')

@section('content')
@if(!empty($msg))
    <div class="alert {{ !empty($ok) && $ok==1 ? 'alert-success' : 'alert-danger' }}">
        {{ $msg }}
    </div>
@endif

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white">
        <b>Detail Rekam Medis #{{ $idRekam }}</b>
        <div class="text-muted mt-1">
            <b>Pet:</b> {{ $header['nama_pet'] ?? '-' }} • <b>Pemilik:</b> {{ $header['nama_pemilik'] ?? '-' }}
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('perawat.rekam-medis.header.update', $idRekam) }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Anamnesa</label>
                <textarea class="form-control" name="anamnesa" rows="3">{{ $header['anamnesa'] ?? '' }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Temuan Klinis</label>
                <textarea class="form-control" name="temuan_klinis" rows="3">{{ $header['temuan_klinis'] ?? '' }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Diagnosa</label>
                <textarea class="form-control" name="diagnosa" rows="3">{{ $header['diagnosa'] ?? '' }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-warning" type="submit">Simpan Header</button>
                <a class="btn btn-outline-secondary" href="{{ route('perawat.rekam-medis.index') }}">Kembali</a>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <b>Tindakan Terapi</b>
    </div>
    <div class="card-body">

        {{-- ADD --}}
        <form method="POST" action="{{ route('perawat.rekam-medis.detail.add', $idRekam) }}" class="row g-2 mb-3">
            @csrf
            <div class="col-md-5">
                <select class="form-select" name="idkode_tindakan_terapi" required>
                    <option value="">— pilih tindakan —</option>
                    @foreach($listKode ?? [] as $k)
                        <option value="{{ $k['idkode_tindakan_terapi'] }}">{{ $k['label'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <input class="form-control" type="text" name="detail" placeholder="Catatan (opsional)">
            </div>
            <div class="col-md-2 d-grid">
                <button class="btn btn-success" type="submit">Tambah</button>
            </div>
        </form>

        @if(empty($detailTindakan))
            <div class="text-muted">Belum ada tindakan.</div>
        @else
            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Klinis</th>
                            <th>Catatan</th>
                            <th style="width:330px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detailTindakan as $row)
                        <tr>
                            <td>{{ $row['kode'] ?? '-' }}</td>
                            <td>{{ $row['deskripsi_tindakan_terapi'] ?? '-' }}</td>
                            <td>{{ $row['nama_kategori'] ?? '-' }}</td>
                            <td>{{ $row['nama_kategori_klinis'] ?? '-' }}</td>
                            <td>{{ $row['detail'] ?? '-' }}</td>
                            <td>
                                {{-- UPDATE --}}
                                <form method="POST"
                                      action="{{ route('perawat.rekam-medis.detail.update', $idRekam) }}"
                                      class="d-inline-block me-2">
                                    @csrf
                                    <input type="hidden" name="iddetail" value="{{ $row['iddetail_rekam_medis'] }}">
                                    <div class="d-flex gap-2">
                                        <select class="form-select form-select-sm" name="idkode_tindakan_terapi" required style="min-width:200px">
                                            @foreach($listKode ?? [] as $k)
                                                <option value="{{ $k['idkode_tindakan_terapi'] }}"
                                                    {{ $k['idkode_tindakan_terapi']==$row['idkode_tindakan_terapi'] ? 'selected' : '' }}>
                                                    {{ $k['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input class="form-control form-control-sm" name="detail" value="{{ $row['detail'] ?? '' }}" placeholder="catatan" style="min-width:180px">
                                        <button class="btn btn-sm btn-warning" type="submit">Simpan</button>
                                    </div>
                                </form>

                                {{-- DELETE --}}
                                <form method="POST"
                                      action="{{ route('perawat.rekam-medis.detail.delete', $idRekam) }}"
                                      class="d-inline-block"
                                      onsubmit="return confirm('Hapus tindakan ini?')">
                                    @csrf
                                    <input type="hidden" name="iddetail" value="{{ $row['iddetail_rekam_medis'] }}">
                                    <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</div>
@endsection
