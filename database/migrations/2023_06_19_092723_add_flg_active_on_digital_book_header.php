<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlgActiveOnDigitalBookHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('digital_book_headers', function (Blueprint $table) {
            $table->integer('flg_active')->after('pic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('digital_book_headers', function (Blueprint $table) {
            $table->dropColumn('flg_active');
        });
    }
}
