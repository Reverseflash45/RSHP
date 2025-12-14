@extends('layouts.lte.resepsionis-ite.main')

@section('title', 'Temu Dokter')

@section('page')
  <div class="row g-3">
    <div class="col-12">
      <div class="card card-soft p-3">
        <h5 class="mb-1" style="font-weight:800;color:#020381;">Temu Dokter</h5>
        <div class="text-muted">Tambah antrian dan ubah status antrian hari ini.</div>
      </div>
    </div>

    <div class="col-12">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
      @endif
    </div>

    {{-- Form tambah antrian --}}
    <div class="col-12">
      <div class="card card-soft p-3">
        <h6 class="fw-bold mb-3">Tambah Antrian</h6>

        <form class="row g-2" method="POST" action="{{ route('resepsionis.temu-dokter.store') }}">
          @csrf
          <input type="hidden" name="act" value="add">

          <div class="col-md-5">
            <label class="form-label fw-bold">Pet</label>
            <select name="idpet" class="form-select" required>
              <option value="">— Pilih Pet —</option>
              @foreach($allPets as $p)
                @if(in_array($p->idpet, $activePetIds ?? [])) @continue @endif
                <option value="{{ $p->idpet }}">
                  {{ $p->nama_pet }} — Pemilik: {{ $p->nama_pemilik }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-5">
            <label class="form-label fw-bold">Dokter</label>
            <select name="idrole_user" class="form-select" required>
              <option value="">— Pilih Dokter —</option>
              @foreach($dokter as $d)
                <option value="{{ $d->idrole_user }}">{{ $d->nama_dokter }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2 d-flex align-items-end">
            <button class="btn btn-rshp w-100" type="submit">
              <i class="fa-solid fa-plus"></i> Daftar
            </button>
          </div>
        </form>
      </div>
    </div>

    {{-- Table antrian --}}
    <div class="col-12">
      <div class="card card-soft p-3">
        <h6 class="fw-bold mb-3">Antrian Hari Ini</h6>

        <div class="table-responsive">
          <table class="table table-sm align-middle">
            <thead>
              <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Pet</th>
                <th>Dokter</th>
                <th>Status</th>
                <th style="width:220px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($antrian as $row)
                @php
                  $txt = $row->status == 0 ? 'Menunggu' : ($row->status == 1 ? 'Selesai' : 'Batal');
                  $badge = $row->status == 0 ? 'secondary' : ($row->status == 1 ? 'success' : 'danger');
                @endphp
                <tr>
                  <td class="fw-bold">{{ $row->no_urut }}</td>
                  <td>{{ $row->waktu_daftar }}</td>
                  <td>{{ $row->nama_pet }}</td>
                  <td>{{ $row->nama_dokter }}</td>
                  <td><span class="badge bg-{{ $badge }}">{{ $txt }}</span></td>
                  <td class="d-flex gap-2">
                    <form method="POST" action="{{ route('resepsionis.temu-dokter.status') }}">
                      @csrf
                      <input type="hidden" name="idtemu" value="{{ $row->idtemu_dokter }}">
                      <input type="hidden" name="status" value="1">
                      <button class="btn btn-sm btn-success" type="submit">Selesai</button>
                    </form>

                    <form method="POST" action="{{ route('resepsionis.temu-dokter.status') }}"
                          onsubmit="return confirm('Batalkan antrian ini?')">
                      @csrf
                      <input type="hidden" name="idtemu" value="{{ $row->idtemu_dokter }}">
                      <input type="hidden" name="status" value="2">
                      <button class="btn btn-sm btn-danger" type="submit">Batal</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr><td colspan="6" class="text-center text-muted">Belum ada antrian.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
@endsection
