<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    protected $table = 'programs';

    protected $fillable = [
        'kode',
        'nama',
    ];

    /**
     * Satu program dapat mempunyai
     * banyak kegiatan.
     */
    public function kegiatans(): HasMany
    {
        return $this->hasMany(
            Kegiatan::class,
            'program_id'
        );
    }
}