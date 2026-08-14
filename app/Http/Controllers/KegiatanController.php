<?php
namespace App\Http\Controllers;
use App\Models\Kegiatan;
use App\Models\Program;
use Illuminate\Http\Request;
class KegiatanController extends Controller { public function index(){ $kegiatans=Kegiatan::with('program')->latest()->paginate(10); $programs=Program::orderBy('nama')->get(); return view('kegiatans.index',compact('kegiatans','programs')); } public function store(Request $request){ $data=$request->validate(['program_id'=>'required|exists:programs,id','kode'=>'nullable|string|max:50','nama'=>'required|string|max:255']); Kegiatan::create($data); return back()->with('success','Kegiatan berhasil ditambahkan.'); } public function destroy(Kegiatan $kegiatan){$kegiatan->delete();return back()->with('success','Kegiatan berhasil dihapus.');} }