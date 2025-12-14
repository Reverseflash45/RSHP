<!doctype html>
<html lang="id">
<head>
  @include('layouts.lte.resepsionis-ite.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('layouts.lte.resepsionis-ite.navbar')
  @include('layouts.lte.resepsionis-ite.sidebar')

  <div class="content-wrapper">
    @yield('content')
  </div>

  @include('layouts.lte.resepsionis-ite.footer')

</div>

@stack('scripts')
</body>
</html>
