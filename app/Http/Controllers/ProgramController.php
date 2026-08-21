<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Menampilkan seluruh Program.
     *
     * Struktur:
     * Program
     *   └── Kegiatan
     *       └── Sub Kegiatan
     *           └── Data Awal / Pagu
     */
    public function index()
    {
        $programs = Program::with([
            'kegiatans' => function ($query) {
                $query->orderBy('kode')
                    ->with([
                        'subKegiatans' => function ($subQuery) {
                            $subQuery->orderBy('kode')
                                ->with('dataAwals');
                        }
                    ]);
            }
        ])
        ->withCount('kegiatans')
        ->latest()
        ->paginate(10);

        return view(
            'programs.index',
            compact('programs')
        );
    }


    /**
     * Form tambah Program.
     */
    public function create()
    {
        return view('programs.create');
    }


    /**
     * Menyimpan Program.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode' => [
                'nullable',
                'string',
                'max:50',
            ],

            'nama' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        Program::create($data);

        return redirect()
            ->route('programs.index')
            ->with(
                'success',
                'Program berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail Program.
     */
    public function show(Program $program)
    {
        $program->load([
            'kegiatans' => function ($query) {
                $query->orderBy('kode')
                    ->with([
                        'subKegiatans' => function ($subQuery) {
                            $subQuery->orderBy('kode')
                                ->with('dataAwals');
                        }
                    ]);
            }
        ]);

        return view(
            'programs.show',
            compact('program')
        );
    }


    /**
     * Form edit Program.
     */
    public function edit(Program $program)
    {
        return view(
            'programs.edit',
            compact('program')
        );
    }


    /**
     * Memperbarui Program.
     */
    public function update(
        Request $request,
        Program $program
    ) {
        $data = $request->validate([
            'kode' => [
                'nullable',
                'string',
                'max:50',
            ],

            'nama' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $program->update($data);

        return redirect()
            ->route('programs.index')
            ->with(
                'success',
                'Program berhasil diperbarui.'
            );
    }


    /**
     * Menghapus Program.
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()
            ->route('programs.index')
            ->with(
                'success',
                'Program berhasil dihapus.'
            );
    }
}