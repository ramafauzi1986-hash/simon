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
        $p = Program::firstOrCreate(['kode'=>'01'], ['nama'=>'Program Penunjang Urusan Pemerintahan Daerah','target'=>100,'satuan'=>'%']);
        $k = Kegiatan::firstOrCreate(['program_id'=>$p->id,'kode'=>'01.01'], ['nama'=>'Kegiatan Penunjang Urusan Pemerintahan Daerah']);

        $items = [
            ['01.01.01','Penyediaan Jasa Pelayanan Umum Kantor',12,'Laporan','Jumlah Laporan Penyediaan Jasa Pelayanan Umum Kantor yang Disediakan'],
            ['01.01.02','Penatausahaan Arsip Dinamis',12,'Dokumen','Jumlah Dokumen Penatausahaan Arsip Dinamis'],
            ['01.01.03','Penyediaan Barang Cetakan dan Penggandaan',1,'Paket','Jumlah Paket Barang Cetakan dan Penggandaan yang Disediakan'],
            ['01.01.04','Penyediaan Peralatan Rumah Tangga',1,'Paket','Jumlah Paket Peralatan Rumah Tangga yang Disediakan'],
            ['01.01.05','Penyediaan Bahan Bacaan dan Peraturan Perundang-undangan',12,'Bulan','Jumlah Bulan Penyediaan Bahan Bacaan dan Peraturan Perundang-undangan'],
            ['01.01.06','Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik',12,'Bulan','Jumlah Bulan Penyediaan Jasa Komunikasi, Sumber Daya Air dan Listrik'],
            ['01.02.01','Fasilitasi Tugas DPRD',100,'%','Persentase Fasilitasi Tugas DPRD yang terpenuhi'],
            ['01.02.02','Fasilitasi Penyusunan Raperda',100,'%','Persentase Dokumen Raperda Yang Disetujui'],
            ['01.02.03','Fasilitasi Pengawasan DPRD',100,'%','Persentase rekomendasi hasil pengawasan yang ditindaklanjuti'],
            ['01.02.04','Peningkatan Kapasitas DPRD',100,'%','Persentase Layanan Fasilitasi Peningkatan Kapasitas DPRD yang terlaksana'],
            ['01.02.05','Penyaluran Aspirasi Masyarakat',100,'%','Persentase Aspirasi Masyarakat yang disampaikan ke Pemerintah Daerah'],
            ['01.02.06','Fasilitasi Penegakan Kode Etik DPRD',100,'%','Persentase pelanggaran kode etik yang ditindaklanjuti'],
            ['01.02.07','Pelayanan Administrasi DPRD',100,'%','Persentase Terpenuhinya Pelayanan Administrasi DPRD'],
            ['01.02.08','Pengelolaan Keuangan dan Kesejahteraan Anggota DPRD',100,'%','Persentase terpenuhinya pelayanan kesejahteraan anggota DPRD'],
            ['01.02.09','Penyusunan Kebijakan Anggaran',100,'%','Persentase Dokumen Kebijakan Anggaran yang disusun tepat waktu dan sesuai ketentuan perundangan'],
        ];

        foreach ($items as [$kode,$nama,$target,$satuan,$indikator]) {
            $sk = SubKegiatan::firstOrCreate(['kegiatan_id'=>$k->id,'kode'=>$kode], ['nama'=>$nama,'target'=>$target,'satuan'=>$satuan]);
            IndikatorKinerja::firstOrCreate(['sub_kegiatan_id'=>$sk->id,'nama'=>$indikator], ['target'=>$target,'satuan'=>$satuan,'sumber_data'=>'Laporan pelaksanaan kegiatan dan dokumen pendukung']);
        }

        User::updateOrCreate(['email'=>'admin@simon-setwan.local'], ['name'=>'Administrator SIMON','password'=>Hash::make('Admin@12345'),'role'=>'admin']);
    }
}
