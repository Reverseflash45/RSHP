{{-- resources/views/rshp/perawat/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Perawat | RSHP UNAIR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        :root {
            --kuning: #f5b301;
            --biru: #020381;
            --bg: #f4f6f9;
        }
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .header {
            background-color: #fff;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 2px solid #002080;
        }
        .header img {
            max-height: 85px;
            width: auto;
            display: block;
        }
        nav {
            background-color: var(--kuning);
            padding: 15px;
            display: flex;
            justify-content: center;
            gap: 30px;
            box-shadow: 0 2px 6px rgba(0,0,0,.08);
        }
        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: .2s;
        }
        nav a:hover {
            color: #ff9900;
        }
        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }
        .welcome-box {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px #0000001a;
            text-align: center;
            max-width: 600px;
            width: 100%;
        }
        .welcome-box h2 {
            color: #0c5b2c;
            margin-bottom: 10px;
        }
        .welcome-box p {
            font-size: 1.05rem;
            color: #333;
        }
        footer {
            background-color: var(--biru);
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 14px;
            line-height: 1.6;
            margin-top: auto;
        }
        footer h3 { margin: 0 0 10px; }

        @media (max-width: 720px) {
            .welcome-box {
                padding: 25px 18px;
            }
            nav {
                flex-wrap: wrap;
                gap: 12px;
            }
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo Universitas Airlangga RSHP">
    </div>

    {{-- NAVBAR --}}
    <nav>
        <a href="{{ route('perawat.dashboard') }}">Home</a>

        {{-- ini kamu tadi link ke ./rekam_medis_index.php.
             karena di route-mu belum ada, aku pakai url() biar gak error. --}}
        <a href="{{ url('perawat/rekam-medis') }}">Rekam Medis</a>

        {{-- logout laravel --}}
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </nav>

    {{-- CONTENT --}}
    <div class="content">
        <div class="welcome-box">
            <h2>Halo, {{ auth()->user()->nama ?? 'Perawat' }}!</h2>
            <p>Selamat datang di halaman perawat RSHP Universitas Airlangga.</p>
        </div>
    </div>

    {{-- FOOTER --}}
    <footer>
        <h3>© {{ date('Y') }} Rumah Sakit Hewan Pendidikan - Universitas Airlangga</h3>
        <p>All rights reserved.</p>
    </footer>

</body>
</html>
