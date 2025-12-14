<!DOCTYPE html>
<html lang="id">
@include('layouts.lte.dokter-ite.head')

<body class="app-layout">
    @include('layouts.lte.dokter-ite.navbar')

    <div class="app-wrapper">
        @include('layouts.lte.dokter-ite.sidebar')

        <main class="app-content-wrapper">
            @yield('content')
        </main>
    </div>

    @include('layouts.lte.dokter-ite.footer')
</body>
</html>
