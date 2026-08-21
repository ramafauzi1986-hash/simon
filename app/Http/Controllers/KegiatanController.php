<?php
namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Program;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function show(Program $program, Kegiatan $kegiatan)
    {
        abort_unless($kegiatan->program_id === $program->id, 404);
        $kegiatan->load(['program', 'subKegiatans' => fn ($query) => $query->latest()]);
        return view('kegiatans.show', compact('program', 'kegiatan'));
    }

    public function store(Request $request, Program $program)
    {
        $data = $request->validate([
            'kode' => 'nullable|string|max:50',
            'nama' => 'required|string|max:255',
        ]);

        $program->kegiatans()->create($data);
        return back()->with('success', 'Kegiatan berhasil ditambahkan pada Program yang dipilih.');
    }

    public function update(Request $request, Program $program, Kegiatan $kegiatan)
    {
        abort_unless($kegiatan->program_id === $program->id, 404);

        $data = $request->validate([
            'kode' => 'nullable|string|max:50',
            'nama' => 'required|string|max:255',
        ]);

        $kegiatan->update($data);
        return back()->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Program $program, Kegiatan $kegiatan)
    {
        abort_unless($kegiatan->program_id === $program->id, 404);

        if ($kegiatan->subKegiatans()->exists()) {
            return back()->with('error', 'Kegiatan tidak dapat dihapus karena masih memiliki Sub Kegiatan. Hapus Sub Kegiatan di dalamnya terlebih dahulu.');
        }

        $kegiatan->delete();
        return back()->with('success', 'Kegiatan berhasil dihapus.');
    }
}
