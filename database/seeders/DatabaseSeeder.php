<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\SubKegiatan;
use App\Models\IndikatorKinerja;
class DatabaseSeeder extends Seeder { public function run(): void { $p=Program::firstOrCreate(['kode'=>'01'],['nama'=>'Program Penunjang Urusan Pemerintahan Daerah','target'=>100,'satuan'=>'%']); $k=Kegiatan::firstOrCreate(['program_id'=>$p->id,'kode'=>'01.01'],['nama'=>'Kegiatan Penunjang Urusan Pemerintahan Daerah']); $sk=SubKegiatan::firstOrCreate(['kegiatan_id'=>$k->id,'kode'=>'01.01.01'],['nama'=>'Penyediaan Jasa Pelayanan Umum Kantor','target'=>12,'satuan'=>'Laporan']); IndikatorKinerja::firstOrCreate(['sub_kegiatan_id'=>$sk->id,'nama'=>'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan'],['target'=>12,'satuan'=>'Laporan','sumber_data'=>'Laporan pelaksanaan kegiatan']); User::updateOrCreate(['email'=>'admin@simon-setwan.local'],['name'=>'Administrator SIMON','password'=>Hash::make('Admin@12345'),'role'=>'admin']); } }