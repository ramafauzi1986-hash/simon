<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('indikators', function (Blueprint $table) {
            $table->id(); $table->foreignId('program_id')->constrained()->cascadeOnDelete();
            $table->string('nama'); $table->decimal('target', 15, 2)->default(0); $table->string('satuan', 50)->nullable(); $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('indikators'); }
};
