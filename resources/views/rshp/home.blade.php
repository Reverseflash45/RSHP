{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>RSHP Universitas Airlangga — Statis</title>

<style>
*{box-sizing:border-box;margin:0;padding:0}
body{background:#f7f9fb;color:#222;font-family:Arial,Helvetica,sans-serif}
a{text-decoration:none}
img{display:block;max-width:100%}
.wrap{margin:0 auto;max-width:1180px;width:92%}

/* Topnav */
.topnav{background:#163491}
.topnav .wrap{align-items:center;display:flex;gap:22px;height:44px;justify-content:flex-start}
.topnav a{border-radius:4px;color:#fff;padding:10px 14px}
.topnav a:hover{background:rgba(255,255,255,.12)}

/* Mast */
.mast{background:#fff}
.mast .wrap{align-items:center;border-bottom:1px solid #e5e5e5;display:flex;gap:28px;justify-content:center;padding:16px 0}
.mast .title{color:#111;font-size:28px;font-weight:700;letter-spacing:.5px;white-space:nowrap}
.logo-unair{height:70px;object-fit:contain}
.logo-rshp{height:72px;object-fit:contain}

/* Section & components */
.section{padding:26px 0}
.hero{background:#fff;border-bottom:1px solid #e5e5e5}
.hero .wrap{display:grid;gap:22px;grid-template-columns:1fr 380px;padding:20px 0}
.hero h2{margin-bottom:8px}
.hero p{line-height:1.6;margin:10px 0 14px}

/* CTA */
.cta{display:flex;flex-wrap:wrap;gap:10px}
.btn{background:#f5b301;border-radius:22px;color:#111;font-weight:bold;padding:10px 16px}
.btn-out{background:transparent;border:2px solid #f5b301;border-radius:22px;color:#f5b301;font-weight:bold;padding:8px 14px}

/* YouTube */
.ytbox{background:#000;border:1px solid #ddd;border-radius:10px;height:220px;overflow:hidden}
.ytbox .hd{background:#0c4a6e;color:#fff;font-size:14px;font-weight:bold;padding:6px 10px}

/* Berita: slider horizontal tanpa JS */
.news h2{margin-bottom:10px}
.news-slider{position:relative}
.news-strip{
display:grid;grid-auto-flow:column;grid-auto-columns:300px;gap:16px;
overflow-x:auto;padding-bottom:6px;scroll-snap-type:x mandatory;
-webkit-overflow-scrolling:touch;scroll-behavior:smooth
}
.news-strip::-webkit-scrollbar{height:8px}
.news-strip::-webkit-scrollbar-track{background:transparent}
.news-strip::-webkit-scrollbar-thumb{background:#d7d7d7;border-radius:8px}
.news-card{background:#fff;border:1px solid #e5e5e5;border-radius:10px;overflow:hidden;display:block;scroll-snap-align:start}
.news-card img{aspect-ratio:16/9;object-fit:cover}
.news-card .body{padding:10px}
.news-card h3{color:#0c4a6e;margin-bottom:6px}

/* Map */
.map h2{margin-bottom:10px}
.mapbox{background:#fff;border:1px solid #e5e5e5;border-radius:10px;height:360px;overflow:hidden}

/* Footer */
.footer{color:#666;padding:16px 0;text-align:center}

/* Responsive */
@media(max-width:860px){
.mast .title{font-size:22px}
.hero .wrap{grid-template-columns:1fr}
.ytbox{height:210px}
.news-strip{grid-auto-columns:82%}
}
</style>
</head>
<body>

<!-- Top Navigation (4 menu + LOGIN di kanan) -->
<div class="topnav">
<div class="wrap">
<a href="{{ route('home') }}">Home</a>
<a href="{{ route('struktur') }}">Struktur Organisasi</a>
<a href="{{ route('layanan') }}">Layanan Publik</a>
<a href="{{ route('visi-misi') }}">Visi Misi</a>

<a href="{{ route('login') }}" style="margin-left:auto;">Login</a>
</div>
</div>

<!-- Header / Mast -->
<header class="mast">
<div class="wrap">
<img src="https://upload.wikimedia.org/wikipedia/commons/6/65/Logo-Branding-UNAIR-biru.png" alt="UNAIR" class="logo-unair">
<div class="title">RUMAH SAKIT HEWAN PENDIDIKAN</div>
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOVNcKuyK1wQAPxHcua9RINMjgomwbctohdQ&s" alt="RSHP" class="logo-rshp">
</div>
</header>

<main class="wrap">
<!-- HOME -->
<section id="home" class="section">
<div class="hero">
    <div class="wrap">
    <div>
        <h2>Selamat Datang di RSHP UNAIR</h2>
        <p>RSHP UNAIR berinovasi untuk meningkatkan kualitas pelayanan bagi hewan kesayangan Anda. Gunakan pendaftaran online agar kunjungan lebih mudah dan cepat.</p>
        <div class="cta">
        <a class="btn" href="https://rshp.unair.ac.id/pendaftaran-online/" target="_blank" rel="noopener">Pendaftaran Online</a>
        <a class="btn-out" href="https://rshp.unair.ac.id/dokter-jaga/" target="_blank" rel="noopener">Informasi Jadwal Dokter</a>
        </div>
    </div>

    <div class="ytbox">
        <div class="hd">Profil RSHP</div>
        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/rCfvZPECZvE" title="Profil RSHP" frameborder="0" allowfullscreen></iframe>
    </div>
    </div>
</div>

<!-- Berita Terkini — slider horizontal bisa digeser -->
<section class="section news">
    <h2>Berita Terkini</h2>
    <div class="news-slider">
    <div class="news-strip" aria-label="Daftar berita dapat digeser">
        <a class="news-card" href="https://rshp.unair.ac.id/kunjungan-sma-islam-terpadu-nurul-fikri-boarding-school-bogor/" target="_blank" rel="noopener">
        <img src="https://rshp.unair.ac.id/wp-content/uploads/2023/10/20231018_125516-1-740x450.jpg" alt="Kunjungan SMA">
        <div class="body"><h3>Kunjungan SMA Islam Terpadu</h3><p>18 Oktober 2023</p></div>
        </a>
        <a class="news-card" href="https://rshp.unair.ac.id/kunjungan-woah-ke-rshp-unair/" target="_blank" rel="noopener">
        <img src="https://rshp.unair.ac.id/wp-content/uploads/2023/10/WhatsApp-Image-2023-10-06-at-1.0-740x450.jpg" alt="WOAH ke RSHP">
        <div class="body"><h3>Kunjungan WOAH ke RSHP</h3><p>9 Oktober 2023</p></div>
        </a>
        <a class="news-card" href="https://rshp.unair.ac.id/vaksin-rabies-dan-pameran-hewan/" target="_blank" rel="noopener">
        <img src="https://rshp.unair.ac.id/wp-content/uploads/2023/10/WhatsApp-Image-2023-10-02-at-11.44.22-PM-2-740x450.jpeg" alt="Vaksin Rabies">
        <div class="body"><h3>Vaksin Rabies &amp; Pameran Hewan</h3><p>4 Oktober 2023</p></div>
        </a>
        <a class="news-card" href="https://rshp.unair.ac.id/seminar-workshop-sitologi-rshp-2024/" target="_blank" rel="noopener">
        <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/08/20240824_092632-1200x800.webp" alt="Seminar">
        <div class="body"><h3>Seminar &amp; Pelatihan Dokter Hewan</h3><p>25 September 2023</p></div>
        </a>
        <a class="news-card" href="https://rshp.unair.ac.id/pet-festival-di-rshp-unair/" target="_blank" rel="noopener">
        <img src="https://rshp.unair.ac.id/wp-content/uploads/2022/11/WhatsApp-Image-2022-11-09-at-13.38.32-740x450.jpeg" alt="PET FESTIVAL di RSHP Unair">
        <div class="body"><h3>PET FESTIVAL di RSHP Unair</h3><p>23 November 2022</p></div>
        </a>
    </div>
    </div>
</section>

<!-- Map -->
<section class="section map" id="lokasi">
    <h2>Lokasi RSHP</h2>
    <div class="mapbox">
    <iframe src="https://www.google.com/maps?q=Animal%20Hospital%20Universitas%20Airlangga&output=embed" width="100%" height="100%" loading="lazy" allowfullscreen></iframe>
    </div>
</section>
</section>
</main>

<footer class="footer">
<p>&copy; {{ date('Y') }} RSHP Universitas Airlangga — Website Statis (Tugas)</p>
</footer>

</body>
</html>
