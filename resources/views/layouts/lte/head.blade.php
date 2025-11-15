<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RSHP Admin')</title>

    <meta name="description" content="Dashboard Admin RSHP Universitas Airlangga">
    <meta name="author" content="RSHP">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        background-color: #f4f6f9;
        color: #212529;
    }

    .app-layout {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .app-navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
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
        background-color: #343a40;
        color: #c2c7d0;
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 56px;
        bottom: 0;
        left: 0;
        overflow-y: auto;
    }

    .app-sidebar-brand {
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .app-sidebar-brand span {
        font-weight: 600;
        font-size: 18px;
        color: #ffffff;
    }

    .app-sidebar-logo {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #f5b301;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #343a40;
        font-size: 18px;
    }

    .app-sidebar-menu {
        list-style: none;
        padding: 10px 0 20px 0;
        margin: 0;
    }

    .app-sidebar-menu li {
        margin: 2px 0;
    }

    .app-sidebar-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 18px;
        color: #c2c7d0;
        text-decoration: none;
        font-size: 14px;
        border-left: 3px solid transparent;
        transition: background-color 0.15s ease, color 0.15s ease, border-color 0.15s ease;
    }

    .app-sidebar-link:hover {
        background-color: #1f2933;
        color: #ffffff;
    }

    .app-sidebar-link.active {
        background-color: #1f2933;
        border-left-color: #0d6efd;
        color: #ffffff;
        font-weight: 600;
    }

    .app-sidebar-section-title {
        padding: 12px 18px 6px 18px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #6c757d;
    }

    .app-sidebar-badge {
        margin-left: auto;
        font-size: 11px;
    }

    .app-content-wrapper {
        flex: 1;
        margin-left: 240px;
        padding: 20px 24px 60px 24px;
    }

    .app-page-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .app-card {
        background-color: #ffffff;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        padding: 20px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .app-footer {
        margin-left: 240px;
        padding: 12px 24px;
        font-size: 13px;
        color: #6c757d;
        border-top: 1px solid #dee2e6;
        background-color: #ffffff;
    }

    .table-app th,
    .table-app td {
        vertical-align: middle;
        font-size: 14px;
    }

    .table-app thead th {
        background-color: #f8f9fa;
        border-bottom-width: 1px;
        font-weight: 600;
    }

    .btn-xs {
        padding: 2px 8px;
        font-size: 12px;
        line-height: 1.4;
        border-radius: 4px;
    }

    @media (max-width: 991.98px) {
        .app-sidebar {
            position: fixed;
            width: 220px;
            transform: translateX(-220px);
            transition: transform 0.2s ease;
        }

        .app-sidebar.show {
            transform: translateX(0);
        }

        .app-content-wrapper {
            margin-left: 0;
            padding-top: 16px;
        }

        .app-footer {
            margin-left: 0;
        }
    }
    </style>
</head>
