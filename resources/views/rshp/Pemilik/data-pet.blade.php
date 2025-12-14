@extends('layouts.lte.pemilik-ite.main')

@section('title', 'Data Pet')

@section('content')
<div class="app-page-title">Data Pet Saya</div>

<div class="app-card">
    <p class="text-muted mb-3">
        Daftar hewan peliharaan yang terdaftar atas nama Anda.
    </p>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama Pet</th>
                <th>Jenis</th>
                <th>Ras</th>
                <th>Jenis Kelamin</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pets ?? [] as $i => $pet)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $pet->nama }}</td>
                    <td>{{ $pet->jenis ?? '-' }}</td>
                    <td>{{ $pet->ras ?? '-' }}</td>
                    <td>{{ $pet->jenis_kelamin == 'M' ? 'Jantan' : 'Betina' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Belum ada data pet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
