{{-- resources/views/layouts/lte/pemilik-ite/sidebar.blade.php --}}

<aside class="app-sidebar" id="appSidebar">
    <div class="app-sidebar-brand">
        <div class="app-sidebar-logo">P</div>
        <span>RSHP Pemilik</span>
    </div>

    <div class="app-sidebar-section-title">Menu Pemilik</div>

    <ul class="app-sidebar-menu">
        <li>
            <a href="{{ route('pemilik.dashboard') }}"
               class="app-sidebar-link {{ request()->routeIs('pemilik.dashboard') ? 'active' : '' }}">
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{ route('pemilik.data-pet') }}"
               class="app-sidebar-link {{ request()->routeIs('pemilik.data-pet') ? 'active' : '' }}">
                <span>Data Pet</span>
            </a>
        </li>

        <li>
            <a href="{{ route('pemilik.rekam-medis') }}"
               class="app-sidebar-link {{ request()->routeIs('pemilik.rekam-medis') ? 'active' : '' }}">
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
