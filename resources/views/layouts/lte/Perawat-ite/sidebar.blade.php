<aside class="app-sidebar" id="appSidebar">
    <div class="app-sidebar-brand">
        <div class="app-sidebar-logo">P</div>
        <span>RSHP Perawat</span>
    </div>

    <div class="app-sidebar-section-title">Main Menu</div>
    <ul class="app-sidebar-menu">
        <li>
            <a href="{{ route('perawat.dashboard') }}"
               class="app-sidebar-link {{ request()->routeIs('perawat.dashboard') ? 'active' : '' }}">
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{ route('perawat.rekam-medis.index') }}"
               class="app-sidebar-link {{ request()->routeIs('perawat.rekam-medis.*') ? 'active' : '' }}">
                <span>Rekam Medis</span>
            </a>
        </li>
    </ul>

    <div class="app-sidebar-section-title">Akun</div>
    <ul class="app-sidebar-menu">
        <li>
            <a href="{{ route('logout') }}"
               class="app-sidebar-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</aside>
