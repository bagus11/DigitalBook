<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnDigitalCodeLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('digital_book_detail_logs', function (Blueprint $table) {
            $table->renameColumn('digitalCode', 'detailCode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return voi
     */
    public function down()
    {
        Schema::table('digital_book_detail_logs', function (Blueprint $table) {
            // $table->renameColumn('detailCode','digitalCode');
        });
    }
}
