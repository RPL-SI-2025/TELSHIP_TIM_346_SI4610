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
        Schema::create('lamaran', function (Blueprint $table) {
            $table->id('id_lamaran');
            $table->unsignedBigInteger('pelamar_id');
            $table->unsignedBigInteger('id_lowongan'); 
            $table->date('tanggal_lamaran');
            $table->enum('status', ['lolos', 'ditolak', 'diproses']);
            $table->timestamps();
    
            $table->foreign('pelamar_id')->references('id')->on('pelamars')->onDelete('cascade');
            $table->foreign('id_lowongan')->references('id_lowongan')->on('lowongan')->onDelete('cascade');
        });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamaran');
    }
};