<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RSHP Dokter')</title>

    <meta name="description" content="Dashboard Dokter RSHP Universitas Airlangga">
    <meta name="author" content="RSHP">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background-color: #f3f6f4;
            color: #212529;
        }

        .app-layout {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .app-navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1030;
            border-bottom: 1px solid #dee2e6;
        }

        .app-wrapper {
            display: flex;
            margin-top: 56px;
            min-height: calc(100vh - 56px);
        }

        .app-sidebar {
            width: 240px;
            background-color: #0f3d2e; /* beda dari admin */
            color: #d7efe6;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 56px; bottom: 0; left: 0;
            overflow-y: auto;
        }

        .app-sidebar-brand {
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.10);
        }

        .app-sidebar-brand span {
            font-weight: 700;
            font-size: 18px;
            color: #ffffff;
        }

        .app-sidebar-logo {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #22c55e;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: #0f3d2e;
            font-size: 16px;
        }

        .app-sidebar-section-title {
            padding: 12px 18px 6px 18px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: rgba(255,255,255,0.65);
        }

        .app-sidebar-menu {
            list-style: none;
            padding: 10px 0 20px 0;
            margin: 0;
        }

        .app-sidebar-menu li { margin: 2px 0; }

        .app-sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            color: #d7efe6;
            text-decoration: none;
            font-size: 14px;
            border-left: 3px solid transparent;
            transition: background-color 0.15s ease, color 0.15s ease, border-color 0.15s ease;
        }

        .app-sidebar-link:hover {
            background-color: rgba(255,255,255,0.10);
            color: #ffffff;
        }

        .app-sidebar-link.active {
            background-color: rgba(255,255,255,0.12);
            border-left-color: #22c55e;
            color: #ffffff;
            font-weight: 700;
        }

        .app-content-wrapper {
            flex: 1;
            margin-left: 240px;
            padding: 20px 24px 60px 24px;
        }

        .app-card {
            background-color: #ffffff;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            padding: 18px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .app-footer {
            margin-left: 240px;
            padding: 12px 24px;
            font-size: 13px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
            background-color: #ffffff;
        }

        @media (max-width: 991.98px) {
            .app-sidebar {
                position: fixed;
                width: 220px;
                transform: translateX(-220px);
                transition: transform 0.2s ease;
            }
            .app-sidebar.show { transform: translateX(0); }

            .app-content-wrapper { margin-left: 0; padding-top: 16px; }
            .app-footer { margin-left: 0; }
        }
    </style>
</head>
