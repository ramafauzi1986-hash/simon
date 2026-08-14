<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\SubKegiatan;
use App\Models\IndikatorKinerja;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $p = Program::firstOrCreate(
            ['kode' => '01'],
            ['nama' => 'Program Penunjang Urusan Pemerintahan Daerah', 'target' => 100, 'satuan' => '%']
        );

        $k = Kegiatan::firstOrCreate(
            ['program_id' => $p->id, 'kode' => '01.01'],
            ['nama' => 'Kegiatan Penunjang Urusan Pemerintahan Daerah']
        );

        $subKegiatans = [
            ['kode'=>'01.01.01','nama'=>'Penyediaan Jasa Pelayanan Umum Kantor','target'=>12,'satuan'=>'Laporan','indikator'=>'Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan'],
            ['kode'=>'01.01.02','nama'=>'Penatausahaan Arsip Dinamis','target'=>12,'satuan'=>'Dokumen','indikator'=>'Jumlah Dokumen Penatausahaan Arsip Dinamis'],
            ['kode'=>'01.01.03','nama'=>'Penyediaan Barang Cetakan dan Penggandaan','target'=>1,'satuan'=>'Paket','indikator'=>'Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan'],
            ['kode'=>'01.01.04','nama'=>'Penyediaan Peralatan Rumah Tangga','target'=>1,'satuan'=>'Paket','indikator'=>'Jumlah Paket Peralatan Rumah Tangga yang Disediakan'],
            ['kode'=>'01.01.05','nama'=>'Penyediaan Bahan Bacaan dan Peraturan Perundang-undangan','target'=>12,'satuan'=>'Bulan','indikator'=>'Jumlah Bulan Penyediaan Bahan Bacaan dan Peraturan Perundang-undangan'],
            ['kode'=>'01.01.06','nama'=>'Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik','target'=>12,'satuan'=>'Bulan','indikator'=>'Jumlah Bulan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik'],
        ];

        foreach ($subKegiatans as $row) {
            $sk = SubKegiatan::firstOrCreate(
                ['kegiatan_id'=>$k->id,'kode'=>$row['kode']],
                ['nama'=>$row['nama'],'target'=>$row['target'],'satuan'=>$row['satuan']]
            );
            IndikatorKinerja::firstOrCreate(
                ['sub_kegiatan_id'=>$sk->id,'nama'=>$row['indikator']],
                ['target'=>$row['target'],'satuan'=>$row['satuan'],'sumber_data'=>'Laporan pelaksanaan kegiatan dan dokumen pendukung']
            );
        }

        User::updateOrCreate(
            ['email'=>'admin@simon-setwan.local'],
            ['name'=>'Administrator SIMON','password'=>Hash::make('Admin@12345'),'role'=>'admin']
        );
    }
}
