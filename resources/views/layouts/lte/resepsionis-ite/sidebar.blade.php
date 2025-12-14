<aside class="sidebar">
  <div class="nav-section">MENU</div>

  <div class="nav-item">
    <a href="{{ route('resepsionis.dashboard') }}"
       class="{{ request()->is('resepsionis') ? 'active' : '' }}">
      <i class="fa-solid fa-house"></i> Dashboard
    </a>
  </div>

  <div class="nav-section">LAYANAN</div>

  <div class="nav-item">
    <a href="{{ route('resepsionis.temu-dokter') }}"
       class="{{ request()->is('resepsionis/temu-dokter') ? 'active' : '' }}">
      <i class="fa-solid fa-stethoscope"></i> Temu Dokter
    </a>
  </div>

  <div class="nav-item">
    <a href="{{ route('resepsionis.registrasi-pemilik') }}"
       class="{{ request()->is('resepsionis/registrasi-pemilik') ? 'active' : '' }}">
      <i class="fa-solid fa-user-plus"></i> Registrasi Pemilik
    </a>
  </div>

  <div class="nav-item">
    <a href="{{ route('resepsionis.registrasi-pet') }}"
       class="{{ request()->is('resepsionis/registrasi-pet') ? 'active' : '' }}">
      <i class="fa-solid fa-paw"></i> Registrasi Pet
    </a>
  </div>

  <div class="nav-section">INFO</div>

  <div class="nav-item">
    <a href="{{ route('site.home') }}">
      <i class="fa-solid fa-globe"></i> Halaman Publik
    </a>
  </div>
</aside>
