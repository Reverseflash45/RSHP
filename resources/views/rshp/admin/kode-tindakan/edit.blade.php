@extends('layouts.lte.main')

@section('title', 'Edit Kode Tindakan')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.kode-tindakan.index') }}">Kode Tindakan</a></li>
          <li class="breadcrumb-item active">Edit</li>
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
        Edit Kode Tindakan #{{ $item->idkode_tindakan_terapi }}
      </div>
      <div class="card-body">
        <form action="{{ route('admin.kode-tindakan.update', $item->idkode_tindakan_terapi) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label>Kode</label>
            <input type="text"
                   name="kode"
                   class="form-control"
                   value="{{ old('kode', $item->kode) }}"
                   maxlength="5"
                   required>
          </div>

          <div class="mb-3">
            <label>Deskripsi Tindakan Terapi</label>
            <textarea name="deskripsi_tindakan_terapi"
                      class="form-control"
                      rows="3"
                      required>{{ old('deskripsi_tindakan_terapi', $item->deskripsi_tindakan_terapi) }}</textarea>
          </div>

          <div class="mb-3">
            <label>Kategori</label>
            <select name="idkategori" class="form-control" required>
              @foreach($kategori as $k)
                <option value="{{ $k->idkategori }}" {{ old('idkategori', $item->idkategori) == $k->idkategori ? 'selected' : '' }}>
                  {{ $k->nama_kategori }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label>Kategori Klinis</label>
            <select name="idkategori_klinis" class="form-control" required>
              @foreach($klinis as $kk)
                <option value="{{ $kk->idkategori_klinis }}" {{ old('idkategori_klinis', $item->idkategori_klinis) == $kk->idkategori_klinis ? 'selected' : '' }}>
                  {{ $kk->nama_kategori_klinis }}
                </option>
              @endforeach
            </select>
          </div>

          <button type="submit" class="btn btn-primary">Update</button>
          <a href="{{ route('admin.kode-tindakan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>

  </div>
</section>
@endsection
