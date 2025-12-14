@extends('layouts.lte.dokter-ite.main')

@section('title', 'Buat Transaksi Baru')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <b>Buat Transaksi Dokter</b>
    </div>
    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('dokter.transaksi.store') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Rekam Medis</label>
                <select class="form-select" name="idrekam_medis" id="rekamSelect" required>
                    <option value="">-- Pilih Rekam Medis --</option>
                    @foreach($rekamList as $rekam)
                        <option value="{{ $rekam->idrekam_medis }}" 
                                {{ $rekamId == $rekam->idrekam_medis ? 'selected' : '' }}>
                            RM#{{ $rekam->idrekam_medis }} - {{ $rekam->nama_pet }} - {{ $rekam->nama_pemilik }}
                            ({{ date('d/m/Y', strtotime($rekam->created_at)) }})
                        </option>
                    @endforeach
                </select>
                <div class="form-text">Pilih rekam medis yang akan ditransaksikan</div>
            </div>

            @if($selectedRekam)
            <div class="alert alert-info">
                <b>Detail Rekam Medis:</b><br>
                <b>Pet:</b> {{ $selectedRekam->nama_pet }}<br>
                <b>Pemilik:</b> {{ $selectedRekam->nama_pemilik }}<br>
                <b>Tanggal:</b> {{ date('d/m/Y H:i', strtotime($selectedRekam->created_at)) }}<br>
                <b>Diagnosa:</b> {{ Str::limit($selectedRekam->diagnosa ?? '-', 100) }}
            </div>
            @endif

            <div class="mb-3">
                <label class="form-label fw-bold">Jenis Layanan</label>
                <select class="form-select" name="jenis_layanan" required>
                    <option value="">-- Pilih Jenis Layanan --</option>
                    @foreach($jenisLayanan as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Biaya (Rp)</label>
                <input type="number" class="form-control" name="biaya" 
                       value="{{ old('biaya') }}" min="0" step="1000" required
                       placeholder="Contoh: 150000">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Keterangan (opsional)</label>
                <textarea class="form-control" name="keterangan" rows="3" 
                          placeholder="Catatan tambahan tentang layanan...">{{ old('keterangan') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-success" type="submit">
                    <i class="fas fa-save"></i> Simpan Transaksi
                </button>
                <a class="btn btn-outline-secondary" href="{{ route('dokter.transaksi.index') }}">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('rekamSelect').addEventListener('change', function() {
        const selectedId = this.value;
        if (selectedId) {
            window.location.href = "{{ route('dokter.transaksi.create') }}?idrekam=" + selectedId;
        }
    });
</script>
@endpush
@endsection