<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('realisasis', function (Blueprint $table) {
            $table->id(); $table->foreignId('indikator_id')->constrained()->cascadeOnDelete();
            $table->string('periode', 20); $table->decimal('nilai', 15, 2)->default(0);
            $table->text('keterangan')->nullable(); $table->string('dokumen')->nullable(); $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('realisasis'); }
};
