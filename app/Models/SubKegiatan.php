<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SubKegiatan extends Model { protected $fillable=['kegiatan_id','kode','nama','target','satuan']; public function kegiatan(){return $this->belongsTo(Kegiatan::class);} }