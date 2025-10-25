{{-- resources/views/visi-misi.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Visi Misi & Tujuan - RSHP Universitas Airlangga</title>

  <style>
  :root{
    --blue:#163491;
    --blue-ink:#0c4a6e;
    --text:#222;
    --ink:#111;
    --bg:#f7f9fb;
    --line:#e6e8ef;
    --muted:#6b7280;
    --card:#fff;
    --yellow:#f5b301;
    --yellow-2:#ffd24d;
    --yellow-soft:#fff3bf;
    --radius:14px;
    --shadow:0 10px 30px rgba(17,24,39,.08);
  }

  /* ===== Base (matching “layanan”) ===== */
  *{box-sizing:border-box;margin:0;padding:0}
  body{background:var(--bg);color:var(--text);font-family:Arial,Helvetica,sans-serif;line-height:1.6}
  a{text-decoration:none;color:inherit}
  img{display:block;max-width:100%}
  .wrap{margin:0 auto;max-width:1180px;width:92%}
  .section{padding:28px 0}

  /* Topnav (4 menu) */
  .topnav{background:var(--blue)}
  .topnav .wrap{display:flex;align-items:center;justify-content:center;gap:22px;height:48px}
  .topnav a{color:#fff;padding:10px 14px;border-radius:8px;font-weight:600;transition:background .2s,transform .15s}
  .topnav a:hover{background:rgba(255,255,255,.12);transform:translateY(-1px)}

  /* Mast / Header */
  .mast{background:#fff}
  .mast .wrap{
    display:flex;align-items:center;justify-content:center;gap:28px;
    padding:18px 0;border-bottom:1px solid var(--line)
  }
  .mast .title{color:var(--ink);font-size:28px;font-weight:800;letter-spacing:.3px;white-space:nowrap}
  .logo-unair{height:70px;object-fit:contain}
  .logo-rshp{height:72px;object-fit:contain}

  /* Heading & lead */
  h2{color:var(--blue-ink);font-size:30px;font-weight:800;letter-spacing:.2px;margin-bottom:10px}
  .lead{color:var(--muted);font-size:14px;margin:-4px 0 12px}

  /* Table as modern card (selaras “layanan”) */
  .table-card{
    background:var(--card);border:1px solid var(--line);border-radius:var(--radius);
    box-shadow:var(--shadow);overflow:hidden;
  }
  table{border-collapse:separate;border-spacing:0;width:100%}
  th,td{padding:16px 18px;vertical-align:top}
  th{
    width:26%;
    background:linear-gradient(135deg,var(--yellow),var(--yellow-2));
    color:var(--ink);font-size:18px;font-weight:800;
    border-right:1px solid rgba(0,0,0,.06)
  }
  td{background:#fff}
  td p{line-height:1.7}
  td ul{margin:4px 0 4px 22px}
  td li{margin:6px 0;line-height:1.6}
  td li::marker{color:var(--blue-ink)}
  tr+tr th, tr+tr td{border-top:1px solid var(--line)}
  tbody tr:hover td{background:var(--yellow-soft)}
  tbody tr:hover th{filter:brightness(1.02)}

  /* Footer */
  .footer{color:#666;text-align:center;padding:18px 0}
  .footer small{color:#8b8f99}

  /* Responsive: baris jadi kartu */
  @media (max-width:860px){
    .mast .title{font-size:22px}
    th,td{display:block;width:100%}
    tr{display:block;border-bottom:1px solid var(--line)}
    th{border-right:0;border-bottom:1px dashed rgba(0,0,0,.08)}
    td{padding-top:12px}
    tbody tr:hover td{background:#fff}
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
      <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo Universitas Airlangga" class="logo-unair" />
      <div class="title">VISI MISI &amp; TUJUAN RSHP UNAIR</div>
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOVNcKuyK1wQAPxHcua9RINMjgomwbctohdQ&s" alt="RSHP" class="logo-rshp" />
    </div>
  </header>

  <!-- MAIN -->
  <main class="wrap">
    <section id="visimisi" class="section">
      <h2>Visi, Misi, dan Tujuan</h2>
      <p class="lead">Ringkasan arah kelembagaan RSHP UNAIR.</p>

      <div class="table-card">
        <table aria-label="Tabel Visi, Misi, dan Tujuan RSHP">
          <tbody>
            <tr>
              <th scope="row">Visi</th>
              <td>
                Menjadi rumah sakit hewan pendidikan yang unggul dalam pelayanan, pendidikan,
                dan penelitian untuk meningkatkan kesejahteraan hewan dan masyarakat.
              </td>
            </tr>
            <tr>
              <th scope="row">Misi</th>
              <td>
                <ul>
                  <li>Menyelenggarakan pelayanan kesehatan hewan yang paripurna dan berorientasi pada kesejahteraan hewan.</li>
                  <li>Mendukung pendidikan kedokteran hewan melalui praktik klinis dan riset berkualitas.</li>
                  <li>Mengembangkan penelitian yang berdampak bagi kesehatan hewan dan masyarakat.</li>
                </ul>
              </td>
            </tr>
            <tr>
              <th scope="row">Tujuan</th>
              <td>
                <ul>
                  <li>Meningkatkan mutu layanan dan keselamatan pasien hewan.</li>
                  <li>Menyediakan sarana pendidikan klinik yang terintegrasi.</li>
                  <li>Mendorong inovasi penelitian di bidang veteriner.</li>
                </ul>
              </td>
            </tr>
          </tbody>
        </table>
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
