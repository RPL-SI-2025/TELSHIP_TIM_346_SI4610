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
        Schema::table('lowongan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_admin')->nullable()->after('id_mentor'); // atau after kolom lain sesuai kebutuhan
 
            $table->foreign('id_admin')
                  ->references('id_admin')
                  ->on('user_admin')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lowongan', function (Blueprint $table) {
            //
        });
    }
};
