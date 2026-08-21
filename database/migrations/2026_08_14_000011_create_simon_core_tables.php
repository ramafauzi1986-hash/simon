<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  if(!Schema::hasTable('programs')) Schema::create('programs',function(Blueprint $t){$t->id();$t->string('kode')->nullable();$t->string('nama');$t->decimal('target',15,2)->default(0);$t->string('satuan')->nullable();$t->timestamps();});
  if(!Schema::hasTable('kegiatans')) Schema::create('kegiatans',function(Blueprint $t){$t->id();$t->foreignId('program_id')->constrained('programs')->cascadeOnDelete();$t->string('kode')->nullable();$t->string('nama');$t->timestamps();});
  if(!Schema::hasTable('sub_kegiatans')) Schema::create('sub_kegiatans',function(Blueprint $t){$t->id();$t->foreignId('kegiatan_id')->constrained('kegiatans')->cascadeOnDelete();$t->string('kode')->nullable();$t->string('nama');$t->decimal('target',15,2)->default(0);$t->string('satuan')->nullable();$t->timestamps();});
  if(!Schema::hasTable('indikator_kinerjas')) Schema::create('indikator_kinerjas',function(Blueprint $t){$t->id();$t->foreignId('sub_kegiatan_id')->constrained('sub_kegiatans')->cascadeOnDelete();$t->string('nama');$t->decimal('target',15,2)->default(0);$t->string('satuan')->nullable();$t->text('sumber_data')->nullable();$t->timestamps();});
  if(!Schema::hasTable('realisasis')) Schema::create('realisasis',function(Blueprint $t){$t->id();$t->foreignId('indikator_kinerja_id')->constrained('indikator_kinerjas')->cascadeOnDelete();$t->unsignedTinyInteger('triwulan');$t->decimal('nilai',15,2)->default(0);$t->text('keterangan')->nullable();$t->string('dokumen')->nullable();$t->string('evidence_path')->nullable();$t->timestamps();$t->unique(['indikator_kinerja_id','triwulan']);});
 }
 public function down(): void { Schema::dropIfExists('realisasis');Schema::dropIfExists('indikator_kinerjas');Schema::dropIfExists('sub_kegiatans');Schema::dropIfExists('kegiatans');Schema::dropIfExists('programs'); }
};