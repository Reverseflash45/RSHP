<nav class="navbar navbar-expand navbar-light bg-white app-navbar">
    <div class="container-fluid">
        <button class="btn btn-link d-lg-none" type="button" id="sidebarToggle">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pemilik.dashboard') }}">Dashboard</a>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item dropdown me-3">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    {{ auth()->user()->nama ?? auth()->user()->name ?? 'Pemilik' }}
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
