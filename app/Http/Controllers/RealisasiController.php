<?php
namespace App\Http\Controllers;
use App\Models\Realisasi;
use App\Models\IndikatorKinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class RealisasiController extends Controller {
 public function index(){ $items=Realisasi::with('indikator')->latest()->paginate(15); $indikators=IndikatorKinerja::orderBy('nama')->get(); return view('realisasi.index',compact('items','indikators')); }
 public function store(Request $request){ $data=$request->validate(['indikator_kinerja_id'=>'required|exists:indikator_kinerjas,id','triwulan'=>'required|integer|min:1|max:4','nilai'=>'required|numeric|min:0','keterangan'=>'nullable|string','dokumen'=>'nullable|string|max:255','evidence'=>'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:10240']); if($request->hasFile('evidence')) $data['evidence_path']=$request->file('evidence')->store('evidence','public'); unset($data['evidence']); Realisasi::updateOrCreate(['indikator_kinerja_id'=>$data['indikator_kinerja_id'],'triwulan'=>$data['triwulan']],$data); return back()->with('success','Realisasi dan evidence berhasil disimpan.'); }
 public function download(Realisasi $realisasi){ abort_unless($realisasi->evidence_path && Storage::disk('public')->exists($realisasi->evidence_path),404); return Storage::disk('public')->download($realisasi->evidence_path); }
 public function destroy(Realisasi $realisasi){ if($realisasi->evidence_path) Storage::disk('public')->delete($realisasi->evidence_path); $realisasi->delete(); return back()->with('success','Realisasi berhasil dihapus.'); }
}