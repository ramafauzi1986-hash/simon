<?php
namespace App\Http\Controllers;
use App\Models\IndikatorKinerja;
class LaporanController extends Controller {
 public function index(){ $items=IndikatorKinerja::with(['subKegiatan.kegiatan.program','realisasis'])->orderBy('nama')->get(); $totalTarget=$items->sum('target'); $totalRealisasi=$items->sum(fn($i)=>$i->realisasis->sum('nilai')); $capaian=$totalTarget>0?round($totalRealisasi/$totalTarget*100,2):0; return view('laporan.index',compact('items','totalTarget','totalRealisasi','capaian')); }
}