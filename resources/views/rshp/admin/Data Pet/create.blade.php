@extends('layouts.lte.main')

@section('title', 'Tambah Pet')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Tambah Pet</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.pet.index') }}">Pet</a></li>
          <li class="breadcrumb-item active">Tambah</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">

    @if(session('msg'))
      <div class="alert alert-{{ session('type') === 'success' ? 'success' : 'danger' }}">
        {{ session('msg') }}
      </div>
    @endif

    <div class="card">
      <div class="card-header bg-dark text-white fw-semibold">
        Form Tambah Pet
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('admin.pet.store') }}">
          @csrf
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Nama Pet</label>
              <input name="nama" value="{{ old('nama') }}" class="form-control" required>
              @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-6">
              <label class="form-label">Pemilik</label>
              <select name="idpemilik" class="form-control" required>
                <option value="">- Pilih Pemilik -</option>
                @foreach($pemilik as $p)
                  <option value="{{ $p->idpemilik }}" {{ old('idpemilik') == $p->idpemilik ? 'selected' : '' }}>
                    {{ $p->nama }}
                  </option>
                @endforeach
              </select>
              @error('idpemilik') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Ras</label>
              <select name="idras" class="form-control" required>
                <option value="">- Pilih Ras -</option>
                @foreach($ras as $r)
                  <option value="{{ $r->idras }}" {{ old('idras') == $r->idras ? 'selected' : '' }}>
                    {{ $r->nama_ras }}
                  </option>
                @endforeach
              </select>
              @error('idras') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-md-6">
              <label class="form-label">Jenis Hewan</label>
              <select name="idjenis" class="form-control" required>
                <option value="">- Pilih Jenis -</option>
                @foreach($jenis as $j)
                  <option value="{{ $j->idjenis }}" {{ old('idjenis') == $j->idjenis ? 'selected' : '' }}>
                    {{ $j->nama_jenis }}
                  </option>
                @endforeach
              </select>
              @error('idjenis') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-control">
            @error('tanggal_lahir') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <button class="btn btn-primary">Simpan</button>
          <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>

  </div>
</section>
@endsection