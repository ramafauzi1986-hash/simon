<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::table('sub_kegiatans', function(Blueprint $table){ $table->foreignId('kegiatan_id')->after('id')->nullable()->constrained('kegiatans')->cascadeOnDelete(); }); } public function down(): void { Schema::table('sub_kegiatans', function(Blueprint $table){ $table->dropForeign(['kegiatan_id']); $table->dropColumn('kegiatan_id'); }); } };