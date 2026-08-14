<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Program;
use App\Models\Indikator;
class DatabaseSeeder extends Seeder { public function run(): void { $p=Program::firstOrCreate(['kode'=>'01'],['nama'=>'Program Penunjang Urusan Pemerintahan Daerah','target'=>100,'satuan'=>'%']); Indikator::firstOrCreate(['program_id'=>$p->id,'nama'=>'Persentase Pemenuhan Pelayanan Administrasi DPRD'],['target'=>100,'satuan'=>'%']); User::updateOrCreate(['email'=>'admin@simon-setwan.local'],['name'=>'Administrator SIMON','password'=>Hash::make('Admin@12345'),'role'=>'admin']); } }