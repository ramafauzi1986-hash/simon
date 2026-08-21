<?php
namespace App\Http\Controllers;
use App\Models\IndikatorKinerja;
use App\Models\SubKegiatan;
use Illuminate\Http\Request;
class IndikatorKinerjaController extends Controller { public function index(){ $items=IndikatorKinerja::with('subKegiatan')->latest()->paginate(10); $subs=SubKegiatan::orderBy('nama')->get(); return view('indikators.index',compact('items','subs')); } public function store(Request $request){$data=$request->validate(['sub_kegiatan_id'=>'required|exists:sub_kegiatans,id','nama'=>'required|string|max:255','target'=>'nullable|numeric','satuan'=>'nullable|string|max:50','sumber_data'=>'nullable|string']); IndikatorKinerja::create($data); return back()->with('success','Indikator kinerja berhasil ditambahkan.');} public function destroy(IndikatorKinerja $indikator){$indikator->delete();return back()->with('success','Indikator berhasil dihapus.');} }