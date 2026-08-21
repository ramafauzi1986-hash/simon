@extends('layouts.app')
@section('title', 'Program - '.$program->nama)
@section('content')
<nav aria-label="breadcrumb" class="mb-3"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{ route('programs.index') }}">Program</a></li><li class="breadcrumb-item active">{{ $program->nama }}</li></ol></nav>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div><h3 class="fw-bold mb-1">{{ $program->nama }}</h3><p class="text-muted mb-0">{{ $program->kode ?: 'Program' }} · Kelola Kegiatan di dalam Program ini.</p></div>
    <div class="d-flex gap-2"><a href="{{ route('programs.index') }}" class="btn btn-outline-secondary">← Kembali ke Program</a><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKegiatan">+ Tambah Kegiatan</button></div>
</div>

@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3"><div class="fw-semibold">Kegiatan dalam Program <span class="text-primary">{{ $program->nama }}</span></div></div>
    <div class="card-body p-0"><div class="table-responsive"><table class="table table-hover align-middle mb-0">
        <thead class="table-light"><tr><th class="ps-4">Kode</th><th>Kegiatan</th><th>Sub Kegiatan</th><th class="text-end pe-4">Aksi</th></tr></thead>
        <tbody>
        @forelse($program->kegiatans as $kegiatan)
            <tr><td class="ps-4">{{ $kegiatan->kode }}</td><td class="fw-semibold">{{ $kegiatan->nama }}</td><td><span class="badge text-bg-light border">{{ $kegiatan->sub_kegiatans_count }} Sub Kegiatan</span></td><td class="text-end pe-4"><a class="btn btn-sm btn-primary" href="{{ route('programs.kegiatans.show', [$program, $kegiatan]) }}">Buka Kegiatan</a></td></tr>
        @empty
            <tr><td colspan="4" class="text-center text-muted py-5">Belum ada Kegiatan pada Program ini. Klik <strong>Tambah Kegiatan</strong> untuk memulai.</td></tr>
        @endforelse
        </tbody>
    </table></div></div>
</div>

<div class="modal fade" id="addKegiatan" tabindex="-1"><div class="modal-dialog"><form class="modal-content" method="POST" action="{{ route('programs.kegiatans.store', $program) }}">@csrf
    <div class="modal-header"><h5 class="modal-title">Tambah Kegiatan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body"><div class="alert alert-light border small">Program induk: <strong>{{ $program->nama }}</strong></div><div class="mb-3"><label class="form-label">Kode Kegiatan</label><input name="kode" class="form-control"></div><div class="mb-3"><label class="form-label">Nama Kegiatan</label><input name="nama" class="form-control" required></div></div>
    <div class="modal-footer"><button class="btn btn-primary">Simpan Kegiatan</button></div>
</form></div></div>
@endsection
