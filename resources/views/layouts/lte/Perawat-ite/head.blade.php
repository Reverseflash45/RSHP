<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RSHP Perawat')</title>

    <meta name="description" content="Dashboard Perawat RSHP Universitas Airlangga">
    <meta name="author" content="RSHP">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    :root{
        --sidebar-bg:#1f2933;
        --sidebar-active:#0f766e; /* beda dari admin */
        --brand-dot:#f5b301;
    }
    *{box-sizing:border-box}
    body{margin:0;font-family:system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;background:#f4f6f9;color:#212529}
    .app-layout{min-height:100vh;display:flex;flex-direction:column}
    .app-navbar{position:fixed;top:0;left:0;right:0;z-index:1030;border-bottom:1px solid #dee2e6}
    .app-wrapper{display:flex;margin-top:56px;min-height:calc(100vh - 56px)}
    .app-sidebar{width:240px;background:var(--sidebar-bg);color:#c2c7d0;display:flex;flex-direction:column;position:fixed;top:56px;bottom:0;left:0;overflow-y:auto}
    .app-sidebar-brand{padding:16px 20px;display:flex;align-items:center;gap:10px;border-bottom:1px solid rgba(255,255,255,.08)}
    .app-sidebar-brand span{font-weight:700;font-size:18px;color:#fff}
    .app-sidebar-logo{width:32px;height:32px;border-radius:50%;background:var(--brand-dot);display:inline-flex;align-items:center;justify-content:center;font-weight:800;color:#111827;font-size:16px}
    .app-sidebar-menu{list-style:none;padding:10px 0 20px;margin:0}
    .app-sidebar-menu li{margin:2px 0}
    .app-sidebar-link{display:flex;align-items:center;gap:10px;padding:10px 18px;color:#c2c7d0;text-decoration:none;font-size:14px;border-left:3px solid transparent;transition:.15s}
    .app-sidebar-link:hover{background:#111827;color:#fff}
    .app-sidebar-link.active{background:#111827;border-left-color:var(--sidebar-active);color:#fff;font-weight:700}
    .app-sidebar-section-title{padding:12px 18px 6px;font-size:11px;text-transform:uppercase;letter-spacing:.04em;color:#9ca3af}
    .app-content-wrapper{flex:1;margin-left:240px;padding:20px 24px 60px}
    .app-footer{margin-left:240px;padding:12px 24px;font-size:13px;color:#6c757d;border-top:1px solid #dee2e6;background:#fff}

    @media (max-width: 991.98px){
        .app-sidebar{width:220px;transform:translateX(-220px);transition:transform .2s ease}
        .app-sidebar.show{transform:translateX(0)}
        .app-content-wrapper{margin-left:0;padding-top:16px}
        .app-footer{margin-left:0}
    }
    </style>
</head>
