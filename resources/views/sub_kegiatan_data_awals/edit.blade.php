@extends('layouts.app')

@section('title', 'Edit Data Awal Sub Kegiatan')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">
                <i class="fas fa-edit me-2"></i>
                Edit Data Awal / Pagu
            </h1>

            <p class="text-muted mb-0">
                {{ $subKegiatan->kode }} - {{ $subKegiatan->nama }}
            </p>
        </div>

        <a href="{{ route('programs.index') }}"
           class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>
            Kembali
        </a>
    </div>

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

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-money-bill-wave me-2"></i>
                Data Awal / Pagu Anggaran
            </h5>
        </div>

        <div class="card-body">

            <form action="{{ route('sub-kegiatans.data-awal.update', $dataAwal) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">
                            Tahun Anggaran <span class="text-danger">*</span>
                        </label>

                        <input type="number"
                               name="tahun_anggaran"
                               class="form-control"
                               min="2000"
                               max="2100"
                               value="{{ old('tahun_anggaran', $dataAwal->tahun_anggaran) }}"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">
                            Pagu Anggaran <span class="text-danger">*</span>
                        </label>

                        <input type="number"
                               name="pagu_anggaran"
                               class="form-control"
                               min="0"
                               step="0.01"
                               value="{{ old('pagu_anggaran', $dataAwal->pagu_anggaran) }}"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">
                            Pagu Perubahan
                        </label>

                        <input type="number"
                               name="pagu_perubahan"
                               class="form-control"
                               min="0"
                               step="0.01"
                               value="{{ old('pagu_perubahan', $dataAwal->pagu_perubahan) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Sumber Dana
                        </label>

                        <input type="text"
                               name="sumber_dana"
                               class="form-control"
                               maxlength="100"
                               value="{{ old('sumber_dana', $dataAwal->sumber_dana) }}"
                               placeholder="Contoh: APBD">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Jenis Belanja
                        </label>

                        <input type="text"
                               name="jenis_belanja"
                               class="form-control"
                               maxlength="150"
                               value="{{ old('jenis_belanja', $dataAwal->jenis_belanja) }}"
                               placeholder="Contoh: Belanja Barang dan Jasa">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Target
                        </label>

                        <input type="number"
                               name="target"
                               class="form-control"
                               min="0"
                               step="0.01"
                               value="{{ old('target', $dataAwal->target) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Satuan
                        </label>

                        <input type="text"
                               name="satuan"
                               class="form-control"
                               maxlength="100"
                               value="{{ old('satuan', $dataAwal->satuan) }}"
                               placeholder="Contoh: Persen / Dokumen / Kegiatan">
                    </div>

                </div>

                <hr>

                <h6 class="fw-bold mb-3">
                    <i class="fas fa-chart-line me-2"></i>
                    Target Per Triwulan
                </h6>

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            Target TW I
                        </label>

                        <input type="number"
                               name="target_tw1"
                               class="form-control"
                               min="0"
                               step="0.01"
                               value="{{ old('target_tw1', $dataAwal->target_tw1) }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            Target TW II
                        </label>

                        <input type="number"
                               name="target_tw2"
                               class="form-control"
                               min="0"
                               step="0.01"
                               value="{{ old('target_tw2', $dataAwal->target_tw2) }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            Target TW III
                        </label>

                        <input type="number"
                               name="target_tw3"
                               class="form-control"
                               min="0"
                               step="0.01"
                               value="{{ old('target_tw3', $dataAwal->target_tw3) }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">
                            Target TW IV
                        </label>

                        <input type="number"
                               name="target_tw4"
                               class="form-control"
                               min="0"
                               step="0.01"
                               value="{{ old('target_tw4', $dataAwal->target_tw4) }}">
                    </div>

                </div>

                <hr>

                <h6 class="fw-bold mb-3">
                    <i class="fas fa-chart-pie me-2"></i>
                    Realisasi Awal
                </h6>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Realisasi Keuangan Awal
                        </label>

                        <input type="number"
                               name="realisasi_keuangan_awal"
                               class="form-control"
                               min="0"
                               step="0.01"
                               value="{{ old('realisasi_keuangan_awal', $dataAwal->realisasi_keuangan_awal) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Realisasi Fisik Awal (%)
                        </label>

                        <input type="number"
                               name="realisasi_fisik_awal"
                               class="form-control"
                               min="0"
                               max="100"
                               step="0.01"
                               value="{{ old('realisasi_fisik_awal', $dataAwal->realisasi_fisik_awal) }}">
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">
                            Keterangan
                        </label>

                        <textarea name="keterangan"
                                  rows="4"
                                  class="form-control"
                                  placeholder="Keterangan tambahan">{{ old('keterangan', $dataAwal->keterangan) }}</textarea>
                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('programs.index') }}"
                       class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>
                        Batal
                    </a>

                    <button type="submit"
                            class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
@endsection