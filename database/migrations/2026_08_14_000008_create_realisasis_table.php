<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // The original SIMON schema already creates `realisasis` in
        // 2026_01_01_000003. Extend that table instead of recreating it.
        if (!Schema::hasTable('realisasis')) {
            Schema::create('realisasis', function (Blueprint $table) {
                $table->id();
                $table->foreignId('indikator_kinerja_id')
                    ->constrained('indikator_kinerjas')
                    ->cascadeOnDelete();
                $table->unsignedTinyInteger('triwulan');
                $table->decimal('nilai', 15, 2)->default(0);
                $table->text('keterangan')->nullable();
                $table->string('dokumen')->nullable();
                $table->timestamps();
                $table->unique(['indikator_kinerja_id', 'triwulan']);
            });
            return;
        }

        Schema::table('realisasis', function (Blueprint $table) {
            if (!Schema::hasColumn('realisasis', 'indikator_kinerja_id')) {
                $table->foreignId('indikator_kinerja_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('indikator_kinerjas')
                    ->cascadeOnDelete();
            }

            if (!Schema::hasColumn('realisasis', 'triwulan')) {
                $table->unsignedTinyInteger('triwulan')->nullable()->after('indikator_kinerja_id');
            }
        });

        // Add the business key only after the columns exist. Existing legacy
        // rows are allowed to remain without a quarterly KPI link.
        if (Schema::hasColumn('realisasis', 'indikator_kinerja_id') && Schema::hasColumn('realisasis', 'triwulan')) {
            try {
                Schema::table('realisasis', function (Blueprint $table) {
                    $table->unique(['indikator_kinerja_id', 'triwulan'], 'realisasis_kinerja_triwulan_unique');
                });
            } catch (\Throwable $e) {
                // The unique index may already exist on a partially migrated database.
            }
        }
    }

    public function down(): void
    {
        // Keep the legacy `realisasis` table intact; this migration only adds
        // the quarterly KPI fields required by the newer SIMON modules.
    }
};
