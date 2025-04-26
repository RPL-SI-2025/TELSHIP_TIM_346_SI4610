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
        Schema::table('mitra', function (Blueprint $table) {
            $table->string('alamat', 255)->nullable()->after('deskripsi_perusahaan');
            $table->string('email', 100)->nullable()->after('alamat');
            $table->string('telepon', 50)->nullable()->after('email');
            $table->string('link_website', 255)->nullable()->after('telepon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mitra', function (Blueprint $table) {
            //
        });
    }
};