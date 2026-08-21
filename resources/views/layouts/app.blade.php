<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title','SIMON-SETWAN')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
.sidebar-menu .nav-link{color:#495057;border-radius:.5rem;padding:.55rem .75rem}.sidebar-menu .nav-link:hover,.sidebar-menu .nav-link.active{background:#eaf2ff;color:#0d6efd}.sidebar-submenu{border-left:2px solid #dee2e6;margin-left:1rem;padding-left:.5rem}.sidebar-submenu .nav-link{font-size:.94rem}.program-toggle .chevron{transition:transform .2s ease}.program-toggle[aria-expanded="true"] .chevron{transform:rotate(90deg)}
</style>
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary shadow"><div class="container-fluid"><a class="navbar-brand fw-bold" href="{{route('dashboard')}}">SIMON-SETWAN</a><div class="d-flex align-items-center gap-3 text-white"><span>{{auth()->user()->name ?? ''}} <span class="badge bg-light text-primary">{{strtoupper(auth()->user()->role ?? '')}}</span></span><form method="POST" action="{{route('logout')}}">@csrf<button class="btn btn-sm btn-outline-light">Logout</button></form></div></div></nav>
<div class="container-fluid"><div class="row">
<aside class="col-lg-2 col-md-3 bg-white border-end min-vh-100 py-4">
<div class="small text-uppercase text-muted fw-bold mb-2">Menu Utama</div>
<nav class="nav flex-column gap-1 sidebar-menu">
<a class="nav-link" href="{{route('dashboard')}}">📊 Dashboard</a>
@if(in_array(auth()->user()->role,['admin','operator']))
<a class="nav-link d-flex justify-content-between align-items-center program-toggle" href="#programMenu" data-bs-toggle="collapse" role="button" aria-expanded="{{request()->routeIs('programs.*','kegiatans.*','sub-kegiatans.*') ? 'true' : 'false'}}" aria-controls="programMenu"><span>📁 Program</span><span class="chevron">›</span></a>
<div class="collapse sidebar-submenu {{request()->routeIs('programs.*','kegiatans.*','sub-kegiatans.*') ? 'show' : ''}}" id="programMenu">
<a class="nav-link" href="{{route('programs.index')}}">📁 Daftar Program</a>
<a class="nav-link" href="{{route('kegiatans.index')}}">📋 Kegiatan</a>
<a class="nav-link" href="{{route('sub-kegiatans.index')}}">🗂️ Sub Kegiatan</a>
</div>
<a class="nav-link" href="{{route('indikators.index')}}">🎯 Indikator Kinerja</a>
<a class="nav-link" href="{{route('realisasi.index')}}">📈 Realisasi & Evidence</a>
@endif
<a class="nav-link" href="{{route('laporan.index')}}">📑 Laporan Kinerja</a>
@if(auth()->user()->role==='admin')<hr><div class="small text-uppercase text-muted fw-bold">Administrasi</div><a class="nav-link" href="{{route('users.index')}}">👥 Manajemen Pengguna</a>@endif
</nav>
</aside>
<main class="col-lg-10 col-md-9 py-4">@yield('content')</main>
</div></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>