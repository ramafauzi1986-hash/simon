<?php
namespace App\Http\Controllers;
use App\Models\IndikatorKinerja;
class LaporanController extends Controller {
 public function index(){ $items=$this->data(); $totalTarget=$items->sum('target'); $totalRealisasi=$items->sum(fn($i)=>$i->realisasis->sum('nilai')); $capaian=$totalTarget>0?round($totalRealisasi/$totalTarget*100,2):0; return view('laporan.index',compact('items','totalTarget','totalRealisasi','capaian')); }
 public function csv(){ $items=$this->data(); $filename='laporan-kinerja-'.date('Ymd-His').'.csv'; $handle=fopen('php://temp','w+'); fputcsv($handle,['Program','Kegiatan','Sub Kegiatan','Indikator','Target','Realisasi','Capaian']); foreach($items as $i){$real=$i->realisasis->sum('nilai');$cap=$i->target>0?round($real/$i->target*100,2):0;fputcsv($handle,[$i->subKegiatan?->kegiatan?->program?->nama,$i->subKegiatan?->kegiatan?->nama,$i->subKegiatan?->nama,$i->nama,$i->target,$real,$cap.'%']);} rewind($handle); $csv=stream_get_contents($handle); fclose($handle); return response($csv)->header('Content-Type','text/csv')->header('Content-Disposition','attachment; filename="'.$filename.'"'); }
 private function data(){return IndikatorKinerja::with(['subKegiatan.kegiatan.program','realisasis'])->orderBy('nama')->get();}
}