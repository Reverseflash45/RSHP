<aside class="app-sidebar" id="appSidebar">
    <div class="app-sidebar-brand">
        <div class="app-sidebar-logo">A</div>
        <span>RSHP</span>
    </div>

    <div class="app-sidebar-section-title">Main Menu</div>
    <ul class="app-sidebar-menu">
        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="app-sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.data-master') }}"
               class="app-sidebar-link {{ request()->routeIs('admin.data-master') ? 'active' : '' }}">
                <span>Master Data</span>
            </a>
        </li>

        <li>
            <a href="#"
               class="app-sidebar-link">
                <span>Rekam Medis</span>
            </a>
        </li>
    </ul>

    <div class="app-sidebar-section-title">Documentations</div>
    <ul class="app-sidebar-menu">
        <li>
            <a href="#" class="app-sidebar-link">
                <span>Manual Book</span>
            </a>
        </li>
        <li>
            <a href="#" class="app-sidebar-link">
                <span>FAQ</span>
            </a>
        </li>
    </ul>
</aside>
