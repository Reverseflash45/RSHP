@extends('layouts.app')

@section('content')
<div class="container">
  <h3>Form Input Data Dokter</h3>

  @if(session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
  @endif

  <form method="POST" action="{{ route('dokter.store') }}">
    @csrf
    <div class="mb-3">
      <label>Alamat</label>
      <input type="text" name="alamat" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>No HP</label>
      <input type="text" name="no_hp" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Bidang Dokter</label>
      <input type="text" name="bidang_dokter" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Jenis Kelamin</label>
      <select name="jenis_kelamin" class="form-control" required>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
    </div>
    <div class="mb-3">
      <label>ID User</label>
      <input type="number" name="id_user" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
  </form>
</div>
@endsection