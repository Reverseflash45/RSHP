<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Tambah Jenis Hewan</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

{{-- Inline CSS --}}
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f9f9f9;
    color: #333;
}

.main {
    max-width: 600px;
    margin: 60px auto;
    padding: 20px;
}

.panel {
    background: #fff;
    padding: 20px 25px;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.panel h3 {
    margin-bottom: 15px;
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

input[type="text"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
    width: 100%;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    text-decoration: none;
    text-align: center;
    transition: all 0.25s ease;
}

.btn-primary {
    background-color: #2563eb;
    color: #fff;
}

.btn:hover {
    opacity: 0.9;
    transform: translateY(-2px);
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.12);
}

.badge {
    display: block;
    margin: 15px 0;
    padding: 10px;
    border-radius: 5px;
    font-weight: 500;
    text-align: center;
}

.badge.ok {
    background: #d1f5d3;
    color: #2d7a2f;
}

.badge.err {
    background: #f9d6d5;
    color: #a33a36;
}

.actions {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 15px;
}

a.btn {
    background: #6b7280;
    color: white;
}

a.btn:hover {
    opacity: 0.9;
}
</style>
</head>
<body>

<main class="main">
<div class="panel">
    <h3>Tambah Jenis Hewan</h3>

    {{-- Pesan sukses --}}
    @if (session('msg') && session('type') === 'success')
    <div class="badge ok">{{ session('msg') }}</div>
    <div class="actions">
        <a href="{{ route('admin.jenis-hewan.index') }}" class="btn">Kembali ke List</a>
    </div>

    {{-- Pesan error --}}
    @elseif (session('msg') && session('type') === 'error')
    <div class="badge err">{{ session('msg') }}</div>

    {{-- Form input --}}
    @else
    <form method="POST" action="{{ route('admin.jenis-hewan.store') }}">
        @csrf
        <input
        type="text"
        name="nama_jenis_hewan"
        placeholder="contoh: Kucing / Anjing / Kelinci"
        value="{{ old('nama_jenis_hewan') }}"
        required
        >

        @error('nama_jenis_hewan')
        <div class="badge err">{{ $message }}</div>
        @enderror

        <div class="actions">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.jenis-hewan.index') }}" class="btn">Batal</a>
        </div>
    </form>
    @endif
</div>
</main>

</body>
</html>
