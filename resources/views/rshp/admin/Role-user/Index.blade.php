@extends('layouts.lte.main')

@section('title', 'Role User')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Role User</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card mb-3">
      <div class="card-header">
        Tambah Role ke User
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('admin.role-user.add') }}" class="row g-2">
          @csrf
          <div class="col-md-5">
            <select name="iduser" class="form-control" required>
              <option value="">Pilih User</option>
              @foreach($users as $u)
                <option value="{{ $u->iduser }}">{{ $u->nama }} ({{ $u->email }})</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <select name="idrole" class="form-control" required>
              <option value="">Pilih Role</option>
              @foreach($roles as $r)
                <option value="{{ $r->idrole }}">{{ $r->nama_role }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>

    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <span>Data Role User</span>

        <form method="GET" action="{{ route('admin.role-user.index') }}" class="d-flex" style="gap: 8px;">
          <div class="input-group input-group-sm">
            <input type="text"
                   name="q"
                   class="form-control"
                   value="{{ $q }}"
                   placeholder="Cari nama / email">
          </div>

          <select name="role" class="form-control form-control-sm" style="width:auto;">
            <option value="">Semua Role</option>
            @foreach($roles as $r)
              <option value="{{ $r->idrole }}" {{ (string)$roleId === (string)$r->idrole ? 'selected' : '' }}>
                {{ $r->nama_role }}
              </option>
            @endforeach
          </select>

          <select name="status" class="form-control form-control-sm" style="width:auto;">
            <option value="">Semua Status</option>
            <option value="1" {{ $status === '1' ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ $status === '0' ? 'selected' : '' }}>Nonaktif</option>
          </select>

          <button type="submit" class="btn btn-primary btn-sm">Filter</button>
          <a href="{{ route('admin.role-user.index') }}" class="btn btn-secondary btn-sm">Reset</a>
        </form>
      </div>

      <div class="card-body p-0">
        <table class="table table-bordered table-hover mb-0">
          <thead class="table-dark">
            <tr>
              <th style="width:70px;">ID</th>
              <th>Nama User</th>
              <th>Email</th>
              <th>Role</th>
              <th style="width:90px;">Status</th>
              <th style="width:260px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($list as $row)
              <tr>
                <td>#{{ $row->idrole_user }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->nama_role }}</td>
                <td>
                  @if($row->status == 1)
                    <span class="badge bg-success">Aktif</span>
                  @else
                    <span class="badge bg-secondary">Nonaktif</span>
                  @endif
                </td>
                <td>
                  <div class="d-flex" style="gap:4px; flex-wrap:wrap;">
                    <form method="POST" action="{{ route('admin.role-user.activate') }}">
                      @csrf
                      <input type="hidden" name="idrole_user" value="{{ $row->idrole_user }}">
                      <button type="submit" class="btn btn-sm btn-outline-success">
                        Aktifkan
                      </button>
                    </form>

                    <form method="POST" action="{{ route('admin.role-user.deactivate') }}">
                      @csrf
                      <input type="hidden" name="idrole_user" value="{{ $row->idrole_user }}">
                      <button type="submit" class="btn btn-sm btn-outline-secondary">
                        Nonaktifkan
                      </button>
                    </form>

                    <form method="POST" action="{{ route('admin.role-user.makeActive') }}">
                      @csrf
                      <input type="hidden" name="idrole_user" value="{{ $row->idrole_user }}">
                      <button type="submit" class="btn btn-sm btn-outline-primary">
                        Jadikan Role Utama
                      </button>
                    </form>

                    <form method="POST" action="{{ route('admin.role-user.delete') }}"
                          onsubmit="return confirm('Yakin ingin menghapus relasi role-user ini?')">
                      @csrf
                      <input type="hidden" name="idrole_user" value="{{ $row->idrole_user }}">
                      <button type="submit" class="btn btn-sm btn-danger">
                        Hapus
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center">
                  <em>Belum ada data role user.</em>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($list instanceof \Illuminate\Contracts\Pagination\Paginator ||
          $list instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
        <div class="card-footer">
        </div>
      @endif
    </div>

  </div>
</section>
@endsection
