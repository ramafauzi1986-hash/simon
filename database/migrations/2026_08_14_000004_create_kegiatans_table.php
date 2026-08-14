<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::create('kegiatans', function(Blueprint $table){ $table->id(); $table->foreignId('program_id')->constrained()->cascadeOnDelete(); $table->string('kode',50)->nullable(); $table->string('nama'); $table->timestamps(); }); } public function down(): void { Schema::dropIfExists('kegiatans'); } };