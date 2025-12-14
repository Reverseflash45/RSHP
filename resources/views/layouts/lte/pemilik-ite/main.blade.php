<!DOCTYPE html>
<html lang="id">
@include('layouts.lte.pemilik-ite.head')
<body class="app-layout">

    @include('layouts.lte.pemilik-ite.navbar')

    <div class="app-wrapper">
        @include('layouts.lte.pemilik-ite.sidebar')

        <main class="app-content-wrapper">
            @yield('content')
        </main>
    </div>

    @include('layouts.lte.pemilik-ite.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sidebar = document.getElementById('appSidebar');
            var toggle = document.getElementById('sidebarToggle');

            if (toggle && sidebar) {
                toggle.addEventListener('click', function () {
                    sidebar.classList.toggle('show');
                });
            }
        });
    </script>
</body>
</html>
