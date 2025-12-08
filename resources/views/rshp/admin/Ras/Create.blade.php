@extends('layouts.lte.main')

@section('title', 'Tambah Ras Hewan')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Tambah Ras Hewan</h1>
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
            <div class="card-body">
                <form action="{{ route('admin.ras.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama Ras</label>
                        <input type="text" name="nama_ras" class="form-control" value="{{ old('nama_ras') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Hewan</label>
                        <select name="idjenis_hewan" class="form-control" required>
                            <option value="">-- Pilih Jenis Hewan --</option>
                            @foreach($jenisHewan as $j)
                                <option value="{{ $j->idjenis_hewan }}" @if(old('idjenis_hewan') == $j->idjenis_hewan) selected @endif>
                                    {{ $j->nama_jenis_hewan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.ras.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
