<?php

namespace App\Http\Controllers;

use App\Models\SubKegiatan;
use App\Models\SubKegiatanDataAwal;
use Illuminate\Http\Request;

class SubKegiatanDataAwalController extends Controller
{
    /**
     * Menampilkan form data awal / pagu.
     */
    public function create(SubKegiatan $subKegiatan)
    {
        return view(
            'sub_kegiatan_data_awals.create',
            compact('subKegiatan')
        );
    }

    /**
     * Menyimpan data awal / pagu.
     */
    public function store(
        Request $request,
        SubKegiatan $subKegiatan
    ) {
        $validated = $request->validate([
            'tahun_anggaran' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],

            'pagu_anggaran' => [
                'required',
                'numeric',
                'min:0',
            ],

            'pagu_perubahan' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'sumber_dana' => [
                'nullable',
                'string',
                'max:100',
            ],

            'jenis_belanja' => [
                'nullable',
                'string',
                'max:150',
            ],

            'target' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'satuan' => [
                'nullable',
                'string',
                'max:100',
            ],

            'target_tw1' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'target_tw2' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'target_tw3' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'target_tw4' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'realisasi_keuangan_awal' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'realisasi_fisik_awal' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],
        ]);

        /*
         * Satu sub kegiatan dapat mempunyai
         * satu data awal untuk setiap tahun anggaran.
         */
        $subKegiatan->dataAwals()->updateOrCreate(
            [
                'tahun_anggaran' => $validated['tahun_anggaran'],
            ],
            $validated
        );

        return redirect()
            ->route(
                'programs.index'
            )
            ->with(
                'success',
                'Data awal / pagu berhasil disimpan.'
            );
    }

    /**
     * Menampilkan form edit data awal.
     */
    public function edit(
        SubKegiatanDataAwal $dataAwal
    ) {
        $subKegiatan = $dataAwal->subKegiatan;

        return view(
            'sub_kegiatan_data_awals.edit',
            compact(
                'dataAwal',
                'subKegiatan'
            )
        );
    }

    /**
     * Memperbarui data awal / pagu.
     */
    public function update(
        Request $request,
        SubKegiatanDataAwal $dataAwal
    ) {
        $validated = $request->validate([
            'tahun_anggaran' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],

            'pagu_anggaran' => [
                'required',
                'numeric',
                'min:0',
            ],

            'pagu_perubahan' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'sumber_dana' => [
                'nullable',
                'string',
                'max:100',
            ],

            'jenis_belanja' => [
                'nullable',
                'string',
                'max:150',
            ],

            'target' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'satuan' => [
                'nullable',
                'string',
                'max:100',
            ],

            'target_tw1' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'target_tw2' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'target_tw3' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'target_tw4' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'realisasi_keuangan_awal' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'realisasi_fisik_awal' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
            ],

            'keterangan' => [
                'nullable',
                'string',
            ],
        ]);

        $dataAwal->update($validated);

        return redirect()
            ->route(
                'programs.index'
            )
            ->with(
                'success',
                'Data awal / pagu berhasil diperbarui.'
            );
    }

    /**
     * Menghapus data awal / pagu.
     */
    public function destroy(
        SubKegiatanDataAwal $dataAwal
    ) {
        $dataAwal->delete();

        return redirect()
            ->route(
                'programs.index'
            )
            ->with(
                'success',
                'Data awal / pagu berhasil dihapus.'
            );
    }
}