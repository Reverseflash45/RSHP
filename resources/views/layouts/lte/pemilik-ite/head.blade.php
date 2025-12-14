<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RSHP Pemilik')</title>

    <meta name="description" content="Dashboard Pemilik RSHP Universitas Airlangga">
    <meta name="author" content="RSHP">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        *{box-sizing:border-box}
        body{
            margin:0;
            font-family:system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;
            background:#f4f6f9;
            color:#212529;
        }

        .app-layout{min-height:100vh;display:flex;flex-direction:column}

        .app-navbar{
            position:fixed;top:0;left:0;right:0;
            z-index:1030;
            border-bottom:1px solid #dee2e6;
        }

        .app-wrapper{
            display:flex;
            margin-top:56px;
            min-height:calc(100vh - 56px);
        }

        /* PEMILIK THEME (beda dari admin/dokter) */
        .app-sidebar{
            width:240px;
            background:#2b2f36;
            color:#cbd5e1;
            display:flex;
            flex-direction:column;
            position:fixed;
            top:56px;bottom:0;left:0;
            overflow-y:auto;
        }

        .app-sidebar-brand{
            padding:16px 20px;
            display:flex;
            align-items:center;
            gap:10px;
            border-bottom:1px solid rgba(255,255,255,.08);
        }

        .app-sidebar-logo{
            width:34px;height:34px;border-radius:10px;
            background:#20c997; /* hijau pemilik */
            display:inline-flex;align-items:center;justify-content:center;
            font-weight:800;color:#0b1f17;font-size:16px;
        }

        .app-sidebar-brand span{
            font-weight:700;
            font-size:16px;
            color:#ffffff;
            letter-spacing:.2px;
        }

        .app-sidebar-section-title{
            padding:12px 18px 6px 18px;
            font-size:11px;
            text-transform:uppercase;
            letter-spacing:.08em;
            color:#94a3b8;
        }

        .app-sidebar-menu{
            list-style:none;
            padding:10px 0 20px 0;
            margin:0;
        }

        .app-sidebar-menu li{margin:2px 0}

        .app-sidebar-link{
            display:flex;
            align-items:center;
            gap:10px;
            padding:10px 18px;
            color:#cbd5e1;
            text-decoration:none;
            font-size:14px;
            border-left:3px solid transparent;
            transition:.15s ease;
        }

        .app-sidebar-link:hover{
            background:#1f2933;
            color:#fff;
        }

        .app-sidebar-link.active{
            background:#1f2933;
            border-left-color:#20c997;
            color:#fff;
            font-weight:700;
        }

        .app-content-wrapper{
            flex:1;
            margin-left:240px;
            padding:20px 24px 60px 24px;
        }

        .app-page-title{
            font-size:20px;
            font-weight:700;
            margin-bottom:16px;
        }

        .app-card{
            background:#fff;
            border-radius:10px;
            border:1px solid #dee2e6;
            padding:20px;
            box-shadow:0 1px 2px rgba(0,0,0,.05);
        }

        .app-footer{
            margin-left:240px;
            padding:12px 24px;
            font-size:13px;
            color:#6c757d;
            border-top:1px solid #dee2e6;
            background:#fff;
        }

        @media (max-width: 991.98px){
            .app-sidebar{
                position:fixed;
                width:220px;
                transform:translateX(-220px);
                transition:transform .2s ease;
            }
            .app-sidebar.show{transform:translateX(0)}
            .app-content-wrapper{margin-left:0;padding-top:16px}
            .app-footer{margin-left:0}
        }
    </style>
</head>
