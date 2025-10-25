{{-- resources/views/struktur.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Struktur Organisasi - RSHP Universitas Airlangga</title>

  <style>
  :root{
    --blue:#163491;
    --blue-ink:#0c4a6e;
    --text:#222;
    --bg:#f7f9fb;
    --line:#e6e8ef;
    --card:#ffffff;
    --muted:#6b7280;
    --radius:14px;
    --shadow:0 10px 30px rgba(17,24,39,.08);
  }

  /* ====== BASE (sesuai gaya kamu) ====== */
  *{box-sizing:border-box;margin:0;padding:0}
  body{background:var(--bg);color:var(--text);font-family:Arial,Helvetica,sans-serif;line-height:1.5}
  a{text-decoration:none;color:inherit}
  img{display:block;max-width:100%}
  .wrap{margin:0 auto;max-width:1180px;width:92%}
  .section{padding:28px 0}

  /* Topnav: 4 menu */
  .topnav{background:var(--blue)}
  .topnav .wrap{display:flex;align-items:center;gap:22px;height:48px;justify-content:center}
  .topnav a{color:#fff;padding:10px 14px;border-radius:8px;font-weight:600;transition:background .2s ease,transform .15s ease}
  .topnav a:hover{background:rgba(255,255,255,.12);transform:translateY(-1px)}

  /* Mast / Header */
  .mast{background:#fff}
  .mast .wrap{
    display:flex;align-items:center;justify-content:center;gap:28px;
    padding:18px 0;border-bottom:1px solid var(--line)
  }
  .mast .title{color:#111;font-size:28px;font-weight:800;letter-spacing:.3px;white-space:nowrap}
  .logo-unair{height:70px;object-fit:contain}
  .logo-rshp{height:72px;object-fit:contain}

  /* Heading */
  h2{color:var(--blue-ink);font-size:30px;margin-bottom:14px;font-weight:800;letter-spacing:.2px}
  .lead{color:var(--muted);font-size:14px;margin:-6px 0 10px}

  /* Grid kartu pejabat */
  .grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
    gap:16px;
  }
  .person{
    background:var(--card);border:1px solid var(--line);border-radius:var(--radius);
    overflow:hidden;box-shadow:var(--shadow);transition:transform .2s ease, box-shadow .2s ease
  }
  .person:hover{transform:translateY(-4px);box-shadow:0 16px 36px rgba(17,24,39,.12)}
  .person img{width:100%;height:240px;object-fit:cover}
  .person .body{padding:14px;text-align:center}
  .person .role{color:var(--blue-ink);font-weight:800;margin-bottom:6px;font-size:18px}
  .person .name{color:#333;font-weight:600}

  /* Footer */
  .footer{color:#666;text-align:center;padding:18px 0}
  .footer small{color:#8b8f99}

  /* Responsive */
  @media(max-width:860px){
    .mast .title{font-size:22px}
  }
  </style>
</head>
<body>

  <!-- NAVIGATION -->
  <div class="topnav">
    <div class="wrap">
      <a href="{{ route('home') }}">Home</a>
      <a href="{{ route('struktur') }}">Struktur Organisasi</a>
      <a href="{{ route('layanan') }}">Layanan Publik</a>
      <a href="{{ route('visi-misi') }}">Visi Misi</a>
    </div>
  </div>

  <!-- HEADER -->
  <header class="mast">
    <div class="wrap">
      <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo Universitas Airlangga" class="logo-unair">
      <div class="title">STRUKTUR ORGANISASI RSHP UNAIR</div>
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOVNcKuyK1wQAPxHcua9RINMjgomwbctohdQ&s" alt="RSHP" class="logo-rshp">
    </div>
  </header>

  <!-- MAIN -->
  <main class="wrap">
    <section id="struktur" class="section">
      <h2>Struktur Organisasi</h2>
      <p class="lead">Susunan pimpinan dan manajemen RSHP Universitas Airlangga.</p>

      <div class="grid">
        <!-- Direktur -->
        <div class="person">
          <img src="https://unair.ac.id/wp-content/uploads/2024/04/Direktur-RSHP.webp" alt="Direktur RSHP">
          <div class="body">
            <div class="role">Direktur</div>
            <div class="name">Dr. Ira Sari Yudaniayanti, M.P., drh.</div>
          </div>
        </div>

        <!-- Wakil Direktur 1 -->
        <div class="person">
          <img src="https://rshp.unair.ac.id/wp-content/uploads/2023/03/Wakil-Direktur-I-RSHP.png" alt="Wakil Direktur 1 RSHP">
          <div class="body">
            <div class="role">Wakil Direktur 1</div>
            <div class="name">Dr. Nusidanto Triakso, M.P., drh.</div>
          </div>
        </div>

        <!-- Wakil Direktur 2 -->
        <div class="person">
          <img src="https://rshp.unair.ac.id/wp-content/uploads/2023/03/Wakil-Direktur-II-RSHP.png" alt="Wakil Direktur 2 RSHP">
          <div class="body">
            <div class="role">Wakil Direktur 2</div>
            <div class="name">Dr. Milyua Soneta S, M.Vet., drh.</div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="footer">
    <p>&copy; {{ date('Y') }} RSHP - Rumah Sakit Hewan Pendidikan Universitas Airlangga</p>
    <small>Dibuat dengan semangat dan dedikasi untuk kesejahteraan hewan</small>
  </footer>

</body>
</html>
