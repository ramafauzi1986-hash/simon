<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Realisasi extends Model { protected $fillable=['indikator_kinerja_id','triwulan','nilai','keterangan','dokumen']; public function indikator(){return $this->belongsTo(IndikatorKinerja::class,'indikator_kinerja_id');} }