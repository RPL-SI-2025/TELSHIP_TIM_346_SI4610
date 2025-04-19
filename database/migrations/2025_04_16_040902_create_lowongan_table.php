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
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id('id_lowongan');
            $table->string('nama_posisi', 100);
            $table->text('deskripsi_pekerjaan');
            $table->integer('jumlah_kuota');
            $table->string('durasi_magang', 50);
            $table->text('persyaratan');
            $table->unsignedBigInteger('id_mentor');
            $table->enum('status', ['disetujui', 'ditolak', 'menunggu']);
            $table->timestamps();

            $table->foreign('id_mentor')->references('id_mentor')->on('user_mentor')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan');
    }
};