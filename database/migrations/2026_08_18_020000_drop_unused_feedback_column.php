<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom 'feedback' sudah tidak dipakai, digantikan 'tanggapan'.
     * Migration ini aman dijalankan walau kolom 'feedback' sudah tidak ada.
     */
    public function up(): void
    {
        if (Schema::hasColumn('input_aspirasis', 'feedback')) {
            Schema::table('input_aspirasis', function (Blueprint $table) {
                $table->dropColumn('feedback');
            });
        }
    }

    public function down(): void
    {
        Schema::table('input_aspirasis', function (Blueprint $table) {
            $table->text('feedback')->nullable();
        });
    }
};
