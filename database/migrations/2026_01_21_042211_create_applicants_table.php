<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('divisi_satu', ['hrd', 'pr', 'mulmed', 'arrait', 'scrabble', 'newscasting', 'debate', 'toastmaster']);
            $table->enum('divisi_dua', ['hrd', 'pr', 'mulmed', 'arrait', 'scrabble', 'newscasting', 'debate', 'toastmaster'])->nullable();
            $table->text('alasan_utama');
            $table->text('alasan_satu');
            $table->text('alasan_dua')->nullable();
            $table->string('path_tugas_satu');
            $table->string('path_tugas_dua')->nullable();
            $table->enum('status', ['pending', 'terima', 'ditolak'])->default('pending');
            $table->enum('accepted_division', ['hrd', 'pr', 'mulmed', 'arrait', 'scrabble', 'newscasting', 'debate', 'toastmaster'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
