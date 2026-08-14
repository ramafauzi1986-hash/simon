<?php
namespace App\Http\Controllers;
use App\Models\Realisasi;
use App\Models\IndikatorKinerja;
use Illuminate\Http\Request;
class RealisasiController extends Controller { public function index(){ $items=Realisasi::with('indikator')->latest()->paginate(15); $indikators=IndikatorKinerja::orderBy('nama')->get(); return view('realisasi.index',compact('items','indikators')); } public function store(Request $request){$data=$request->validate(['indikator_kinerja_id'=>'required|exists:indikator_kinerjas,id','triwulan'=>'required|integer|min:1|max:4','nilai'=>'required|numeric|min:0','keterangan'=>'nullable|string','dokumen'=>'nullable|string|max:255']); Realisasi::updateOrCreate(['indikator_kinerja_id'=>$data['indikator_kinerja_id'],'triwulan'=>$data['triwulan']],$data); return back()->with('success','Realisasi berhasil disimpan.');} public function destroy(Realisasi $realisasi){$realisasi->delete();return back()->with('success','Realisasi berhasil dihapus.');} }