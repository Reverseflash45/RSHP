@extends('layouts.lte.main')

@section('title', 'Dashboard Admin')

@section('content')
<style>
.rshp-admin-page {
    font-family: 'Segoe UI', sans-serif;
    background-color: #f4f6f9;
    min-height: calc(100vh - 120px);
    display: flex;
    flex-direction: column;
}

.rshp-admin-header {
    background-color: #ffffff;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-bottom: 2px solid #002080;
}

.rshp-admin-header img {
    max-height: 85px;
    width: auto;
    display: block;
}

.rshp-admin-nav {
    background-color: #f5b301;
    padding: 15px;
    display: flex;
    justify-content: center;
    gap: 30px;
}

.rshp-admin-nav a,
.rshp-admin-nav button {
    color: #ffffff;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
    background: transparent;
    border: none;
    cursor: pointer;
    font-size: 15px;
}

.rshp-admin-nav a:hover,
.rshp-admin-nav button:hover {
    color: #ff9900;
}

.rshp-admin-content {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 20px;
}

.rshp-admin-box {
    background-color: #ffffff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 15px #0000001a;
    text-align: center;
    max-width: 600px;
    width: 100%;
}

.rshp-admin-box h2 {
    color: #0c5b2c;
    margin-bottom: 10px;
}

.rshp-admin-box p {
    font-size: 1.1rem;
    color: #333333;
}

.rshp-admin-footer {
    background-color: rgb(2, 3, 129);
    color: #ffffff;
    text-align: center;
    padding: 16px 20px;
    font-size: 14px;
    line-height: 1.6;
}

.rshp-admin-footer h3 {
    margin: 0 0 6px;
    font-size: 14px;
    font-weight: 600;
}

.rshp-admin-footer p {
    margin: 0;
    font-size: 12px;
}
</style>

<div class="rshp-admin-page">
    <div class="rshp-admin-header">
        <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo Universitas Airlangga RSHP">
    </div>

    <nav class="rshp-admin-nav">
        <a href="{{ route('admin.data-master') }}">Data Master</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>

    <div class="rshp-admin-content">
        <div class="rshp-admin-box">
            <h2>Halo, Admin!</h2>
            <p>Selamat datang di halaman admin RSHP Universitas Airlangga.</p>
        </div>
    </div>

    <footer class="rshp-admin-footer">
        <h3>© 2025 Rumah Sakit Hewan Pendidikan - Universitas Airlangga</h3>
        <p>All rights reserved.</p>
    </footer>
</div>
@endsection
