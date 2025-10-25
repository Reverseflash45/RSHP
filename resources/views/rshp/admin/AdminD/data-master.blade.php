<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Halaman Admin - Data Master</title>
<style>
:root { --gold:#f5b301; --blue:#163491; --text:#111; --bg:#f9f9f9; }
*{margin:0;padding:0;box-sizing:border-box}
body{min-height:100vh;display:flex;flex-direction:column;font-family:Arial,sans-serif;background:var(--bg);color:var(--text)}
.header{background:#fff;padding:16px;text-align:center;border-bottom:2px solid var(--gold)}
.header img{max-height:80px;width:auto}
.nav-atas{display:flex;justify-content:center;gap:30px;padding:14px 0;background:var(--gold)}
.nav-atas a,.nav-atas button{color:#fff;text-decoration:none;padding:8px 16px;border-radius:6px;font-weight:600;transition:.2s;background:transparent;border:none;cursor:pointer;font-size:15px}
.nav-atas a:hover,.nav-atas button:hover{background:var(--blue)}
.card-container{display:flex;justify-content:center;align-items:flex-start;flex-wrap:wrap;gap:24px;margin:40px auto;max-width:1080px;padding:0 20px}
.card{background:#fff;border:2px solid var(--gold);border-radius:12px;text-align:center;text-decoration:none;color:var(--text);width:220px;padding:20px;transition:.3s;box-shadow:0 3px 6px rgba(0,0,0,.1)}
.card img{max-width:80px;margin-bottom:15px}
.card-title{font-size:18px;font-weight:bold;color:var(--blue)}
.card:hover{transform:translateY(-5px);border-color:var(--blue)}
footer{margin-top:auto;background:var(--blue);color:#fff;text-align:center;padding:24px 16px;font-size:15px;line-height:1.6}
footer h3{margin-bottom:6px;font-size:16px;font-weight:700}
</style>
</head>
<body>

<div class="header">
<img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo Universitas Airlangga RSHP">
</div>

<nav class="nav-atas">
<a href="{{ route('admin.dashboard') }}">Home</a>
<a href="{{ route('admin.data-master') }}">Data Master</a>
<form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf
    <button type="submit">Logout</button>
</form>
</nav>

<div class="card-container">
<a href="{{ route('admin.user.index') }}" class="card">
    <img src="https://images.icon-icons.com/2596/PNG/512/data_user_icon_155513.png" alt="Data User">
    <div class="card-title">Data User</div>
</a>

<a href="{{ route('admin.role-user.index') }}" class="card">
    <img src="https://icons.veryicon.com/png/o/miscellaneous/tymon/role-management-15.png" alt="Manajemen Role">
    <div class="card-title">Manajemen Role</div>
</a>

<a href="{{ route('admin.jenis-hewan.index') }}" class="card">
    <img src="https://images.icon-icons.com/2385/PNG/512/animal_icon_144556.png" alt="Jenis Hewan">
    <div class="card-title">Jenis Hewan</div>
</a>

<a href="{{ route('admin.ras.index') }}" class="card">
    <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="Ras Hewan">
    <div class="card-title">Ras Hewan</div>
</a>

<a href="{{ route('admin.pemilik.index') }}" class="card">
    <img src="https://i.pinimg.com/1200x/5c/81/38/5c81386c154a9112c57fa51400597c67.jpg" alt="Data Pemilik">
    <div class="card-title">Data Pemilik</div>
</a>

<a href="{{ route('admin.pet.index') }}" class="card">
    <img src="https://i.pinimg.com/1200x/f2/13/bc/f213bcbb3ce6e88e10957d3939cbce02.jpg" alt="Data Pet">
    <div class="card-title">Data Pet</div>
</a>

<a href="{{ route('admin.kategori.index') }}" class="card">
    <img src="https://i.pinimg.com/1200x/c2/12/9f/c2129fe4c287aad4b62c2c3cd08d0818.jpg" alt="Data Kategori">
    <div class="card-title">Data Kategori</div>
</a>

<a href="{{ route('admin.kategori-klinis.index') }}" class="card">
    <img src="https://i.pinimg.com/1200x/d9/c0/3b/d9c03b4305dbf1f6adb89874e70b3df4.jpg" alt="Data Kategori Klinis">
    <div class="card-title">Data Kategori Klinis</div>
</a>

<a href="{{ route('admin.kode-tindakan.index') }}" class="card">
    <img src="https://i.pinimg.com/1200x/77/ea/e2/77eae2c43699dbcdb57b09e341e3fb50.jpg" alt="Data Kode Tindakan Terapi">
    <div class="card-title">Kode Tindakan Terapi</div>
</a>
</div>

<footer>
<h3>© 2025 Rumah Sakit Hewan Pendidikan - Universitas Airlangga</h3>
<p>All rights reserved.</p>
</footer>
</body>
</html>
