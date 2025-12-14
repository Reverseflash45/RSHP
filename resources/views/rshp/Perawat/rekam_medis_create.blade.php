@extends('layouts.lte.perawat-ite.main')

@section('title', 'Buat Rekam Medis')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <b>Buat Rekam Medis</b>
    </div>
    <div class="card-body">
        @if(!empty($err))
            <div class="alert alert-danger">{{ $err }}</div>
        @endif

        <div class="mb-3 text-muted">
            <b>Reservasi:</b> #{{ $temu->idtemu_dokter }} (No. {{ $temu->no_urut }})<br>
            <b>Waktu:</b> {{ $temu->waktu_daftar }}<br>
            <b>Pet:</b> {{ $temu->nama_pet }} • <b>Pemilik:</b> {{ $temu->nama_pemilik }}
        </div>

        <form method="POST" action="{{ route('perawat.rekam-medis.store') }}">
            @csrf
            <input type="hidden" name="idtemu_dokter" value="{{ $temu->idtemu_dokter }}">

            <div class="mb-3">
                <label class="form-label fw-bold">Anamnesa</label>
                <textarea class="form-control" name="anamnesa" rows="3" required>{{ old('anamnesa') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Temuan Klinis (opsional)</label>
                <textarea class="form-control" name="temuan_klinis" rows="3">{{ old('temuan_klinis') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Diagnosa</label>
                <textarea class="form-control" name="diagnosa" rows="3" required>{{ old('diagnosa') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a class="btn btn-outline-secondary" href="{{ route('perawat.rekam-medis.index') }}">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
