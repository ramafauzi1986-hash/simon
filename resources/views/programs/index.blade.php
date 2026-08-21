@extends('layouts.app')
@section('title', 'Program')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Program</h3>
        <p class="text-muted mb-0">Daftar Program sebagai tingkat utama hierarki kinerja.</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProgram">+ Tambah Program</button>
</div>

@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light"><tr><th class="ps-4">Kode</th><th>Program</th><th>Kegiatan</th><th>Target</th><th class="text-end pe-4">Aksi</th></tr></thead>
                <tbody>
                @forelse($programs as $p)
                    <tr>
                        <td class="ps-4">{{ $p->kode }}</td>
                        <td class="fw-semibold">{{ $p->nama }}</td>
                        <td><span class="badge text-bg-light border">{{ $p->kegiatans_count }} Kegiatan</span></td>
                        <td>{{ $p->target }} {{ $p->satuan }}</td>
                        <td class="text-end pe-4"><a class="btn btn-sm btn-primary" href="{{ route('programs.show', $p) }}">Buka Program</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-5">Belum ada Program.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $programs->links() }}</div>
    </div>
</div>

<div class="modal fade" id="addProgram" tabindex="-1"><div class="modal-dialog"><form class="modal-content" method="POST" action="{{ route('programs.store') }}">@csrf
    <div class="modal-header"><h5 class="modal-title">Tambah Program</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">
        <div class="mb-3"><label class="form-label">Kode</label><input name="kode" class="form-control"></div>
        <div class="mb-3"><label class="form-label">Nama Program</label><input name="nama" class="form-control" required></div>
        <div class="row"><div class="col"><label class="form-label">Target</label><input name="target" type="number" step="0.01" class="form-control"></div><div class="col"><label class="form-label">Satuan</label><input name="satuan" class="form-control"></div></div>
    </div>
    <div class="modal-footer"><button class="btn btn-primary">Simpan Program</button></div>
</form></div></div>
@endsection
