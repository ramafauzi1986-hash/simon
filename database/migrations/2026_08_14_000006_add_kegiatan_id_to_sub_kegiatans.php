<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignKeyDefinition;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // The create_sub_kegiatan migration already defines kegiatan_id.
        // Keep this migration safe for databases created from older versions.
        if (!Schema::hasColumn('sub_kegiatans', 'kegiatan_id')) {
            Schema::table('sub_kegiatans', function (Blueprint $table) {
                $table->foreignId('kegiatan_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('kegiatans')
                    ->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        // Do not remove kegiatan_id here because it is part of the base
        // sub_kegiatans table definition in migration 000005.
    }
};
