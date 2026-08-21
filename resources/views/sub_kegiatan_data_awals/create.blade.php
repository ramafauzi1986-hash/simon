@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">
                Data Awal / Pagu Sub Kegiatan
            </h3>

            <div class="text-muted">
                {{ $subKegiatan->kode }} -
                {{ $subKegiatan->nama }}
            </div>
        </div>

        <a href="{{ route('programs.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terdapat kesalahan:</strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method="POST"
          action="{{ route('sub-kegiatans.data-awal.store', $subKegiatan) }}">

        @csrf

        <div class="card shadow-sm mb-4">

            <div class="card-header">
                <strong>Informasi Anggaran</strong>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-4">
                        <label class="form-label">
                            Tahun Anggaran
                        </label>

                        <input type="number"
                               name="tahun_anggaran"
                               class="form-control"
                               value="{{ old('tahun_anggaran', date('Y')) }}"
                               required>
                    </div>


                    <div class="col-md-4">
                        <label class="form-label">
                            Pagu Anggaran
                        </label>

                        <input type="number"
                               name="pagu_anggaran"
                               class="form-control"
                               value="{{ old('pagu_anggaran', 0) }}"
                               min="0"
                               step="0.01"
                               required>
                    </div>


                    <div class="col-md-4">
                        <label class="form-label">
                            Pagu Perubahan
                        </label>

                        <input type="number"
                               name="pagu_perubahan"
                               class="form-control"
                               value="{{ old('pagu_perubahan', 0) }}"
                               min="0"
                               step="0.01">
                    </div>


                    <div class="col-md-6">
                        <label class="form-label">
                            Sumber Dana
                        </label>

                        <input type="text"
                               name="sumber_dana"
                               class="form-control"
                               value="{{ old('sumber_dana') }}"
                               placeholder="Contoh: APBD">
                    </div>


                    <div class="col-md-6">
                        <label class="form-label">
                            Jenis Belanja
                        </label>

                        <input type="text"
                               name="jenis_belanja"
                               class="form-control"
                               value="{{ old('jenis_belanja') }}"
                               placeholder="Contoh: Belanja Barang dan Jasa">
                    </div>

                </div>

            </div>
        </div>


        <div class="card shadow-sm mb-4">

            <div class="card-header">
                <strong>Target Kinerja</strong>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Target
                        </label>

                        <input type="number"
                               name="target"
                               class="form-control"
                               value="{{ old('target', $subKegiatan->target) }}"
                               min="0"
                               step="0.01">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Satuan
                        </label>

                        <input type="text"
                               name="satuan"
                               class="form-control"
                               value="{{ old('satuan', $subKegiatan->satuan) }}"
                               placeholder="Contoh: Dokumen">

                    </div>

                </div>

            </div>
        </div>


        <div class="card shadow-sm mb-4">

            <div class="card-header">
                <strong>Target Triwulanan</strong>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-3">
                        <label class="form-label">
                            Target TW I
                        </label>

                        <input type="number"
                               name="target_tw1"
                               class="form-control"
                               value="{{ old('target_tw1', 0) }}"
                               min="0"
                               step="0.01">
                    </div>


                    <div class="col-md-3">
                        <label class="form-label">
                            Target TW II
                        </label>

                        <input type="number"
                               name="target_tw2"
                               class="form-control"
                               value="{{ old('target_tw2', 0) }}"
                               min="0"
                               step="0.01">
                    </div>


                    <div class="col-md-3">
                        <label class="form-label">
                            Target TW III
                        </label>

                        <input type="number"
                               name="target_tw3"
                               class="form-control"
                               value="{{ old('target_tw3', 0) }}"
                               min="0"
                               step="0.01">
                    </div>


                    <div class="col-md-3">
                        <label class="form-label">
                            Target TW IV
                        </label>

                        <input type="number"
                               name="target_tw4"
                               class="form-control"
                               value="{{ old('target_tw4', 0) }}"
                               min="0"
                               step="0.01">
                    </div>

                </div>

            </div>
        </div>


        <div class="card shadow-sm mb-4">

            <div class="card-header">
                <strong>Realisasi Awal</strong>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Realisasi Keuangan Awal
                        </label>

                        <input type="number"
                               name="realisasi_keuangan_awal"
                               class="form-control"
                               value="{{ old('realisasi_keuangan_awal', 0) }}"
                               min="0"
                               step="0.01">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Realisasi Fisik Awal (%)
                        </label>

                        <input type="number"
                               name="realisasi_fisik_awal"
                               class="form-control"
                               value="{{ old('realisasi_fisik_awal', 0) }}"
                               min="0"
                               max="100"
                               step="0.01">

                    </div>

                </div>

            </div>
        </div>


        <div class="card shadow-sm mb-4">

            <div class="card-header">
                <strong>Keterangan</strong>
            </div>

            <div class="card-body">

                <textarea name="keterangan"
                          class="form-control"
                          rows="4"
                          placeholder="Keterangan tambahan...">{{ old('keterangan') }}</textarea>

            </div>
        </div>


        <div class="d-flex justify-content-end gap-2">

            <a href="{{ route('programs.index') }}"
               class="btn btn-light border">
                Batal
            </a>

            <button type="submit"
                    class="btn btn-primary">
                Simpan Data Awal
            </button>

        </div>

    </form>

</div>

@endsection