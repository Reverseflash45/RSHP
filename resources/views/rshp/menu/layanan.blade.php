{{-- resources/views/layanan.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Layanan Publik - RSHP Universitas Airlangga</title>

<style>
:root{
--blue:#163491;
--blue-ink:#0c4a6e;
--text:#222;
--bg:#f7f9fb;
--line:#e6e8ef;
--card:#ffffff;
--yellow:#f5b301;
--yellow-2:#ffd24d;
--muted:#6b7280;
--radius:14px;
--shadow:0 10px 30px rgba(17,24,39,.08);
}

/* ====== BASE (sesuai punyamu, dipoles dikit) ====== */
*{box-sizing:border-box;margin:0;padding:0}
body{background:var(--bg);color:var(--text);font-family:Arial,Helvetica,sans-serif}
a{text-decoration:none}
img{display:block;max-width:100%}
.wrap{margin:0 auto;max-width:1180px;width:92%}

/* Topnav: 4 menu */
.topnav{background:var(--blue)}
.topnav .wrap{align-items:center;display:flex;gap:22px;height:48px;justify-content:center}
.topnav a{border-radius:8px;color:#fff;padding:10px 14px;font-weight:600;transition:background .2s ease,transform .15s ease}
.topnav a:hover{background:rgba(255,255,255,.12);transform:translateY(-1px)}

/* Mast / Header */
.mast{background:#fff}
.mast .wrap{
align-items:center;border-bottom:1px solid var(--line);display:flex;
gap:28px;justify-content:center;padding:18px 0
}
.mast .title{color:#111;font-size:28px;font-weight:800;letter-spacing:.3px;white-space:nowrap}
.logo-unair{height:70px;object-fit:contain}
.logo-rshp{height:72px;object-fit:contain}

/* Section & Card */
.section{padding:28px 0}
.card{
background:var(--card);border:1px solid var(--line);border-radius:var(--radius);padding:18px;
box-shadow:var(--shadow)
}

/* Headings & text */
h2{color:var(--blue-ink);font-size:30px;margin-bottom:14px;font-weight:800;letter-spacing:.2px}
.lead{color:var(--muted);font-size:14px;margin:-6px 0 10px}
h3{
color:var(--blue-ink);font-size:22px;margin:14px 0 10px;font-weight:800;
display:flex;align-items:center;gap:10px;
}
h3::before{
content:"";width:8px;height:22px;border-radius:6px;
background:linear-gradient(135deg,var(--yellow),var(--yellow-2));
}
h4{color:var(--blue-ink);font-size:18px;margin:12px 0 6px;font-weight:700}
p{line-height:1.7;margin:8px 0}
ul{margin:10px 0 10px 20px}
li{line-height:1.6;margin:6px 0}
li::marker{color:var(--blue-ink)}

/* Sub-section wrapper (aksen kuning halus) */
.block{
background:#fff; border:1px solid var(--line); border-radius:12px; padding:14px;
position:relative; overflow:hidden; margin-top:10px;
}
.block::after{
content:""; position:absolute; inset:0 0 auto; height:4px;
background:linear-gradient(90deg,var(--yellow),var(--yellow-2));
}

/* List mayor jadi kolom responsif */
.columns-2{columns:2; column-gap:24px}
@media(max-width:860px){ .columns-2{columns:1} }

/* Footer */
.footer{color:#666;padding:18px 0;text-align:center}

/* Responsive tweaks */
@media(max-width:860px){
.mast .title{font-size:22px}
}
</style>
</head>
<body>

<!-- NAVIGATION (4 menu sesuai instruksi) -->
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
<div class="title">LAYANAN PUBLIK RSHP UNAIR</div>
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOVNcKuyK1wQAPxHcua9RINMjgomwbctohdQ&s" alt="RSHP" class="logo-rshp">
</div>
</header>

<!-- MAIN -->
<main class="wrap">
<section id="layanan" class="section card">
<h2>Layanan Publik</h2>
<p class="lead">Ringkasan layanan inti RSHP UNAIR untuk hewan kesayangan dan rujukan klinis.</p>

<!-- Poliklinik -->
<div class="block">
    <h3>Poliklinik</h3>
    <p style="text-align:justify">
    Poliklinik adalah layanan rawat jalan dimana pelayanan kesehatan hewan dilakukan tanpa pasien menginap.
    Poliklinik melayani tindakan observasi, diagnosis, pengobatan, rehabilitasi medik, serta pelayanan
    kesehatan lainnya seperti permintaan surat keterangan sehat. Tindakan observasi dan diagnosis, juga
    bisa diteguhkan dengan berbagai macam pemeriksaan yang bisa kami lakukan, misalnya pemeriksaan sitologi,
    dermatologi, hematologi, atau pemeriksaan radiologi, ultrasonografi, bahkan pemeriksaan elektrokardiografi.
    </p>
    <p style="text-align:justify">
    Bilamana diperlukan pemeriksaan-pemeriksaan lain yang diperlukan seperti pemeriksaan kultur bakteri,
    atau pemeriksaan jaringan/histopatologi, dan lain-lain kami bekerja sama dengan Fakultas Kedokteran
    Hewan Universitas Airlangga untuk membantu melakukan pemeriksaan-pemeriksaan tersebut. Selain itu kami
    mempunyai rapid test untuk pemeriksaan cepat, untuk meneguhkan diagnosa penyakit-penyakit berbahaya
    pada kucing seperti panleukopenia, calicivirus, rhinotracheitis, FIP, dan pada anjing seperti parvovirus,
    canine distemper.
    </p>
    <p style="font-weight:700;margin-top:8px">Layanan kesehatan hewan di poliklinik yang kami lakukan antara lain:</p>
    <ul>
    <li>Rawat Jalan</li>
    <li>Vaksinasi</li>
    <li>Akupuntur</li>
    <li>Kemoterapi</li>
    <li>Fisioterapi</li>
    <li>Mandi Terapi</li>
    </ul>
</div>

<!-- Rawat Inap -->
<div class="block">
    <h3>Rawat Inap</h3>
    <p style="text-align:justify">
    Rawat inap dilakukan pada pasien-pasien yang berat atau parah dan membutuhkan perawatan intensif.
    Pasien akan diobservasi dan mendapat perawatan intensif di bawah pengawasan dokter dan paramedis
    yang handal. Sebelum rawat inap, klien wajib mengisi inform konsen yang artinya klien telah diberi
    penjelasan yang detail tentang kondisi penyakit pasien dan menyetujui rencana terapi yang akan dijalankan
    sepengetahuan klien. Klien juga diberitahu biaya yang dibebankan untuk semua layanan. RSHP menerima
    pembayaran tunai maupun kartu debit bank.
    </p>
</div>

<!-- Bedah -->
<div class="block">
    <h3>Bedah</h3>

    <h4>Tindakan Bedah Minor:</h4>
    <ul>
    <li>Jahit Luka</li>
    <li>Kastrasi</li>
    <li>Othematoma</li>
    <li>Scaling - Root Planning</li>
    <li>Ekstraksi Gigi</li>
    </ul>

    <h4 style="margin-top:10px">Tindakan Bedah Mayor:</h4>
    <ul class="columns-2" style="max-width:1000px">
    <li>Gastrotomi; Entrotomi; Enterektomi; Salivary mucocele</li>
    <li>Ovariohisterektomi; Sectio caesar; Piometra</li>
    <li>Sistotomi; Urethrostomi</li>
    <li>Fraktur Tulang</li>
    <li>Hernia Diafragmatika</li>
    <li>Hernia Perinealis</li>
    <li>Hernia Inguinalis</li>
    <li>Eksisi Tumor</li>
    </ul>
</div>

</section>
</main>

<!-- FOOTER -->
<footer class="footer">
<p>&copy; {{ date('Y') }} RSHP - Rumah Sakit Hewan Pendidikan Universitas Airlangga</p>
<p style="color:#888;margin-top:6px">Dibuat dengan semangat dan dedikasi untuk kesejahteraan hewan</p>
</footer>

</body>
</html>
