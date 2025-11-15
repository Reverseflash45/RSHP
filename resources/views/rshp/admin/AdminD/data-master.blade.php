@extends('layouts.lte.main')

@section('title', 'Master Data')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Master Data</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">Daftar Master</h3>
            </div>
            <div class="card-body">

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-outline-primary w-100 text-start">
                            Jenis Hewan
                        </a>
                    </div>

                    <div class="col-md-4 mb-3">
                        <a href="{{ route('admin.ras.index') }}" class="btn btn-outline-primary w-100 text-start">
                            Ras Hewan
                        </a>
                    </div>

                    <div class="col-md-4 mb-3">
                        <a href="{{ route('admin.pemilik.index') }}" class="btn btn-outline-primary w-100 text-start">
                            Pemilik
                        </a>
                    </div>

                    <div class="col-md-4 mb-3">
                        <a href="{{ route('admin.pet.index') }}" class="btn btn-outline-primary w-100 text-start">
                            Pet
                        </a>
                    </div>

                    <div class="col-md-4 mb-3">
                        <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-primary w-100 text-start">
                            Kategori Tindakan
                        </a>
                    </div>

                    <div class="col-md-4 mb-3">
                        <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-outline-primary w-100 text-start">
                            Kategori Klinis
                        </a>
                    </div>

                    <div class="col-md-4 mb-3">
                        <a href="{{ route('admin.kode-tindakan.index') }}" class="btn btn-outline-primary w-100 text-start">
                            Kode Tindakan Terapi
                        </a>
                    </div>

                    <div class="col-md-4 mb-3">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary w-100 text-start">
                            User
                        </a>
                    </div>

                </div>

            </div>
        </div>

    </div>
</section>
@endsection
