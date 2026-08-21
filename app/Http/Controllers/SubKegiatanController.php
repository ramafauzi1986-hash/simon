<?php
namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\SubKegiatan;
use Illuminate\Http\Request;

class SubKegiatanController extends Controller
{
    public function store(Request $request, Kegiatan $kegiatan)
    {
        $data = $request->validate([
            'kode' => 'nullable|string|max:50',
            'nama' => 'required|string|max:255',
            'target' => 'nullable|numeric',
            'satuan' => 'nullable|string|max:50',
        ]);

        $kegiatan->subKegiatans()->create($data);
        return back()->with('success', 'Sub Kegiatan berhasil ditambahkan pada Kegiatan yang dipilih.');
    }

    public function destroy(Kegiatan $kegiatan, SubKegiatan $subKegiatan)
    {
        abort_unless($subKegiatan->kegiatan_id === $kegiatan->id, 404);
        $subKegiatan->delete();
        return back()->with('success', 'Sub Kegiatan berhasil dihapus.');
    }
}
