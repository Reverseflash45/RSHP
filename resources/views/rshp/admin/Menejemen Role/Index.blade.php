@extends('layouts.lte.main')

@section('title', 'Manajemen Role User')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Manajemen Role User</h1>
      </div>
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

    @if(session('msg'))
      <div class="alert alert-{{ session('type') === 'success' ? 'success' : 'danger' }}">
        {{ session('msg') }}
      </div>
    @endif

    <div class="card">
      <div class="card-header bg-dark text-white fw-semibold">
        Tabel User & Role
      </div>

      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-0">
            <thead class="bg-primary text-white">
              <tr>
                <th style="width:90px">ID User</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Roles</th>
              </tr>
            </thead>
            <tbody>
              @forelse($users as $u)
                @php
                  $uid   = is_array($u) ? $u['iduser'] : ($u->iduser ?? null);
                  $unama = is_array($u) ? $u['nama']   : ($u->nama   ?? null);
                  $uemail= is_array($u) ? $u['email']  : ($u->email  ?? null);
                  $roles = is_array($u) ? ($u['roles'] ?? []) : ($u->roles ?? []);
                @endphp
                <tr>
                  <td>{{ $uid }}</td>
                  <td>{{ $unama }}</td>
                  <td>{{ $uemail }}</td>
                  <td>
                    @if(!empty($roles))
                      @foreach($roles as $r)
                        @php
                          $idru  = is_array($r) ? $r['idrole_user'] : ($r->idrole_user ?? null);
                          $idrole= is_array($r) ? $r['idrole']      : ($r->idrole ?? null);
                          $nrole = is_array($r) ? $r['nama_role']   : ($r->nama_role ?? null);
                          $stat  = (int) (is_array($r) ? $r['status'] : ($r->status ?? 0));
                        @endphp
                        <div class="d-flex justify-content-between align-items-center border rounded p-2 mb-2 bg-light">
                          <div>
                            <strong>{{ $nrole }}</strong>
                            @if($stat === 1)
                              <span class="badge badge-success">Aktif</span>
                            @else
                              <span class="badge badge-danger">Tidak Aktif</span>
                            @endif
                          </div>
                          <div class="actions d-flex gap-2">
                            @if($stat === 1)
                              <form method="POST" action="{{ route('admin.role-user.deactivate') }}">
                                @csrf
                                <input type="hidden" name="idrole_user" value="{{ $idru }}">
                                <button type="submit" class="btn btn-danger btn-sm">Nonaktifkan</button>
                              </form>
                            @else
                              <form method="POST" action="{{ route('admin.role-user.activate') }}">
                                @csrf
                                <input type="hidden" name="idrole_user" value="{{ $idru }}">
                                <button type="submit" class="btn btn-success btn-sm">Aktifkan</button>
                              </form>
                            @endif

                            <form method="POST" action="{{ route('admin.role-user.makeActive') }}">
                              @csrf
                              <input type="hidden" name="idrole_user" value="{{ $idru }}">
                              <button type="submit" class="btn btn-primary btn-sm">Jadikan Role Aktif</button>
                            </form>
                          </div>
                        </div>
                      @endforeach
                    @else
                      <em>Belum memiliki role</em>
                    @endif

                    @if(!empty($role_options))
                      <div class="mt-2">
                        <form method="POST" action="{{ route('admin.role-user.add') }}" class="d-flex flex-wrap gap-2 align-items-center">
                          @csrf
                          <input type="hidden" name="iduser" value="{{ $uid }}">
                          <select name="idrole" class="form-control form-control-sm" required>
                            <option value="">— Pilih Role —</option>
                            @foreach($role_options as $opt)
                              @php
                                $rid = is_array($opt) ? $opt['idrole'] : ($opt->idrole ?? null);
                                $rnm = is_array($opt) ? $opt['nama_role'] : ($opt->nama_role ?? null);
                              @endphp
                              <option value="{{ $rid }}">{{ $rnm }}</option>
                            @endforeach
                          </select>
                          <button type="submit" class="btn btn-primary btn-sm">Tambah Role</button>
                        </form>
                      </div>
                    @endif
                  </td>
                </tr>
              @empty
                <tr><td colspan="4" class="text-center"><em>Belum ada user.</em></td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection