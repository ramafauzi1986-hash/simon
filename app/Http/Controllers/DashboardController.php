<?php
namespace App\Http\Controllers;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\SubKegiatan;
use App\Models\IndikatorKinerja;
use App\Models\Realisasi;
class DashboardController extends Controller {
 public function index(){
  $program=Program::count(); $kegiatan=Kegiatan::count(); $subKegiatan=SubKegiatan::count(); $indikator=IndikatorKinerja::count();
  $target=IndikatorKinerja::sum('target'); $realisasi=Realisasi::sum('nilai'); $capaian=$target>0?round(($realisasi/$target)*100,2):0;
  $tw=[]; for($i=1;$i<=4;$i++){ $tw[]=['target'=>$target/4,'realisasi'=>Realisasi::where('triwulan',$i)->sum('nilai')]; }
  return view('dashboard.index',compact('program','kegiatan','subKegiatan','indikator','target','realisasi','capaian','tw'));
 }
}