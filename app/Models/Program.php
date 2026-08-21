<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Program extends Model {
 protected $fillable=['kode','nama','target','satuan'];
 public function kegiatans(){return $this->hasMany(Kegiatan::class);}
}