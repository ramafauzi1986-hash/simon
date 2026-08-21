<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_kegiatan_data_awals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sub_kegiatan_id')
                ->constrained('sub_kegiatans')
                ->cascadeOnDelete();

            $table->unsignedSmallInteger('tahun_anggaran')->default(2026);

            $table->decimal('pagu_anggaran', 18, 2)->default(0);
            $table->decimal('pagu_perubahan', 18, 2)->default(0);

            $table->string('sumber_dana')->nullable();
            $table->string('jenis_belanja')->nullable();

            $table->decimal('target', 18, 2)->default(0);
            $table->string('satuan')->nullable();

            $table->decimal('target_tw1', 18, 2)->default(0);
            $table->decimal('target_tw2', 18, 2)->default(0);
            $table->decimal('target_tw3', 18, 2)->default(0);
            $table->decimal('target_tw4', 18, 2)->default(0);

            $table->decimal('realisasi_keuangan_awal', 18, 2)->default(0);
            $table->decimal('realisasi_fisik_awal', 18, 2)->default(0);

            $table->text('keterangan')->nullable();

            $table->timestamps();

            $table->unique(
                ['sub_kegiatan_id', 'tahun_anggaran'],
                'sub_kegiatan_tahun_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_kegiatan_data_awals');
    }
};