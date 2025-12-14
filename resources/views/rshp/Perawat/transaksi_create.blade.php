@extends('layouts.lte.perawat-ite.main')

@section('title', 'Buat Transaksi Baru')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <b>Buat Transaksi Baru</b>
    </div>
    <div class="card-body">
        @if(session('err'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('err') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('perawat.transaksi.store') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Rekam Medis</label>
                <select class="form-select" name="idrekam_medis" id="rekamSelect" required>
                    <option value="">-- Pilih Rekam Medis --</option>
                    @foreach($rekamList as $rekam)
                        <option value="{{ $rekam->idrekam_medis }}" 
                                {{ $rekamId == $rekam->idrekam_medis ? 'selected' : '' }}>
                            RM#{{ $rekam->idrekam_medis }} - {{ $rekam->nama_pet }} 
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
                <b>Tanggal:</b> {{ date('d/m/Y H:i', strtotime($selectedRekam->created_at)) }}<br>
                <b>Diagnosa:</b> {{ Str::limit($selectedRekam->diagnosa, 100) }}
            </div>
            @endif

            <div class="mb-3">
                <label class="form-label fw-bold">Tindakan/Perawatan</label>
                <textarea class="form-control" name="tindakan" rows="3" required 
                          placeholder="Deskripsi tindakan/perawatan yang diberikan...">{{ old('tindakan') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Biaya (Rp)</label>
                <input type="number" class="form-control" name="biaya" 
                       value="{{ old('biaya') }}" min="0" step="500" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Keterangan (opsional)</label>
                <textarea class="form-control" name="keterangan" rows="2" 
                          placeholder="Catatan tambahan...">{{ old('keterangan') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-success" type="submit">
                    <i class="fas fa-save"></i> Simpan Transaksi
                </button>
                <a class="btn btn-outline-secondary" href="{{ route('perawat.transaksi.index') }}">
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
            window.location.href = "{{ route('perawat.transaksi.create') }}?idrekam=" + selectedId;
        }
    });
</script>
@endpush
@endsection