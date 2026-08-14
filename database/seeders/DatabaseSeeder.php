<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use App\Models\Indikator;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $p = Program::create(['kode'=>'01','nama'=>'Program Penunjang Urusan Pemerintahan Daerah','target'=>100,'satuan'=>'%']);
        Indikator::create(['program_id'=>$p->id,'nama'=>'Persentase Pemenuhan Pelayanan Administrasi DPRD','target'=>100,'satuan'=>'%']);
    }
}
