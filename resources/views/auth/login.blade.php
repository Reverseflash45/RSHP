<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Login - RSHP Universitas Airlangga</title>
<style>
:root {
    --bg: #f8f9fa;
    --card-bg: #ffffff;
    --text: #1f2937;
    --muted: #6b7280;
    --border: #d1d5db;
    --brand: #0d6efd;
    --brand-hover: #0b5ed7;
    --focus-ring: rgba(64, 158, 255, 0.2);
    --danger-bg: #fee2e2;
    --danger-border: #fecaca;
    --danger-text: #b91c1c;
}
* { box-sizing: border-box; }
body {
    font-family: 'Segoe UI', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    background: var(--bg);
    color: var(--text);
}
.login-container {
    background: var(--card-bg);
    width: 350px;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,.1);
}
.brand {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin-bottom: 8px;
}
.brand img {
    width: 48px;
    height: 48px;
    object-fit: contain;
    border-radius: 6px;
}
h1 {
    text-align: center;
    font-size: 20px;
    font-weight: 700;
    margin: 0;
    color: #0f2e6e;
}
.subtitle {
    text-align: center;
    font-size: 12px;
    color: var(--muted);
    margin: 4px 0 20px;
}
label {
    display: block;
    margin: 15px 0 6px;
    font-size: 14px;
    font-weight: 600;
}
input[type=email],
input[type=password] {
    width: 100%;
    padding: 12px;
    border: 1px solid var(--border);
    border-radius: 8px;
    outline: none;
    font-size: 14px;
    transition: .2s;
}
input[type=email]:focus,
input[type=password]:focus {
    border-color: #409eff;
    box-shadow: 0 0 0 3px var(--focus-ring);
}
.row-between {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 8px;
    font-size: 13px;
    color: var(--muted);
    gap: 8px;
    flex-wrap: wrap;
}
.checkbox {
    display: flex;
    align-items: center;
    gap: 8px;
}
.checkbox input {
    width: 16px;
    height: 16px;
    accent-color: var(--brand);
}
.btn {
    width: 100%;
    margin-top: 18px;
    background: var(--brand);
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    text-align: center;
    display: inline-block;
}
.btn:hover {
    background: var(--brand-hover);
}
/* ini yang kita ubah */
.btn.secondary {
    background: #e5e7eb;
    color: #111;
    width: auto;
    padding: 10px 18px;
    margin-top: 14px;
    margin-left: auto;
    margin-right: auto;
    display: block;
}
.btn.secondary:hover {
    background: #d1d5db;
}
.error {
    background: var(--danger-bg);
    border: 1px solid var(--danger-border);
    color: var(--danger-text);
    padding: 8px 10px;
    border-radius: 8px;
    margin-top: 8px;
    font-size: 13px;
}
.help {
    text-align: center;
    font-size: 11px;
    color: var(--muted);
    margin-top: 16px;
}
</style>
</head>
<body>
<div class="login-container">
<div class="brand">
    <img src="https://unair.ac.id/wp-content/uploads/2025/07/cropped-UNAIR_SEAL_LOGO_2025_RGB-01-scaled-1.webp" alt="UNAIR">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOVNcKuyK1wQAPxHcua9RINMjgomwbctohdQ&s" alt="RSHP">
</div>
<h1>Login RSHP</h1>
<div class="subtitle">Universitas Airlangga</div>

{{-- pakai route bawaan laravel --}}
<form action="{{ route('login') }}" method="POST">
    @csrf

    @if($errors->has('login'))
        <div class="error">{{ $errors->first('login') }}</div>
    @endif

    <label for="email">Email / Nama</label>
    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    @error('email')
        <div class="error">{{ $message }}</div>
    @enderror

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>
    @error('password')
        <div class="error">{{ $message }}</div>
    @enderror

    <div class="row-between">
        <label class="checkbox">
        <input type="checkbox" name="remember"> Ingat saya
        </label>
    </div>

    <button type="submit" class="btn">Masuk</button>
    <a href="{{ route('site.home') }}" class="btn secondary">Kembali</a>
</form>

<div class="help">© 2025 RSHP Universitas Airlangga</div>
</div>
</body>
</html>
