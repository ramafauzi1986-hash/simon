<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubKegiatan extends Model
{
    protected $table = 'sub_kegiatans';

    protected $fillable = [
        'kegiatan_id',
        'kode',
        'nama',
        'target',
        'satuan',
    ];

    protected $casts = [
        'target' => 'decimal:2',
    ];

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(
            Kegiatan::class,
            'kegiatan_id'
        );
    }

    public function dataAwals(): HasMany
    {
        return $this->hasMany(
            SubKegiatanDataAwal::class,
            'sub_kegiatan_id'
        );
    }
}