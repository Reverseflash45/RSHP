@extends('layouts.lte.main')

@section('title', 'Master Data')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
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

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Master Data RSHP</span>
                <span class="text-muted small">Kelola referensi & data utama sistem</span>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-outline-primary w-100 text-start">
                            <div class="fw-semibold">Jenis Hewan</div>
                            <div class="small text-muted">Master jenis hewan</div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.ras.index') }}" class="btn btn-outline-primary w-100 text-start">
                            <div class="fw-semibold">Ras Hewan</div>
                            <div class="small text-muted">Ras per jenis hewan</div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.pemilik.index') }}" class="btn btn-outline-primary w-100 text-start">
                            <div class="fw-semibold">Pemilik</div>
                            <div class="small text-muted">Data pemilik hewan</div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.pet.index') }}" class="btn btn-outline-primary w-100 text-start">
                            <div class="fw-semibold">Pet</div>
                            <div class="small text-muted">Data hewan pasien</div>
                        </a>
                    </div>

                    <div class="col-12 mt-2 mb-1">
                        <hr>
                        <span class="text-muted small">Master Tindakan & Klinis</span>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-info w-100 text-start">
                            <div class="fw-semibold">Kategori Tindakan</div>
                            <div class="small text-muted">Grup tindakan terapi</div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-outline-info w-100 text-start">
                            <div class="fw-semibold">Kategori Klinis</div>
                            <div class="small text-muted">Pengelompokan klinis</div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.kode-tindakan.index') }}" class="btn btn-outline-info w-100 text-start">
                            <div class="fw-semibold">Kode Tindakan Terapi</div>
                            <div class="small text-muted">Detail tindakan</div>
                        </a>
                    </div>

                    <div class="col-12 mt-2 mb-1">
                        <hr>
                        <span class="text-muted small">User & Hak Akses</span>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary w-100 text-start">
                            <div class="fw-semibold">User</div>
                            <div class="small text-muted">Akun login sistem</div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.role-user.index') }}" class="btn btn-outline-secondary w-100 text-start">
                            <div class="fw-semibold">Role User</div>
                            <div class="small text-muted">Mapping user ↔ role</div>
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
@endsection
