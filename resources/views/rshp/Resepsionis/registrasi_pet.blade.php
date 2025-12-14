@extends('layouts.lte.resepsionis-ite.main')

@section('title', 'Registrasi Pet')

@section('page')
  <div class="row g-3">
    <div class="col-12">
      <div class="card card-soft p-3">
        <h5 class="mb-1" style="font-weight:800;color:#020381;">Registrasi Pet</h5>
        <div class="text-muted">Input data pet baru.</div>
      </div>
    </div>

    <div class="col-12">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
      @endif
    </div>

    <div class="col-12 col-lg-7">
      <div class="card card-soft p-3">
        <form method="POST" action="{{ route('resepsionis.registrasi-pet.store') }}">
          @csrf

          <div class="mb-2">
            <label class="form-label fw-bold">Nama Pet</label>
            <input class="form-control" name="nama" value="{{ old('nama') }}" required>
          </div>

          <div class="mb-2">
            <label class="form-label fw-bold">Tanggal Lahir</label>
            <input class="form-control" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
          </div>

          <div class="mb-2">
            <label class="form-label fw-bold">Warna / Tanda</label>
            <input class="form-control" name="warna_tanda" value="{{ old('warna_tanda') }}">
          </div>

          <div class="mb-2">
            <label class="form-label fw-bold">Jenis Kelamin</label>
            <select class="form-select" name="jenis_kelamin" required>
              <option value="M" {{ old('jenis_kelamin')=='M' ? 'selected' : '' }}>Jantan</option>
              <option value="F" {{ old('jenis_kelamin')=='F' ? 'selected' : '' }}>Betina</option>
            </select>
          </div>

          <div class="mb-2">
            <label class="form-label fw-bold">Pemilik</label>
            <select class="form-select" name="idpemilik" required>
              <option value="">— Pilih Pemilik —</option>
              @foreach($pemilik_list as $p)
                <option value="{{ $p->idpemilik }}" {{ old('idpemilik')==$p->idpemilik ? 'selected' : '' }}>
                  {{ $p->nama }} ({{ $p->email }})
                </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Ras Hewan</label>
            <select class="form-select" name="idras_hewan" required>
              <option value="">— Pilih Ras —</option>
              @foreach($ras_list as $r)
                <option value="{{ $r->idras_hewan }}" {{ old('idras_hewan')==$r->idras_hewan ? 'selected' : '' }}>
                  {{ $r->nama_ras }}{{ $r->nama_jenis_hewan ? ' - '.$r->nama_jenis_hewan : '' }}
                </option>
              @endforeach
            </select>
          </div>

          <button class="btn btn-rshp">
            <i class="fa-solid fa-floppy-disk"></i> Simpan
          </button>
          <a class="btn btn-outline-secondary" href="{{ route('resepsionis.dashboard') }}">Kembali</a>
        </form>
      </div>
    </div>
  </div>
@endsection
