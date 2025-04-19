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
    Schema::create('mitra', function (Blueprint $table) {
        $table->id('id_perusahaan');
        $table->string('nama_perusahaan', 100);
        $table->string('logo_perusahaan', 255)->nullable();
        $table->text('deskripsi_perusahaan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitra');
    }
};