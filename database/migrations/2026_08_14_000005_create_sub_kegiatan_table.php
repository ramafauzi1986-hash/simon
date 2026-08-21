<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::create('sub_kegiatans', function(Blueprint $table){ $table->id(); $table->foreignId('kegiatan_id')->constrained('kegiatans')->cascadeOnDelete(); $table->string('kode',50)->nullable(); $table->string('nama'); $table->decimal('target',15,2)->default(0); $table->string('satuan',50)->nullable(); $table->timestamps(); }); } public function down(): void { Schema::dropIfExists('sub_kegiatans'); } };