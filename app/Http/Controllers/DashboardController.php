<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Realisasi;
use App\Models\Indikator;

class DashboardController extends Controller
{
    public function index()
    {
        $program = Program::count();
        $indikator = Indikator::count();
        $realisasi = Realisasi::sum('nilai');

        return view('dashboard.index', compact('program', 'indikator', 'realisasi'));
    }
}
