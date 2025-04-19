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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id('id_dokumen');
            $table->unsignedBigInteger('id_mahasiswa')->unique();
            $table->string('link_cv', 255)->nullable();
            $table->string('link_transkrip', 255)->nullable();
            $table->string('link_ktp', 255)->nullable();
            $table->string('link_sertifikat', 255)->nullable();
            $table->string('link_dokumen_tambahan', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};