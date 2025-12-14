{{-- resources/views/layouts/lte/resepsionis-ite/head.blade.php --}}
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>@yield('title', 'Resepsionis | RSHP')</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
:root{
  --rshp-blue:#020381;
  --rshp-yellow:#f5b301;
  --rshp-bg:#f4f6f9;
  --brand: var(--rshp-blue);
}

body{
  font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
  background: var(--rshp-bg);
}

/* ================= BRAND BAR ================= */
.brand-bar{
  background:#fff;
  border-bottom:1px solid #e5e7eb;
  padding:14px 18px;
  display:flex;
  align-items:center;
  gap:12px;
}
.brand-bar img{height:54px}
.brand-title{line-height:1}
.brand-title .t1{
  font-weight:800;
  color:var(--rshp-blue);
  font-size:14px
}
.brand-title .t2{
  font-weight:600;
  color:#64748b;
  font-size:12px;
  margin-top:2px
}

/* ================= TOPBAR ================= */
.topbar{
  position:fixed;
  top:0;
  left:0;
  right:0;
  height:86px;
  z-index:50;
  background:#fff;
  border-bottom:1px solid #e5e7eb;
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:0 18px;
}

/* ================= SIDEBAR ================= */
.sidebar{
  width:260px;
  position:fixed;
  top:0;
  left:0;
  height:100vh;
  overflow:auto;
  background:linear-gradient(180deg,var(--rshp-blue),#01014d);
  color:#fff;
  padding-top:86px; /* sejajar topbar */
}

.nav-section{
  opacity:.8;
  font-size:11px;
  letter-spacing:.12em;
  margin:18px 14px 8px;
}

.nav-item a{
  color:#e6e6ff;
  text-decoration:none;
  display:flex;
  align-items:center;
  gap:10px;
  padding:10px 14px;
  border-radius:10px;
  margin:4px 10px;
  transition:.15s;
}
.nav-item a:hover{
  background:rgba(255,255,255,.10);
  color:#fff
}
.nav-item a.active{
  background:rgba(245,179,1,.22);
  color:#fff;
  border:1px solid rgba(245,179,1,.35)
}

/* ================= CONTENT ================= */
/* FIX: biar konten gak ketutup topbar */
.content-wrapper{
  margin-left:260px;
  min-height:100vh;
  padding:104px 18px 60px; /* 86px topbar + jarak */
}

/* ================= FOOTER ================= */
footer.footer{
  position:fixed;
  left:260px;
  right:0;
  bottom:0;
  background:#fff;
  border-top:1px solid #e5e7eb;
  padding:10px 18px;
  font-size:12px;
  color:#64748b;
}

/* ================= UTIL ================= */
.card-soft{
  border:1px solid #e5e7eb;
  border-radius:16px;
  box-shadow:0 8px 20px rgba(0,0,0,.04);
}

/* ====== FIX UTAMA: BUTTON RSHP (BIAR "BUKA" GA PUTIH) ====== */
.btn-rshp{
  background: var(--rshp-yellow) !important;
  border: 1px solid var(--rshp-yellow) !important;
  color: #fff !important;
  font-weight: 800;
  border-radius: 12px;
  padding: 10px 14px;
  box-shadow: 0 10px 18px rgba(0,0,0,.06);
}
.btn-rshp:hover{
  filter: brightness(.95);
  color: #fff !important;
}
.btn-rshp:focus{
  box-shadow: 0 0 0 .25rem rgba(245,179,1,.35) !important;
}

/* kalau tombol kamu pakai <a> dan full lebar */
a.btn-rshp{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  text-decoration:none;
}
.btn-rshp.w-100{ display:flex; }

/* ================= RESPONSIVE ================= */
@media(max-width:980px){
  .sidebar{
    position:static;
    width:100%;
    height:auto;
    padding-top:0;
  }
  .topbar{
    position:static;
    height:auto;
    padding:14px 18px;
  }
  .content-wrapper{
    margin-left:0;
    padding:18px 18px 60px;
  }
  footer.footer{
    left:0;
  }
}
/* ===== FIX LOGOUT RESEPSIONIS ===== */
.userbox{
  display:flex;
  align-items:center;
  gap:10px;
}

.userbox .avatar{
  width:36px;
  height:36px;
  border-radius:50%;
  background:var(--rshp-yellow);
  color:#fff;
  font-weight:800;
  display:flex;
  align-items:center;
  justify-content:center;
}

.userbox .name{
  font-weight:700;
  color:#020381;
}

.userbox .role{
  font-size:12px;
  color:#64748b;
}

.logout-btn{
  color:#020381 !important;
  font-size:16px;
}

.logout-btn:hover{
  color:#b42318 !important;
}

</style>
