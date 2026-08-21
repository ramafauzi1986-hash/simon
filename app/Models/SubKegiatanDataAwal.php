<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubKegiatanDataAwal extends Model
{
    protected $table = 'sub_kegiatan_data_awals';

    protected $fillable = [
        'sub_kegiatan_id',
        'tahun_anggaran',
        'pagu_anggaran',
        'pagu_perubahan',
        'sumber_dana',
        'jenis_belanja',
        'target',
        'satuan',
        'target_tw1',
        'target_tw2',
        'target_tw3',
        'target_tw4',
        'realisasi_keuangan_awal',
        'realisasi_fisik_awal',
        'keterangan',
    ];

    protected $casts = [
        'tahun_anggaran' => 'integer',
        'pagu_anggaran' => 'decimal:2',
        'pagu_perubahan' => 'decimal:2',
        'target' => 'decimal:2',
        'target_tw1' => 'decimal:2',
        'target_tw2' => 'decimal:2',
        'target_tw3' => 'decimal:2',
        'target_tw4' => 'decimal:2',
        'realisasi_keuangan_awal' => 'decimal:2',
        'realisasi_fisik_awal' => 'decimal:2',
    ];

    public function subKegiatan(): BelongsTo
    {
        return $this->belongsTo(SubKegiatan::class);
    }
}