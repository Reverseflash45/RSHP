{{-- resources/views/rshp/resepsionis/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Resepsionis | RSHP UNAIR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        body {
            background-color: #f8f9fa;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .header {
            background: #fff;
            padding: 12px 10px;
            text-align: center;
            border-bottom: 3px solid #f5b301;
        }
        .header img {
            max-height: 80px;
        }
        nav {
            background-color: #f5b301;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            padding: 14px 20px;
            position: relative;
            box-shadow: 0 2px 6px rgba(0,0,0,.08);
        }
        nav a,
        nav .dropdown-btn {
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            padding: 8px 12px;
            transition: background .3s ease;
            cursor: pointer;
            border-radius: 6px;
        }
        nav a:hover,
        nav .dropdown-btn:hover {
            background-color: #e0a800;
        }
        .dropdown {
            position: relative;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            top: 110%;
            left: 0;
            background: #fff;
            min-width: 160px;
            border-radius: 6px;
            box-shadow: 0 4px 8px rgba(0,0,0,.15);
            overflow: hidden;
            z-index: 999;
        }
        .dropdown-content a {
            display: block;
            padding: 10px 14px;
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }
        .dropdown-content a:hover {
            background: #f5f5f5;
        }
        .dropdown.show .dropdown-content {
            display: block;
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
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,.1);
            text-align: center;
            max-width: 600px;
            width: 100%;
        }
        .welcome-box h2 {
            margin-bottom: 10px;
            color: #020381;
        }
        .welcome-box p {
            font-size: 1.05rem;
            color: #555;
        }
        footer {
            background: #020381;
            color: #fff;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }
        footer h3 {
            font-size: 1rem;
            margin-bottom: 6px;
        }
        footer p {
            font-size: .9rem;
            opacity: .9;
        }

        @media (max-width: 720px) {
            nav {
                flex-wrap: wrap;
                gap: 12px;
            }
            .welcome-box {
                padding: 24px 16px;
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
        <a href="{{ route('resepsionis.dashboard') }}">Home</a>

        {{-- ini aslinya ./edit_temudokter.php, kita ganti dulu ke url biasa
             nanti kalau kamu sudah bikin controller+route-nya tinggal ganti ke route('resepsionis.temu-dokter.index') --}}
        <a href="{{ url('resepsionis/temu-dokter') }}">Temu Dokter</a>

        <div class="dropdown" id="dropdownMenu">
            <span class="dropdown-btn" onclick="toggleDropdown()">Registrasi ▾</span>
            <div class="dropdown-content">
                <a href="{{ url('resepsionis/registrasi/pemilik') }}">Pemilik Baru</a>
                <a href="{{ url('resepsionis/registrasi/pet') }}">Pet Baru</a>
            </div>
        </div>

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
            <h2>Halo, {{ auth()->user()->nama ?? 'Resepsionis' }}!</h2>
            <p>Selamat datang di halaman Resepsionis RSHP Universitas Airlangga.</p>
        </div>
    </div>

    {{-- FOOTER --}}
    <footer>
        <h3>© {{ date('Y') }} Rumah Sakit Hewan Pendidikan - Universitas Airlangga</h3>
        <p>All rights reserved.</p>
    </footer>

    <script>
        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('show');
        }
        window.addEventListener('click', function (e) {
            const btn = e.target.closest('.dropdown-btn');
            const dd  = document.getElementById('dropdownMenu');
            if (!btn && dd) {
                dd.classList.remove('show');
            }
        });
    </script>

</body>
</html>
