<nav class="navbar navbar-expand navbar-light bg-white app-navbar">
    <div class="container-fluid">
        <button class="btn btn-link d-lg-none" type="button" id="sidebarToggle">
            <span class="navbar-toggler-icon"></span>
        </button>

        <span class="navbar-text fw-semibold">Panel Dokter RSHP</span>

        <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item dropdown me-2">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    Dokter
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="px-3 py-1">
                            @csrf
                            <button type="submit" class="btn btn-link p-0">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
