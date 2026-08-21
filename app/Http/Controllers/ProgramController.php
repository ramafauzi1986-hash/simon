<?php
namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::withCount('kegiatans')->latest()->paginate(10);
        return view('programs.index', compact('programs'));
    }

    public function show(Program $program)
    {
        $program->load(['kegiatans' => fn ($query) => $query->withCount('subKegiatans')->latest()]);
        return view('programs.show', compact('program'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode' => 'nullable|string|max:50',
            'nama' => 'required|string|max:255',
            'target' => 'nullable|numeric',
            'satuan' => 'nullable|string|max:50',
        ]);

        Program::create($data);
        return back()->with('success', 'Program berhasil ditambahkan.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return back()->with('success', 'Program berhasil dihapus.');
    }
}
