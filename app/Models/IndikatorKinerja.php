<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class IndikatorKinerja extends Model { protected $fillable=['sub_kegiatan_id','nama','target','satuan','sumber_data']; public function subKegiatan(){return $this->belongsTo(SubKegiatan::class);} }