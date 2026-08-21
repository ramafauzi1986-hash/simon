@extends('layouts.app')
@section('title', 'Kegiatan - '.$kegiatan->nama)
@section('content')
<nav aria-label="breadcrumb" class="mb-3"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{ route('programs.index') }}">Program</a></li><li class="breadcrumb-item"><a href="{{ route('programs.show', $program) }}">{{ $program->nama }}</a></li><li class="breadcrumb-item active">{{ $kegiatan->nama }}</li></ol></nav>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div><h3 class="fw-bold mb-1">{{ $kegiatan->nama }}</h3><p class="text-muted mb-0">Sub Kegiatan dari Program <strong>{{ $program->nama }}</strong>.</p></div>
    <div class="d-flex gap-2"><a href="{{ route('programs.show', $program) }}" class="btn btn-outline-secondary">← Kembali ke Program</a><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubKegiatan">+ Tambah Sub Kegiatan</button></div>
</div>

@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

<div class="card shadow-sm border-0"><div class="card-header bg-white py-3"><div class="fw-semibold">Sub Kegiatan</div><div class="small text-muted">{{ $program->nama }} / {{ $kegiatan->nama }}</div></div>
<div class="card-body p-0"><div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead class="table-light"><tr><th class="ps-4">Kode</th><th>Sub Kegiatan</th><th>Target</th><th>Satuan</th><th class="text-end pe-4">Aksi</th></tr></thead><tbody>
@forelse($kegiatan->subKegiatans as $item)
<tr><td class="ps-4">{{ $item->kode }}</td><td class="fw-semibold">{{ $item->nama }}</td><td>{{ $item->target }}</td><td>{{ $item->satuan }}</td><td class="text-end pe-4"><form method="POST" action="{{ route('kegiatans.sub-kegiatans.destroy', [$kegiatan, $item]) }}" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus Sub Kegiatan?')">Hapus</button></form></td></tr>
@empty
<tr><td colspan="5" class="text-center text-muted py-5">Belum ada Sub Kegiatan pada Kegiatan ini.</td></tr>
@endforelse
</tbody></table></div></div></div>

<div class="modal fade" id="addSubKegiatan" tabindex="-1"><div class="modal-dialog"><form class="modal-content" method="POST" action="{{ route('kegiatans.sub-kegiatans.store', $kegiatan) }}">@csrf
<div class="modal-header"><h5 class="modal-title">Tambah Sub Kegiatan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
<div class="modal-body"><div class="alert alert-light border small">Program: <strong>{{ $program->nama }}</strong><br>Kegiatan: <strong>{{ $kegiatan->nama }}</strong></div><div class="mb-3"><label class="form-label">Kode Sub Kegiatan</label><input name="kode" class="form-control"></div><div class="mb-3"><label class="form-label">Nama Sub Kegiatan</label><input name="nama" class="form-control" required></div><div class="row"><div class="col"><label class="form-label">Target</label><input name="target" type="number" step="0.01" class="form-control"></div><div class="col"><label class="form-label">Satuan</label><input name="satuan" class="form-control"></div></div></div>
<div class="modal-footer"><button class="btn btn-primary">Simpan Sub Kegiatan</button></div></form></div></div>
@endsection
