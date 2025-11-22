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
    padding: 20px 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 2px solid #002080;
}

.rshp-admin-header img {
    max-height: 85px;
    width: auto;
    display: block;
}

.rshp-admin-logout {
    display: flex;
    align-items: center;
}

.rshp-admin-logout form {
    margin: 0;
}

.rshp-admin-logout button {
    background-color: #002080;
    color: #ffffff;
    border: none;
    padding: 10px 18px;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s;
}

.rshp-admin-logout button:hover {
    background-color: #0040c1;
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
    padding: 50px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 600px;
    width: 100%;
    animation: fadeIn 0.6s ease-in-out;
}

.rshp-admin-box h2 {
    color: #0c5b2c;
    margin-bottom: 15px;
    font-size: 2rem;
}

.rshp-admin-box p {
    font-size: 1.2rem;
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

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<div class="rshp-admin-page">
    <div class="rshp-admin-header">
        <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo Universitas Airlangga RSHP">
        <div class="rshp-admin-logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

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