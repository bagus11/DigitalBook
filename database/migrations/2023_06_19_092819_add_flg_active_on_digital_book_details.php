<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlgActiveOnDigitalBookDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('digital_book_details', function (Blueprint $table) {
            $table->integer('flg_active')->after('type');
            $table->integer('index')->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('digital_book_details', function (Blueprint $table) {
            $table->dropColumn('flg_active');
        });
    }
}
