<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            // Kolom Nilai Divisi 1
            $table->integer('score_1')->nullable()->after('status');
            $table->text('notes_1')->nullable()->after('score_1');

            // Kolom Nilai Divisi 2
            $table->integer('score_2')->nullable()->after('notes_1');
            $table->text('notes_2')->nullable()->after('score_2');

            // Kolom Keputusan (Diterima di mana)
            // Cek dulu biar gak error kalau kolom accepted_division udah ada
            if (! Schema::hasColumn('applicants', 'accepted_division')) {
                $table->string('accepted_division')->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn(['score_1', 'notes_1', 'score_2', 'notes_2', 'accepted_division']);
        });
    }
};
