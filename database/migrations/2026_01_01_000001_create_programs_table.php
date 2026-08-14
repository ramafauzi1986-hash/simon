<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('programs', function (Blueprint $table) {
            $table->id(); $table->string('kode', 50)->nullable(); $table->string('nama');
            $table->decimal('target', 15, 2)->default(0); $table->string('satuan', 50)->nullable(); $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('programs'); }
};
