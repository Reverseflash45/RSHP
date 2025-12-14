@php
  $nama = auth()->user()->nama ?? 'Resepsionis';
  $initial = strtoupper(substr($nama, 0, 1));
@endphp

<nav class="main-header navbar navbar-expand navbar-white navbar-light"
     style="z-index:1050;">

  {{-- LEFT --}}
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link text-dark" data-widget="pushmenu" href="#">
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>

  {{-- RIGHT --}}
  <ul class="navbar-nav ms-auto align-items-center gap-2">

    {{-- USERBOX --}}
    <li class="nav-item">
      <div class="d-flex align-items-center gap-2 px-3 py-2"
           style="
             background:#fff7e5;
             border:1px solid #ffe0a6;
             border-radius:14px;
           ">
        <div class="d-flex justify-content-center align-items-center"
             style="
               width:34px;
               height:34px;
               border-radius:999px;
               background:#020381;
               color:#fff;
               font-weight:800;
             ">
          {{ $initial }}
        </div>

        <div style="line-height:1.1">
          <div style="font-weight:800;font-size:13px;color:#111827;">
            {{ $nama }}
          </div>
          <div style="font-size:11px;color:#92400e;font-weight:700;">
            Role: Resepsionis
          </div>
        </div>
      </div>
    </li>

    {{-- LOGOUT (FIXED & VISIBLE) --}}
    <li class="nav-item">
      <a href="{{ route('logout') }}"
         class="btn btn-sm btn-outline-danger"
         style="font-weight:700;"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </li>

  </ul>
</nav>
