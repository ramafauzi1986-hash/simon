<?php
namespace App\Http\Controllers;
use App\Models\SubKegiatan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
class SubKegiatanController extends Controller { public function index(){ $items=SubKegiatan::with('kegiatan')->latest()->paginate(10); $kegiatans=Kegiatan::orderBy('nama')->get(); return view('sub_kegiatans.index',compact('items','kegiatans')); } public function store(Request $request){$data=$request->validate(['kegiatan_id'=>'required|exists:kegiatans,id','kode'=>'nullable|string|max:50','nama'=>'required|string|max:255','target'=>'nullable|numeric','satuan'=>'nullable|string|max:50']); SubKegiatan::create($data); return back()->with('success','Sub kegiatan berhasil ditambahkan.');} public function destroy(SubKegiatan $subKegiatan){$subKegiatan->delete();return back()->with('success','Sub kegiatan berhasil dihapus.');} }