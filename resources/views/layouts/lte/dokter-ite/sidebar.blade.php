<aside class="app-sidebar" id="appSidebar">
    <div class="app-sidebar-brand">
        <div class="app-sidebar-logo">D</div>
        <span>RSHP Dokter</span>
    </div>

    <div class="app-sidebar-section-title">Aktivitas</div>
    <ul class="app-sidebar-menu">
        <li>
            <a href="{{ route('dokter.dashboard') }}"
               class="app-sidebar-link {{ request()->routeIs('dokter.dashboard') ? 'active' : '' }}">
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('dokter.temu-dokter') }}"
               class="app-sidebar-link {{ request()->routeIs('dokter.temu-dokter') ? 'active' : '' }}">
                <span>Temu Dokter</span>
            </a>
        </li>
        <li>
            <a href="{{ route('dokter.rekam-medis') }}"
               class="app-sidebar-link {{ request()->routeIs('dokter.rekam-medis') ? 'active' : '' }}">
                <span>Rekam Medis</span>
            </a>
        </li>
    </ul>

    <div class="app-sidebar-section-title">Lainnya</div>
    <ul class="app-sidebar-menu">
        <li>
            <a href="{{ route('site.home') }}" class="app-sidebar-link">
                <span>Website RSHP</span>
            </a>
        </li>
    </ul>
</aside>
