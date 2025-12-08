@extends('layouts.lte.main')

@section('title', 'Tambah Pet')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"></div>
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

    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card">
      <div class="card-header">
        Form Tambah Pet
      </div>
      <div class="card-body">
        <form action="{{ route('admin.pet.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label>Nama Pet</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
          </div>

          <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
          </div>

          <div class="mb-3">
            <label>Warna / Tanda</label>
            <input type="text" name="warna_tanda" class="form-control" value="{{ old('warna_tanda') }}">
          </div>

          <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
              <option value="">Pilih</option>
              <option value="M" {{ old('jenis_kelamin') === 'M' ? 'selected' : '' }}>Jantan</option>
              <option value="F" {{ old('jenis_kelamin') === 'F' ? 'selected' : '' }}>Betina</option>
            </select>
          </div>

          <div class="mb-3">
            <label>Pemilik</label>
            <select name="idpemilik" class="form-control" required>
              <option value="">Pilih Pemilik</option>
              @foreach($pemilik as $p)
                <option value="{{ $p->idpemilik }}" {{ old('idpemilik') == $p->idpemilik ? 'selected' : '' }}>
                  {{ $p->user->nama ?? 'Tanpa Nama' }} - {{ $p->user->email ?? '' }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label>Ras</label>
            <select name="idras_hewan" class="form-control" required>
              <option value="">Pilih Ras</option>
              @foreach($ras as $r)
                <option value="{{ $r->idras_hewan }}" {{ old('idras_hewan') == $r->idras_hewan ? 'selected' : '' }}>
                  {{ $r->nama_ras }} ({{ $r->jenis->nama_jenis_hewan ?? '-' }})
                </option>
              @endforeach
            </select>
          </div>

          <button type="submit" class="btn btn-primary">Simpan</button>
          <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>

  </div>
</section>
@endsection
