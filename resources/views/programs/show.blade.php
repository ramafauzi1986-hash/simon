@extends('layouts.app')

@section('title', 'Kelola Program')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">
                <i class="fas fa-sitemap me-2"></i>
                Kelola Program
            </h1>

            <p class="text-muted mb-0">
                Struktur Program, Kegiatan, Sub Kegiatan dan Data Awal
            </p>
        </div>

        <a href="{{ route('programs.index') }}"
           class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>
            Kembali
        </a>
    </div>

    {{-- INFORMASI PROGRAM --}}
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-layer-group me-2"></i>
                Informasi Program
            </h5>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-3">
                    <div class="text-muted small">
                        KODE PROGRAM
                    </div>

                    <div class="fw-bold fs-5">
                        {{ $program->kode ?: '-' }}
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="text-muted small">
                        NAMA PROGRAM
                    </div>

                    <div class="fw-bold fs-5">
                        {{ $program->nama }}
                    </div>
                </div>

            </div>

        </div>
    </div>


    {{-- TOMBOL TAMBAH KEGIATAN --}}
    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h5 class="mb-1">
                <i class="fas fa-tasks me-2"></i>
                Daftar Kegiatan
            </h5>

            <small class="text-muted">
                Kegiatan yang berada di bawah program ini
            </small>
        </div>

        <a href="{{ route('kegiatans.index') }}"
           class="btn btn-primary">

            <i class="fas fa-plus me-1"></i>
            Kelola Kegiatan

        </a>

    </div>


    {{-- KEGIATAN --}}
    @forelse($program->kegiatans as $kegiatan)

        <div class="card shadow-sm border-0 mb-4">

            {{-- HEADER KEGIATAN --}}
            <div class="card-header bg-light">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <span class="badge bg-primary me-2">
                            {{ $kegiatan->kode ?: '-' }}
                        </span>

                        <span class="fw-bold">
                            {{ $kegiatan->nama }}
                        </span>

                    </div>

                    <span class="badge bg-info">
                        {{ $kegiatan->subKegiatans->count() }}
                        Sub Kegiatan
                    </span>

                </div>

            </div>


            {{-- SUB KEGIATAN --}}
            <div class="card-body">

                @if($kegiatan->subKegiatans->count() > 0)

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead class="table-light">

                                <tr>

                                    <th width="50">
                                        No
                                    </th>

                                    <th width="120">
                                        Kode
                                    </th>

                                    <th>
                                        Sub Kegiatan
                                    </th>

                                    <th width="120">
                                        Target
                                    </th>

                                    <th width="130">
                                        Satuan
                                    </th>

                                    <th width="180" class="text-center">
                                        Data Awal
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($kegiatan->subKegiatans as $subKegiatan)

                                    <tr>

                                        <td>
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>

                                            <span class="badge bg-secondary">
                                                {{ $subKegiatan->kode ?: '-' }}
                                            </span>

                                        </td>

                                        <td>

                                            <div class="fw-semibold">
                                                {{ $subKegiatan->nama }}
                                            </div>

                                        </td>

                                        <td>
                                            {{ $subKegiatan->target ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $subKegiatan->satuan ?? '-' }}
                                        </td>

                                        <td class="text-center">

                                            @if($subKegiatan->dataAwals->count() > 0)

                                                @foreach($subKegiatan->dataAwals as $dataAwal)

                                                    <div class="mb-2">

                                                        <span class="badge bg-success mb-1">
                                                            TA {{ $dataAwal->tahun_anggaran }}
                                                        </span>

                                                        <div class="small">
                                                            Pagu:
                                                            <strong>
                                                                Rp
                                                                {{ number_format((float) $dataAwal->pagu_anggaran, 0, ',', '.') }}
                                                            </strong>
                                                        </div>

                                                        <div class="mt-1">

                                                            <a href="{{ route('sub-kegiatans.data-awal.edit', $dataAwal) }}"
                                                               class="btn btn-sm btn-warning">

                                                                <i class="fas fa-edit"></i>
                                                                Edit

                                                            </a>

                                                            <form
                                                                action="{{ route('sub-kegiatans.data-awal.destroy', $dataAwal) }}"
                                                                method="POST"
                                                                class="d-inline"
                                                                onsubmit="return confirm('Yakin ingin menghapus data awal tahun {{ $dataAwal->tahun_anggaran }}?');">

                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit"
                                                                        class="btn btn-sm btn-danger">

                                                                    <i class="fas fa-trash"></i>

                                                                </button>

                                                            </form>

                                                        </div>

                                                    </div>

                                                @endforeach

                                            @else

                                                <span class="badge bg-warning text-dark mb-2">
                                                    Belum ada data
                                                </span>

                                            @endif


                                            <div>

                                                <a href="{{ route('sub-kegiatans.data-awal.create', $subKegiatan) }}"
                                                   class="btn btn-sm btn-primary">

                                                    <i class="fas fa-plus"></i>
                                                    Data Awal / Pagu

                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="text-center py-4">

                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>

                        <h6>
                            Belum ada Sub Kegiatan
                        </h6>

                        <p class="text-muted mb-0">
                            Tambahkan Sub Kegiatan melalui menu Sub Kegiatan.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    @empty

        <div class="card shadow-sm border-0">

            <div class="card-body text-center py-5">

                <i class="fas fa-tasks fa-4x text-muted mb-3"></i>

                <h5>
                    Belum ada Kegiatan
                </h5>

                <p class="text-muted">
                    Program ini belum memiliki kegiatan.
                </p>

                <a href="{{ route('kegiatans.index') }}"
                   class="btn btn-primary">

                    <i class="fas fa-plus me-1"></i>
                    Tambah Kegiatan

                </a>

            </div>

        </div>

    @endforelse

</div>
@endsection