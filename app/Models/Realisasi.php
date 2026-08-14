<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    protected $fillable = ['indikator_id', 'periode', 'nilai', 'keterangan', 'dokumen'];
}
