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
        Schema::create('user_mentor', function (Blueprint $table) {
            $table->id('id_mentor');
            $table->string('nama_lengkap', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->unsignedBigInteger('id_perusahaan');
            $table->timestamps();

            $table->foreign('id_perusahaan')->references('id_perusahaan')->on('mitra')->onDelete('cascade');
        });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_mentor');
    }
};