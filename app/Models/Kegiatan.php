<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kegiatan extends Model
{
    protected $table = 'kegiatans';

    protected $fillable = [
        'program_id',
        'kode',
        'nama',
    ];

    /**
     * Relasi ke Program.
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(
            Program::class,
            'program_id'
        );
    }

    /**
     * Satu kegiatan dapat mempunyai
     * banyak sub kegiatan.
     */
    public function subKegiatans(): HasMany
    {
        return $this->hasMany(
            SubKegiatan::class,
            'kegiatan_id'
        );
    }
}