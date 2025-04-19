<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaToPelamarsTable extends Migration
{
    public function up()
    {
        Schema::table('pelamars', function (Blueprint $table) {
            $table->string('nama');
        });
    }

    public function down()
    {
        Schema::table('pelamars', function (Blueprint $table) {
            $table->dropColumn('nama');
        });
    }
}
