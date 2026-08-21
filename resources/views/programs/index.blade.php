@extends('layouts.app')

@section('title', 'Program')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">
                <i class="fas fa-layer-group me-2"></i>
                Program
            </h1>
            <p class="text-muted mb-0">
                Pengelolaan Program, Kegiatan, dan Sub Kegiatan
            </p>
        </div>

        <a href="{{ route('programs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Tambah Program
        </a>
    </div>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Error validasi --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Statistik --}}
    <div class="row mb-4">

        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-muted small">
                                TOTAL PROGRAM
                            </div>

                            <div class="fs-3 fw-bold">
                                {{ $programs->total() }}
                            </div>
                        </div>

                        <div class="text-primary fs-2">
                            <i class="fas fa-layer-group"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-muted small">
                                DATA PROGRAM
                            </div>

                            <div class="fs-5 fw-bold">
                                {{ $programs->count() }}
                                ditampilkan
                            </div>
                        </div>

                        <div class="text-success fs-2">
                            <i class="fas fa-database"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-muted small">
                                STATUS
                            </div>

                            <div class="fs-5 fw-bold text-success">
                                Aktif
                            </div>
                        </div>

                        <div class="text-info fs-2">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Tabel Program --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Daftar Program
                    </h5>

                    <small class="text-muted">
                        Daftar seluruh program yang terdaftar pada SIMON
                    </small>
                </div>

            </div>
        </div>

        <div class="card-body">

            @if($programs->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">

                            <tr>
                                <th width="60">No</th>
                                <th width="130">Kode</th>
                                <th>Nama Program</th>
                                <th width="150" class="text-center">
                                    Kegiatan
                                </th>
                                <th width="260" class="text-center">
                                    Aksi
                                </th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($programs as $program)

                                <tr>

                                    <td>
                                        {{ $programs->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $program->kode }}
                                        </span>
                                    </td>

                                    <td>

                                        <div class="fw-semibold">
                                            {{ $program->nama }}
                                        </div>

                                        <small class="text-muted">
                                            Program SIMON-SETWAN
                                        </small>

                                    </td>

                                    <td class="text-center">

                                        <span class="badge bg-info">
                                            {{ $program->kegiatans_count }}
                                            Kegiatan
                                        </span>

                                    </td>

                                    <td>

                                        <div class="d-flex justify-content-center gap-1">

                                            <a href="{{ route('programs.show', $program) }}"
                                               class="btn btn-sm btn-success"
                                               title="Kelola">

                                                <i class="fas fa-folder-open"></i>
                                                Kelola

                                            </a>

                                            <a href="{{ route('programs.edit', $program) }}"
                                               class="btn btn-sm btn-warning"
                                               title="Edit">

                                                <i class="fas fa-edit"></i>

                                            </a>

                                            <form action="{{ route('programs.destroy', $program) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus program ini?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-danger"
                                                        title="Hapus">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                <div class="mt-3">

                    {{ $programs->links() }}

                </div>

            @else

                <div class="text-center py-5">

                    <div class="mb-3">
                        <i class="fas fa-folder-open fa-4x text-muted"></i>
                    </div>

                    <h5>
                        Belum ada Program
                    </h5>

                    <p class="text-muted">
                        Silakan tambahkan Program terlebih dahulu.
                    </p>

                    <a href="{{ route('programs.create') }}"
                       class="btn btn-primary">

                        <i class="fas fa-plus me-1"></i>
                        Tambah Program

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>
@endsection