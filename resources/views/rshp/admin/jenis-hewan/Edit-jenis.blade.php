@extends('layouts.lte.main')

@section('title', 'Edit Jenis Hewan')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Jenis Hewan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.jenis-hewan.index') }}">Jenis Hewan</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        @if(session('msg'))
            <div class="alert alert-{{ session('type') === 'success' ? 'success' : 'danger' }} alert-dismissible fade show">
                {{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Jenis Hewan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.jenis-hewan.update', $item->getKey()) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama_jenis_hewan" class="form-label">Nama Jenis Hewan</label>
                        <input
                            type="text"
                            id="nama_jenis_hewan"
                            name="nama_jenis_hewan"
                            class="form-control @error('nama_jenis_hewan') is-invalid @enderror"
                            value="{{ old('nama_jenis_hewan', $item->nama_jenis_hewan) }}"
                            required
                        >
                        @error('nama_jenis_hewan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
@endsection
