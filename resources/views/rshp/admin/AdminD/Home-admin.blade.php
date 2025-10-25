<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Halaman Admin RSHP Unair">
    <meta name="keywords" content="RSHP Unair, Halaman Admin">
    <meta name="author" content="Rafi">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>

    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f4f6f9;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    nav {
        background-color: #f5b301;
        padding: 15px;
        display: flex;
        justify-content: center;
        gap: 30px;
    }
    nav a, nav button {
        color: white;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s;
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 15px;
    }
    nav a:hover, nav button:hover { color: #ff9900; }

    .header {
        background-color: white;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 2px solid #002080;
    }
    .header img {
        max-height: 85px;
        width: auto;
        display: block;
        margin: 0 auto;
    }

    .content {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
    }
    .welcome-box {
        background-color: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 15px #0000001a;
        text-align: center;
        max-width: 600px;
        width: 100%;
    }
    .welcome-box h2 {
        color: #0c5b2cff;
        margin-bottom: 10px;
    }
    .welcome-box p {
        font-size: 1.1rem;
        color: #333;
    }

    footer {
        background-color: rgb(2, 3, 129);
        color: white;
        text-align: center;
        padding: 20px;
        margin-top: 200px;
        font-size: 14px;
        line-height: 1.6;
    }
    footer h3 { margin: 0 0 10px; }
    </style>
</head>
<body>

    <div class="header">
        <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp"
             alt="Logo Universitas Airlangga RSHP">
    </div>

    <!-- Navigasi -->
    <nav>
        <a href="{{ route('admin.data-master') }}">Data Master</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>

    <div class="content">
        <div class="welcome-box">
            <h2>Halo, Admin!</h2>
            <p>Selamat datang di halaman admin RSHP Universitas Airlangga.</p>
        </div>
    </div>

    <footer>
        <h3>© 2025 Rumah Sakit Hewan Pendidikan - Universitas Airlangga</h3>
        <p>All rights reserved.</p>
    </footer>

</body>
</html>
