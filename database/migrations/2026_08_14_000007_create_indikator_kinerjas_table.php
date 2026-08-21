<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::create('indikator_kinerjas', function(Blueprint $table){ $table->id(); $table->foreignId('sub_kegiatan_id')->constrained('sub_kegiatans')->cascadeOnDelete(); $table->string('nama'); $table->decimal('target',15,2)->default(0); $table->string('satuan',50)->nullable(); $table->text('sumber_data')->nullable(); $table->timestamps(); }); } public function down(): void { Schema::dropIfExists('indikator_kinerjas'); } };