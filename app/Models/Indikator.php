<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    protected $fillable = ['program_id', 'nama', 'target', 'satuan'];
}
