<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title','SIMON-SETWAN')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
.sidebar-menu .nav-link{color:#495057;border-radius:.5rem;padding:.55rem .75rem}.sidebar-menu .nav-link:hover,.sidebar-menu .nav-link.active{background:#eaf2ff;color:#0d6efd}.sidebar-submenu{border-left:2px solid #dee2e6;margin-left:1rem;padding-left:.5rem}.sidebar-submenu .nav-link{font-size:.94rem}.sidebar-level-2{margin-left:.75rem;border-left:1px dashed #ced4da;padding-left:.5rem}.sidebar-level-3{margin-left:.75rem;border-left:1px dotted #ced4da;padding-left:.5rem}.program-toggle .chevron,.context-toggle .chevron{transition:transform .2s ease}.program-toggle[aria-expanded="true"] .chevron,.context-toggle[aria-expanded="true"] .chevron{transform:rotate(90deg)}.sidebar-code{font-size:.72rem;color:#6c757d}.sidebar-empty{font-size:.78rem;color:#6c757d;padding:.35rem .75rem}
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
@php
    $sidebarPrograms = \App\Models\Program::with(['kegiatans.subKegiatans'])->orderBy('nama')->get();
    $activeProgram = request()->route('program');
    $activeKegiatan = request()->route('kegiatan');
    $activeProgramId = is_object($activeProgram) ? $activeProgram->id : $activeProgram;
    $activeKegiatanId = is_object($activeKegiatan) ? $activeKegiatan->id : $activeKegiatan;
    $programSectionOpen = request()->routeIs('programs.*','kegiatans.*','sub-kegiatans.*');
@endphp
<a class="nav-link d-flex justify-content-between align-items-center program-toggle {{ $programSectionOpen ? 'active' : '' }}" href="#programMenu" data-bs-toggle="collapse" role="button" aria-expanded="{{ $programSectionOpen ? 'true' : 'false' }}" aria-controls="programMenu"><span>📁 Program</span><span class="chevron">›</span></a>
<div class="collapse sidebar-submenu {{ $programSectionOpen ? 'show' : '' }}" id="programMenu">
    <a class="nav-link {{ request()->routeIs('programs.index') ? 'active fw-semibold' : '' }}" href="{{route('programs.index')}}">📁 Daftar Program</a>
    @forelse($sidebarPrograms as $sp)
        @php $spOpen = (string)$activeProgramId === (string)$sp->id; $spHasActiveKegiatan = $spOpen && $activeKegiatanId; @endphp
        <a class="nav-link d-flex justify-content-between align-items-center context-toggle {{ $spOpen ? 'active fw-semibold' : '' }}" href="#program-{{ $sp->id }}" data-bs-toggle="collapse" role="button" aria-expanded="{{ $spOpen ? 'true' : 'false' }}" aria-controls="program-{{ $sp->id }}">
            <span class="text-truncate">📂 {{ $sp->nama }}</span><span class="chevron">›</span>
        </a>
        <div class="collapse sidebar-level-2 {{ $spOpen ? 'show' : '' }}" id="program-{{ $sp->id }}">
            <a class="nav-link {{ $spOpen && request()->routeIs('programs.show') ? 'active' : '' }}" href="{{route('programs.show',$sp)}}">Ikhtisar Program</a>
            @forelse($sp->kegiatans as $sk)
                @php $skOpen = (string)$activeKegiatanId === (string)$sk->id; @endphp
                <a class="nav-link d-flex justify-content-between align-items-center context-toggle {{ $skOpen ? 'active fw-semibold' : '' }}" href="#kegiatan-{{ $sk->id }}" data-bs-toggle="collapse" role="button" aria-expanded="{{ $skOpen ? 'true' : 'false' }}" aria-controls="kegiatan-{{ $sk->id }}">
                    <span class="text-truncate">📋 {{ $sk->nama }}</span><span class="chevron">›</span>
                </a>
                <div class="collapse sidebar-level-3 {{ $skOpen ? 'show' : '' }}" id="kegiatan-{{ $sk->id }}">
                    <a class="nav-link {{ $skOpen && request()->routeIs('programs.kegiatans.show') ? 'active' : '' }}" href="{{route('programs.kegiatans.show',[$sp,$sk])}}">Sub Kegiatan <span class="sidebar-code">({{ $sk->subKegiatans->count() }})</span></a>
                    @forelse($sk->subKegiatans as $ssk)
                        <a class="nav-link" href="{{route('programs.kegiatans.show',[$sp,$sk])}}">↳ {{ $ssk->nama }}</a>
                    @empty
                        <div class="sidebar-empty">Belum ada Sub Kegiatan</div>
                    @endforelse
                </div>
            @empty
                <div class="sidebar-empty">Belum ada Kegiatan</div>
            @endforelse
        </div>
    @empty
        <div class="sidebar-empty">Belum ada Program</div>
    @endforelse
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
