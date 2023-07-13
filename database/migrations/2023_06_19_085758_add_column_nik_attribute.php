<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNikAttribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('flg_aktif');
            $table->integer('jabatan');
            $table->integer('departement');
            $table->integer('kode_kantor');
            $table->integer('nik');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('flg_aktif');
            $table->dropColumn('jabatan');
            $table->dropColumn('departement');
            $table->dropColumn('kode_kantor');
            $table->dropColumn('nik');
        });
    }
}
